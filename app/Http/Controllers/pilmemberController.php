<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pilmemberController extends Controller
{
    public function index()
    {
        return view('pilmember'); 
    }

   public function payment(Request $request)
{
    // Mengambil paket dari URL, default ke Gold
    $paket = $request->query('paket', 'gold'); 

    // Logika penentuan harga
    $harga = 20000; // Harga default Gold
    if ($paket == 'platinum') {
        $harga = 25000;
    } elseif ($paket == 'diamond') {
        $harga = 30000;
    }

    return view('member-payment', compact('paket', 'harga'));
}
}