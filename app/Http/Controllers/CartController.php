<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    // Tampilan Halaman Cart (Pengganti cartpage.php)
    public function showCart()
    {
        // Kalau belum login, tampilkan keranjang kosong
        if (!session()->has('user_id')) {
            return view('cartpage', ['cart' => [], 'total' => 0]);
        }

        $userId = session('user_id');

        // Ambil data keranjang dari database dengan join ke tabel produk
        $cartItems = DB::table('ec_keranjang')
            ->join('ec_produk', 'ec_keranjang.barang_id', '=', 'ec_produk.barang_id')
            ->where('ec_keranjang.user_id', $userId)
            ->select('ec_keranjang.barang_id', 'ec_produk.nama_produk', 'ec_produk.harga', 'ec_produk.gambar_produk', 'ec_keranjang.qty as jumlah')
            ->get();

        // Ubah collection jadi array agar sesuai dengan format view
        $cart = $cartItems->map(function($item) {
            return (array)$item;
        })->keyBy('barang_id')->all();

        $total = 0;
        foreach($cartItems as $item) {
            $total += $item->harga * $item->jumlah;
        }

        return view('cartpage', compact('cart', 'total'));
    }

    // Logic Tambah Item ke Cart
    public function addToCart(Request $request, $id)
    {
        // Wajib login untuk tambah ke keranjang
        if (!session()->has('user_id')) {
            return redirect('/login')->with('error', 'Login dulu cuy sebelum nambahin barang ke keranjang!');
        }

        $userId = session('user_id');
        $barangId = $id;
        $qty = $request->input('qty', 1); // Ambil QTY dari form, default 1

        $produk = DB::table('ec_produk')->where('barang_id', $id)->first();
        if(!$produk) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan!');
        }

        // Cek apakah barang sudah ada di keranjang user
        $keranjangItem = DB::table('ec_keranjang')
            ->where('user_id', $userId)
            ->where('barang_id', $barangId)
            ->first();

        if ($keranjangItem) {
            // Kalau sudah ada, update jumlahnya
            DB::table('ec_keranjang')
                ->where('keranjang_id', $keranjangItem->keranjang_id)
                ->increment('qty', $qty);
        } else {
            // Kalau belum ada, insert data baru
            DB::table('ec_keranjang')->insert([
                'user_id' => $userId,
                'barang_id' => $barangId,
                'qty' => $qty
            ]);
        }

        return redirect('/cartpage')->with('success', 'Produk berhasil masuk keranjang!');
    }

    // Proses Simpan ke Database (Pengganti proses_checkout.php)
    public function prosesCheckout(Request $request)
    {
        if(!session()->has('user_id')) {
            return redirect('/login')->with('error', 'Login dulu cuy sebelum checkout!');
        }

        $userId = session('user_id');
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

            // Insert ke tabel checkout utama
            $checkoutId = DB::table('ec_transaksi')->insertGetId([
                'user_id'            => $userId,
                'total_harga'        => $total,
                'tanggal_transaksi'  => now(),
                'alamat_pengiriman'  => $request->input('alamat_pengiriman', '-'),
                'metode_pembayaran'  => $request->input('metode_pembayaran', '-'),
                'opsi_pengiriman'    => $request->input('opsi_pengiriman', '-'),
                'status_pesanan'     => 'pending'   // ← ganti dari status_pembayaran
            ]);

            // Insert item detailnya satu per satu
            foreach($itemsWithDetails as $item) {
                DB::table('ec_detail_transaksi')->insert([
                    'transaksi_id' => $checkoutId,
                    'barang_id' => $item->barang_id,
                    'qty' => $item->qty,
                    'harga_satuan' => $item->harga
                ]);
            }

            // Kosongkan keranjang dari database setelah sukses checkout
            DB::table('ec_keranjang')->where('user_id', $userId)->delete();
        });

        return redirect('/')->with('success', 'Checkout sukses! Pesanan sedang kami siapkan.');
    }
}