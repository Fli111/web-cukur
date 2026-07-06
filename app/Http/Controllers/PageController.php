<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barber; // Panggil model Barber di sini
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function book(Request $request)
    {
        $service = $request->query('service');
        $price = $request->query('price');
        
        // Ambil semua data barber dari database (menggantikan mysqli_query)
        $barbers = Barber::all();
        
        return view('book', compact('service', 'price', 'barbers'));
    }

    public function login()
    {
        return view('login');
    }

    public function create()
    {
        return view('create');
    }

    public function tanggalBook(Request $request)
    {
        $artisan = $request->query('artisan');
        $service = $request->query('service');
        $price = $request->query('price');

        // Cari data barber berdasarkan ID (menggantikan query mysqli)
        $dataBarber = Barber::where('barber_id', $artisan)->first();

        // Jika data tidak ada, kembalikan ke home
        if(!$dataBarber || empty($service) || empty($price)){
            return redirect()->route('home');
        }

        return view('tanggal_book', compact('artisan', 'service', 'price', 'dataBarber'));
    }




    
    //ecommerce gilang
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