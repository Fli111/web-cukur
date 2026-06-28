<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function homepage() {
        // Ambil 5 produk terbaru
        $produk = DB::table('ec_produk')->orderBy('barang_id', 'desc')->limit(5)->get();
        return view('homepage', ['produk' => $produk]);
    }

    public function productpage() {
        // Pisahin berdasarkan kategori
        $powder = DB::table('ec_produk')->where('kategori', 'Powder')->get();
        $shampoo = DB::table('ec_produk')->where('kategori', 'Shampoo')->get();
        return view('productpage', ['powder' => $powder, 'shampoo' => $shampoo]);
    }

    public function productdetail($id) {
        $data = DB::table('ec_produk')->where('barang_id', $id)->first();
        if (!$data) {
            return redirect('/productpage');
        }
        return view('productdetail', ['data' => $data]);
    }
}