<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class pilmemberController extends Controller
{
    // Harga tiap paket member (dalam rupiah)
    private $hargaPaket = [
        'gold'     => 20000,
        'platinum' => 25000,
        'diamond'  => 30000,
    ];

    // ================================================================
    // 1. Halaman Pilih Member
    // ================================================================
    public function index()
    {
        return view('pilmember');
    }

    // ================================================================
    // 2. Halaman Payment — generate Snap Token Midtrans
    // ================================================================
    public function payment(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $paket = strtolower($request->query('paket'));

        // Validasi paket
        if (!array_key_exists($paket, $this->hargaPaket)) {
            return redirect('/pilih-member')->with('error', 'Paket tidak valid.');
        }

        // Cek apakah user sudah punya membership aktif di tier ini
        $sudahMember = DB::table($paket)->where('user_id', Auth::id())->exists();
        if ($sudahMember) {
            return redirect('/pilih-member')->with('error', 'Kamu sudah terdaftar sebagai member ' . strtoupper($paket) . '!');
        }

        $user  = Auth::user();
        $harga = $this->hargaPaket[$paket];

        // Buat order_id unik
        $orderId = 'MEMBER-' . strtoupper($paket) . '-' . $user->user_id . '-' . time();

        // === BUAT SNAP TOKEN MIDTRANS ===
        $snapToken = $this->buatSnapToken($orderId, $harga, $paket, $user);

        if (!$snapToken) {
            return redirect('/pilih-member')->with('error', 'Gagal menghubungi Midtrans. Coba lagi.');
        }

        return view('member-payment', compact('paket', 'harga', 'snapToken', 'orderId'));
    }

    // ================================================================
    // 3. Callback Midtrans — dipanggil server Midtrans setelah bayar
    // ================================================================
    public function callback(Request $request)
    {
        $payload    = $request->all();
        $serverKey  = env('MIDTRANS_SERVER_KEY');

        // Verifikasi signature
        $orderId       = $payload['order_id']      ?? '';
        $statusCode    = $payload['status_code']   ?? '';
        $grossAmount   = $payload['gross_amount']  ?? '';
        $signatureKey  = $payload['signature_key'] ?? '';

        $expectedSignature = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

        if ($signatureKey !== $expectedSignature) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $transactionStatus = $payload['transaction_status'] ?? '';
        $fraudStatus       = $payload['fraud_status'] ?? '';

        // Cek apakah pembayaran sukses
        $sukses = ($transactionStatus === 'settlement') ||
                  ($transactionStatus === 'capture' && $fraudStatus === 'accept');

        if ($sukses) {
            // Parse order_id: format MEMBER-GOLD-4-1234567890
            $parts  = explode('-', $orderId);
            $paket  = strtolower($parts[1] ?? '');   // gold / platinum / diamond
            $userId = (int)($parts[2] ?? 0);

            if ($userId && array_key_exists($paket, $this->hargaPaket)) {
                $this->aktivasiMember($userId, $paket, $orderId, $grossAmount);
            }
        }

        return response()->json(['message' => 'OK'], 200);
    }

    // ================================================================
    // 4. Redirect setelah bayar (dari popup Midtrans)
    // ================================================================
    public function finish(Request $request)
    {
        $orderId           = $request->query('order_id');
        $transactionStatus = $request->query('transaction_status');

        if ($transactionStatus === 'settlement' || $transactionStatus === 'capture') {
            return redirect('/pilih-member')->with('success', 'Pembayaran berhasil! Membership kamu sudah aktif.');
        } elseif ($transactionStatus === 'pending') {
            return redirect('/pilih-member')->with('info', 'Pembayaran sedang diproses. Membership akan aktif setelah konfirmasi.');
        } else {
            return redirect('/pilih-member')->with('error', 'Pembayaran gagal atau dibatalkan.');
        }
    }

    // ================================================================
    // PRIVATE: Buat Snap Token ke Midtrans
    // ================================================================
    private function buatSnapToken($orderId, $harga, $paket, $user)
    {
        $serverKey = env('MIDTRANS_SERVER_KEY');
        $isSandbox = env('MIDTRANS_IS_PRODUCTION', false) ? '' : '.sandbox';

        $payload = [
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => $harga,
            ],
            'item_details' => [[
                'id'       => 'MEMBER-' . strtoupper($paket),
                'price'    => $harga,
                'quantity' => 1,
                'name'     => 'Member ' . strtoupper($paket) . ' Mr. Hartono (1 Bulan)',
            ]],
            'customer_details' => [
                'first_name' => $user->nama,
                'email'      => $user->email,
            ],
            // Redirect setelah bayar
            'callbacks' => [
                'finish' => route('member.finish'),
            ],
        ];

        try {
            $response = Http::withBasicAuth($serverKey, '')
                ->post("https://app{$isSandbox}.midtrans.com/snap/v1/transactions", $payload);

            if ($response->successful()) {
                return $response->json()['token'] ?? null;
            }

            return null;
        } catch (\Exception $e) {
            return null;
        }
    }

    // ================================================================
    // PRIVATE: Simpan ke database setelah pembayaran sukses
    // ================================================================
    private function aktivasiMember($userId, $paket, $orderId, $grossAmount)
    {
        // Ambil data user
        $user = DB::table('users')->where('user_id', $userId)->first();
        if (!$user) return;

        // Jangan duplikat kalau sudah ada
        $sudahAda = DB::table($paket)->where('user_id', $userId)->exists();
        if ($sudahAda) return;

        DB::transaction(function() use ($userId, $paket, $user, $orderId, $grossAmount) {
            // 1. Insert ke tabel tier (gold / platinum / diamond)
            DB::table($paket)->insert([
                'user_id'   => $userId,
                'nama'      => $user->nama,
                'gmail'     => $user->email,
                'tgl_daftar'=> now(),
            ]);

            // 2. Catat di mem_transaksi
            DB::table('mem_transaksi')->insert([
                'user_id'         => $userId,
                'nama'            => $user->nama,
                'jenis'           => $paket,
                'waktu_pembayaran'=> now(),
                'order_id'        => $orderId,
                'status'          => 'pending',
            ]);

            // 3. Update role user jadi 'member' kalau belum
            DB::table('users')
                ->where('user_id', $userId)
                ->where('role', '!=', 'admin')
                ->update(['role' => 'member']);
        });
    }
}