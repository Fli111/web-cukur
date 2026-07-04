<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barber; // Panggil model Barber di sini

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
}