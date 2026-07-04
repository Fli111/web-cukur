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
    public function ecommerceHomePage()
    {
        $produk = DB::table('ec_produk')->orderBy('barang_id', 'desc')->get();
        return view('ecommerceHomePage', compact('produk')); // resources/views/ec_home.blade.php
    }

    public function ecommerceProductPage()
    {
        $powder  = DB::table('ec_produk')->where('kategori', 'Powder')->get();
        $shampoo = DB::table('ec_produk')->where('kategori', 'Shampoo')->get();
        return view('ecommerceProductPage', ['powder' => $powder, 'shampoo' => $shampoo]);
    }

    public function ecommerceProductDetail($id)
    {
        $data = DB::table('ec_produk')->where('barang_id', $id)->first();
        if (!$data) {
            return redirect('/ecommerceProductPage');
        }
        return view('ecommerceProductDetail', ['data' => $data]);
    }
}