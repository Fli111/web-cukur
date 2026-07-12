<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CartController extends Controller
{
    // ================================================================
    // HELPER: Ambil info diskon produk berdasarkan user_id
    // ================================================================
    private function getDiskonProduk($userId)
    {
        if (DB::table('diamond')->where('user_id', $userId)->exists()) {
            $tier = 'diamond';
        } elseif (DB::table('platinum')->where('user_id', $userId)->exists()) {
            $tier = 'platinum';
        } elseif (DB::table('gold')->where('user_id', $userId)->exists()) {
            $tier = 'gold';
        } else {
            return ['tier' => null, 'persen' => 0];
        }

        $data = DB::table('member_tiers')->where('tier', $tier)->first();
        return [
            'tier'   => $tier,
            'persen' => $data ? $data->diskon_produk : 0
        ];
    }

    // ================================================================
    // HELPER: Buat Snap Token Midtrans
    // ================================================================
    private function buatSnapToken($orderId, $total, $cartItems, $user, $diskonInfo)
    {
        $serverKey = env('MIDTRANS_SERVER_KEY');
        $isSandbox = env('MIDTRANS_IS_PRODUCTION', false) ? '' : '.sandbox';

        $itemDetails = $cartItems->map(function($item) {
            return [
                'id'       => (string) $item->barang_id,
                'price'    => (int) $item->produk->harga,
                'quantity' => (int) $item->qty,
                'name'     => substr($item->produk->nama_produk, 0, 50),
            ];
        })->toArray();

        // Tambahkan diskon sebagai item negatif
        if ($diskonInfo['persen'] > 0) {
            $subtotal  = $cartItems->sum(fn($i) => $i->produk->harga * $i->qty);
            $potongan  = (int) ($subtotal * $diskonInfo['persen'] / 100);
            $itemDetails[] = [
                'id'       => 'DISKON-MEMBER',
                'price'    => -$potongan,
                'quantity' => 1,
                'name'     => 'Diskon Member ' . strtoupper($diskonInfo['tier']) . ' (' . $diskonInfo['persen'] . '%)',
            ];
        }

        $payload = [
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => $total,
            ],
            'item_details'     => $itemDetails,
            'customer_details' => [
                'first_name' => $user->nama,
                'email'      => $user->email,
            ],
            'callbacks' => [
                'finish' => route('ecommerceCheckoutFinish'),
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
    // Tampilan Halaman Cart
    // ================================================================
    public function showCart()
    {
        if (!Auth::check()) {
            return view('ecommerceCartPage', [
                'cart'       => [],
                'total'      => 0,
                'subtotal'   => 0,
                'diskonInfo' => ['tier' => null, 'persen' => 0],
                'potongan'   => 0,
            ]);
        }

        $userId    = Auth::id();
        $cartItems = Keranjang::with('produk')->where('user_id', $userId)->get();

        $cart = $cartItems->mapWithKeys(function($item) {
            return [$item->barang_id => [
                'nama_produk'   => $item->produk->nama_produk,
                'harga'         => $item->produk->harga,
                'gambar_produk' => $item->produk->gambar_produk,
                'jumlah'        => $item->qty
            ]];
        })->all();

        $subtotal   = $cartItems->sum(fn($item) => $item->produk->harga * $item->qty);
        $diskonInfo = $this->getDiskonProduk($userId);
        $potongan   = (int) ($subtotal * $diskonInfo['persen'] / 100);
        $total      = $subtotal - $potongan;

        return view('ecommerceCartPage', compact('cart', 'total', 'subtotal', 'diskonInfo', 'potongan'));
    }

    // ================================================================
    // Tambah Item ke Cart
    // ================================================================
    public function addToCart(Request $request, $id)
    {
        if (!Auth::check()) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success'  => false,
                    'message'  => 'Login dulu cuy sebelum nambahin barang ke keranjang!',
                    'redirect' => route('login')
                ], 401);
            }
            return redirect('/login')->with('error', 'Login dulu cuy sebelum nambahin barang ke keranjang!');
        }

        $userId   = Auth::id();
        $barangId = $id;
        $qty      = (int) $request->input('qty', 1);

        $produk = Produk::find($barangId);
        if (!$produk) {
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Produk tidak ditemukan!'], 404);
            }
            return back()->with('error', 'Produk tidak ditemukan!');
        }

        $keranjangItem     = Keranjang::where('user_id', $userId)->where('barang_id', $barangId)->first();
        $currentQtyInCart  = $keranjangItem ? $keranjangItem->qty : 0;
        $requestedTotalQty = $currentQtyInCart + $qty;

        if ($produk->stok < $requestedTotalQty) {
            $message = "Stok tidak mencukupi. Stok tersisa: {$produk->stok}.";
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $message], 422);
            }
            return back()->with('error', $message);
        }

        if ($keranjangItem) {
            $keranjangItem->increment('qty', $qty);
        } else {
            Keranjang::create(['user_id' => $userId, 'barang_id' => $barangId, 'qty' => $qty]);
        }

        if ($request->wantsJson()) {
            $cartCount = Keranjang::where('user_id', $userId)->sum('qty');
            return response()->json([
                'success'   => true,
                'message'   => 'Produk berhasil masuk keranjang!',
                'cartCount' => $cartCount
            ]);
        }

        return redirect('/ecommerceCartPage')->with('success', 'Produk berhasil masuk keranjang!');
    }

    // ================================================================
    // Proses Checkout — simpan transaksi pending lalu generate Snap Token
    // ================================================================
    public function prosesCheckout(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Login dulu cuy sebelum checkout!');
        }

        $userId    = Auth::id();
        $user      = Auth::user();
        $cartItems = Keranjang::with('produk')->where('user_id', $userId)->get();

        if ($cartItems->isEmpty()) {
            return redirect('/ecommerceProductPage')->with('error', 'Keranjang kamu kosong!');
        }

        // Validasi stok
        foreach ($cartItems as $item) {
            if ($item->produk->stok < $item->qty) {
                return back()->with('error', "Stok '{$item->produk->nama_produk}' tidak mencukupi. Sisa: {$item->produk->stok}.");
            }
        }

        // Hitung total + diskon
        $subtotal   = $cartItems->sum(fn($item) => $item->produk->harga * $item->qty);
        $diskonInfo = $this->getDiskonProduk($userId);
        $persen     = $diskonInfo['persen'];
        $potongan   = (int) ($subtotal * $persen / 100);
        $total      = $subtotal - $potongan;
        $orderId    = 'HARTONO-' . $userId . '-' . time();

        // Simpan transaksi pending dulu
        $transaksi = Transaksi::create([
            'order_id'          => $orderId,
            'user_id'           => $userId,
            'total_harga'       => $total,
            'diskon_persen'     => $persen,
            'potongan_harga'    => $potongan,
            'alamat_pengiriman' => $request->input('alamat_pengiriman', '-'),
            'metode_pembayaran' => 'Midtrans',
            'opsi_pengiriman'   => $request->input('opsi_pengiriman', '-'),
            'status_pesanan'    => 'pending',
            'payment_status'    => 'pending',
        ]);

        // Simpan detail item
        foreach ($cartItems as $item) {
            DetailTransaksi::create([
                'transaksi_id' => $transaksi->transaksi_id,
                'barang_id'    => $item->barang_id,
                'qty'          => $item->qty,
                'harga_satuan' => $item->produk->harga,
            ]);
        }

        // Generate Snap Token
        $snapToken = $this->buatSnapToken($orderId, $total, $cartItems, $user, $diskonInfo);

        if (!$snapToken) {
            $transaksi->delete();
            return back()->with('error', 'Gagal menghubungi Midtrans. Coba lagi.');
        }

        // Simpan snap token & kosongkan keranjang
        $transaksi->update(['snap_token' => $snapToken]);
        Keranjang::where('user_id', $userId)->delete();

        // Redirect ke halaman payment
        return redirect()->route('ecommerceCheckoutPayment', ['order_id' => $orderId]);
    }

    // ================================================================
    // Halaman Payment — tampilkan popup Midtrans
    // ================================================================
    public function paymentPage(Request $request)
    {
        $orderId   = $request->query('order_id');
        $transaksi = Transaksi::where('order_id', $orderId)
                              ->where('user_id', Auth::id())
                              ->firstOrFail();

        return view('ecommerceCheckoutPayment', [
            'snapToken' => $transaksi->snap_token,
            'orderId'   => $orderId,
            'total'     => $transaksi->total_harga,
        ]);
    }

    // ================================================================
    // Finish — redirect setelah bayar dari Midtrans
    // ================================================================
    public function finish(Request $request)
    {
        $status = $request->query('transaction_status');

        if ($status === 'settlement' || $status === 'capture') {
            return redirect('/ecommerceProductPage')->with('success', 'Pembayaran berhasil! Pesanan sedang diproses.');
        } elseif ($status === 'pending') {
            return redirect('/ecommerceProductPage')->with('info', 'Pembayaran pending. Pesanan akan diproses setelah konfirmasi.');
        } else {
            return redirect('/ecommerceCartPage')->with('error', 'Pembayaran gagal atau dibatalkan.');
        }
    }

    // ================================================================
    // Callback Midtrans — update status & kurangi stok setelah bayar
    // ================================================================
    public function callback(Request $request)
    {
        $payload   = $request->all();
        $serverKey = env('MIDTRANS_SERVER_KEY');

        $orderId           = $payload['order_id']      ?? '';
        $statusCode        = $payload['status_code']   ?? '';
        $grossAmount       = $payload['gross_amount']  ?? '';
        $signatureKey      = $payload['signature_key'] ?? '';
        $expectedSignature = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

        if ($signatureKey !== $expectedSignature) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $transactionStatus = $payload['transaction_status'] ?? '';
        $fraudStatus       = $payload['fraud_status'] ?? '';

        if ($transactionStatus === 'settlement' || ($transactionStatus === 'capture' && $fraudStatus === 'accept')) {
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
            ]);

            // Kurangi stok hanya saat pembayaran sukses
            if ($paymentStatus === 'paid') {
                $details = DetailTransaksi::where('transaksi_id', $transaksi->transaksi_id)->get();
                foreach ($details as $detail) {
                    Produk::where('barang_id', $detail->barang_id)->decrement('stok', $detail->qty);
                }
            }
        }

        return response()->json(['message' => 'OK'], 200);
    }
}