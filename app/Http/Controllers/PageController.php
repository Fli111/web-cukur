<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barber;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
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

        public function index()
    {
        return view('dashboard');
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
        $produk = Produk::orderBy('barang_id', 'desc')->get();
        return view('ecommerceHomePage', compact('produk')); // resources/views/ec_home.blade.php
    }

    public function ecommerceProductPage()
    {
        $powder  = Produk::where('kategori', 'Powder')->get();
        $shampoo = Produk::where('kategori', 'Shampoo')->get();
        return view('ecommerceProductPage', ['powder' => $powder, 'shampoo' => $shampoo]);
    }

    public function ecommerceProductDetail($id)
    {
        $data = Produk::find($id);
        if (!$data) {
            return redirect('/ecommerceProductPage');
        }
        return view('ecommerceProductDetail', ['data' => $data]);
    }

    /**
     * Menampilkan halaman riwayat belanja user yang sedang login.
     */
    public function showHistory()
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Ambil data transaksi milik user tersebut, urutkan dari yang terbaru
        // Gunakan 'with' untuk eager loading agar tidak terjadi N+1 query
        $transaksis = Transaksi::where('user_id', $user->user_id)
                                ->with('detailItems.produk') // Memuat relasi detailItems dan produk di dalamnya
                                ->orderBy('tanggal_transaksi', 'desc')
                                ->get();

        return view('history', compact('transaksis')); // Kirim data ke view 'history.blade.php'
    }
}