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
    // Mengambil tipe paket dari URL (misal: .../payment?paket=platinum)
    $paket = $request->query('paket', 'Gold'); 
    
    // Logika harga berdasarkan paket
    $harga = ($paket == 'platinum') ? 25000 : (($paket == 'diamond') ? 30000 : 20000);

    return view('member-payment', compact('paket', 'harga'));
}
}