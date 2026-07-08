<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Tampilan Halaman Cart (Pengganti ecommerceCartPage.php)
    public function showCart()
    {
        // Kalau belum login, tampilkan keranjang kosong
        if (!Auth::check()) {
            return view('ecommerceCartPage', ['cart' => [], 'total' => 0]);
        }

        $userId = Auth::id();

        // Ambil data keranjang menggunakan Eloquent dan relasinya
        $cartItems = Keranjang::with('produk')->where('user_id', $userId)->get();

        // Format data agar sesuai dengan view lama
        $cart = $cartItems->mapWithKeys(function($item) {
            return [$item->barang_id => [
                'nama_produk' => $item->produk->nama_produk, 'harga' => $item->produk->harga, 'gambar_produk' => $item->produk->gambar_produk, 'jumlah' => $item->qty
            ]];
        })->all();

        // Hitung total harga dengan cara yang benar, mengakses relasi produk dan kolom qty
        $total = $cartItems->sum(fn($item) => $item->produk->harga * $item->qty);

        return view('ecommerceCartPage', compact('cart', 'total'));
    }

    // Logic Tambah Item ke Cart
    public function addToCart(Request $request, $id)
    {
        // Wajib login untuk tambah ke keranjang
        if (!Auth::check()) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Login dulu cuy sebelum nambahin barang ke keranjang!',
                    'redirect' => route('login')
                ], 401);
            }
            return redirect('/login')->with('error', 'Login dulu cuy sebelum nambahin barang ke keranjang!');
        }

        $userId = Auth::id();
        $barangId = $id;
        $qty = (int)$request->input('qty', 1); // Ambil QTY dari form, default 1

        $produk = Produk::find($barangId);
        if (!$produk) {
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Produk tidak ditemukan!'], 404);
            }
            return back()->with('error', 'Produk tidak ditemukan!');
        }

        $keranjangItem = Keranjang::where('user_id', $userId)->where('barang_id', $barangId)->first();

        $currentQtyInCart = $keranjangItem ? $keranjangItem->qty : 0;
        $requestedTotalQty = $currentQtyInCart + $qty;

        if ($produk->stok < $requestedTotalQty) {
            $message = "Stok tidak mencukupi. Stok tersisa: {$produk->stok}.";
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $message], 422);
            }
            return back()->with('error', $message);
        }

        // Gunakan updateOrCreate untuk menyederhanakan logika
        // Jika item sudah ada, qty akan ditambah. Jika belum, akan dibuat.
        if ($keranjangItem) {
            $keranjangItem->increment('qty', $qty);
        } else {
            Keranjang::create([
                'user_id' => $userId,
                'barang_id' => $barangId,
                'qty' => $qty
            ]);
        }

        if ($request->wantsJson()) {
            $cartCount = Keranjang::where('user_id', $userId)->sum('qty');
            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil masuk keranjang!',
                'cartCount' => $cartCount
            ]);
        }

        return redirect('/ecommerceCartPage')->with('success', 'Produk berhasil masuk keranjang!');
    }

    // Proses Simpan ke Database (Pengganti proses_checkout.php)
    public function prosesCheckout(Request $request)
    {
        if(!Auth::check()) {
            return redirect('/login')->with('error', 'Login dulu cuy sebelum checkout!');
        }

        $userId = Auth::id();
        $itemsWithDetails = DB::table('ec_keranjang')
            ->join('ec_produk', 'ec_keranjang.barang_id', '=', 'ec_produk.barang_id')
            ->where('ec_keranjang.user_id', $userId)
            ->get();

        if($itemsWithDetails->isEmpty()) {
            return redirect('/productpage')->with('error', 'Keranjang kamu kosong!');
        }

        DB::transaction(function() use ($itemsWithDetails, $userId, $request) {
            $total = 0;
            foreach($itemsWithDetails as $item) {
                $total += $item->harga * $item->qty;
            }

            // 1. Buat transaksi baru menggunakan Model Transaksi
            // Kolom 'tanggal_transaksi' akan diisi otomatis oleh Eloquent
            $transaksi = Transaksi::create([
                'user_id'            => $userId,
                'total_harga'        => $total,
                'alamat_pengiriman'  => $request->input('alamat_pengiriman', '-'),
                'metode_pembayaran'  => $request->input('metode_pembayaran', '-'),
                'opsi_pengiriman'    => $request->input('opsi_pengiriman', '-'),
                'status_pesanan'     => 'pending'
            ]);

            // 2. Siapkan semua item detail untuk dimasukkan ke database
            $detailItems = [];
            foreach($itemsWithDetails as $item) {
                $detailItems[] = [
                    'transaksi_id' => $transaksi->transaksi_id, // Ambil ID dari transaksi yang baru dibuat
                    'barang_id' => $item->barang_id,
                    'qty' => $item->qty,
                    'harga_satuan' => $item->harga
                ];
            }
            // 3. Masukkan semua item detail sekaligus menggunakan Model DetailTransaksi
            DetailTransaksi::insert($detailItems);

            // Kosongkan keranjang dari database setelah sukses checkout
            DB::table('ec_keranjang')->where('user_id', $userId)->delete();
        });

        return redirect('/')->with('success', 'Checkout sukses! Pesanan sedang kami siapkan.');
    }
}