<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    // Landing page barbershop (route '/')
    public function home()
    {
        return view('home'); // resources/views/home.blade.php
    }

    // Halaman toko/produk (route '/shop')
    public function ecHome()
    {
        $produk = DB::table('ec_produk')->orderBy('barang_id', 'desc')->get();
        return view('ec_home', compact('produk')); // resources/views/ec_home.blade.php
    }

    // Ini kayaknya homepage lama (ec_home versi lama), bisa dihapus kalau sudah tidak dipakai
    public function homepage()
    {
        $produk = DB::table('ec_produk')->orderBy('barang_id', 'desc')->limit(5)->get();
        return view('homepage', ['produk' => $produk]);
    }

    public function productpage()
    {
        $powder  = DB::table('ec_produk')->where('kategori', 'Powder')->get();
        $shampoo = DB::table('ec_produk')->where('kategori', 'Shampoo')->get();
        return view('productpage', ['powder' => $powder, 'shampoo' => $shampoo]);
    }

    public function productdetail($id)
    {
        $data = DB::table('ec_produk')->where('barang_id', $id)->first();
        if (!$data) {
            return redirect('/productpage');
        }
        return view('productdetail', ['data' => $data]);
    }
}