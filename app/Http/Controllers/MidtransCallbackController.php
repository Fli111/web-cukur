<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Produk;

class MidtransCallbackController extends Controller
{
    private $hargaPaket = ['gold' => 20000, 'platinum' => 25000, 'diamond' => 30000];

    public function handle(Request $request)
    {
        $payload   = $request->all();
        $serverKey = env('MIDTRANS_SERVER_KEY');

        $orderId      = $payload['order_id']      ?? '';
        $statusCode   = $payload['status_code']   ?? '';
        $grossAmount  = $payload['gross_amount']  ?? '';
        $signatureKey = $payload['signature_key'] ?? '';

        $expectedSignature = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

        if ($signatureKey !== $expectedSignature) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        if (str_starts_with($orderId, 'HARTONO-')) {
            return $this->handleEcommerce($payload, $orderId);
        } elseif (str_starts_with($orderId, 'MEMBER-')) {
            return $this->handleMember($payload, $orderId);
        }

        return response()->json(['message' => 'Unknown order type'], 400);
    }

    private function handleEcommerce(array $payload, string $orderId)
    {
        $transactionStatus = $payload['transaction_status'] ?? '';
        $fraudStatus       = $payload['fraud_status'] ?? '';

        if ($transactionStatus === 'settlement' ||
           ($transactionStatus === 'capture' && $fraudStatus === 'accept')) {
            $paymentStatus = 'paid';
            $statusPesanan = 'Dibayar';
        } elseif ($transactionStatus === 'pending') {
            $paymentStatus = 'pending';
            $statusPesanan = 'pending';
        } elseif (in_array($transactionStatus, ['deny', 'expire', 'cancel'])) {
            $paymentStatus = 'failed';
            $statusPesanan = 'Dibatalkan';
        } else {
            return response()->json(['message' => 'OK'], 200);
        }

        $transaksi = Transaksi::where('order_id', $orderId)->first();
        if ($transaksi) {
            $transaksi->update([
                'payment_status' => $paymentStatus,
                'status_pesanan' => $statusPesanan,
                'metode_pembayaran' => $payload['payment_type'] ?? 'Midtrans',
            ]);

            if ($paymentStatus === 'paid') {
                $details = DetailTransaksi::where('transaksi_id', $transaksi->transaksi_id)->get();
                foreach ($details as $detail) {
                    Produk::where('barang_id', $detail->barang_id)->decrement('stok', $detail->qty);
                }
            }
        }

        return response()->json(['message' => 'OK'], 200);
    }

    private function handleMember(array $payload, string $orderId)
    {
        $transactionStatus = $payload['transaction_status'] ?? '';
        $fraudStatus       = $payload['fraud_status'] ?? '';

        $sukses = $transactionStatus === 'settlement' ||
                 ($transactionStatus === 'capture' && $fraudStatus === 'accept');

        if (!$sukses) {
            return response()->json(['message' => 'OK'], 200);
        }

        // Parse order_id: MEMBER-GOLD-4-1234567890
        $parts  = explode('-', $orderId);
        $paket  = strtolower($parts[1] ?? '');  // gold / platinum / diamond
        $userId = (int)($parts[2] ?? 0);

        if (!$userId || !array_key_exists($paket, $this->hargaPaket)) {
            return response()->json(['message' => 'Invalid order format'], 400);
        }

        $user = DB::table('users')->where('user_id', $userId)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 200);
        }

        // Hindari duplikat
        if (DB::table($paket)->where('user_id', $userId)->exists()) {
            return response()->json(['message' => 'Already activated'], 200);
        }

        DB::transaction(function() use ($userId, $paket, $user, $orderId, $payload) {
            // 1. Insert ke tabel tier
            DB::table($paket)->insert([
            'user_id'      => $userId,
            'nama'         => $user->nama,
            'gmail'        => $user->email,
            "{$paket}_id"  => strtoupper($paket) . '-' . str_pad($userId, 5, '0', STR_PAD_LEFT),
            'tgl_daftar'   => now(),
        ]);
            // 2. Catat di mem_transaksi
            DB::table('mem_transaksi')->insert([
                'user_id'           => $userId,
                'nama'              => $user->nama,
                'jenis'             => $paket,
                'metode_pembayaran' => $payload['payment_type'] ?? 'Midtrans',
                'waktu_pembayaran'  => now(),
                'order_id'          => $orderId,
                'status'            => 'paid',
            ]);

            // 3. Update role jadi member
            DB::table('users')
                ->where('user_id', $userId)
                ->where('role', '!=', 'admin')
                ->update(['role' => 'member']);
        });

        return response()->json(['message' => 'OK'], 200);
    }
}