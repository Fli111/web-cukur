<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class RegisterController extends Controller
{
    // Nampilin halaman form register
    public function showRegister() {
        return view('auth.register');
    }

    // Proses daftar akun baru
    public function prosesRegister(Request $request) {
        $nama = $request->input('nama');
        $email = $request->input('email');
        $password = $request->input('password');

        // Cek email udah ada atau belum di tabel users
        $cek_email = DB::table('users')->where('email', $email)->first();

        if ($cek_email) {
            return back()->with('error', 'Email sudah terdaftar cuy! Gunakan email lain.');
        } else {
            // Insert ke database kalau email aman
            DB::table('users')->insert([
                'nama' => $nama,
                'email' => $email,
                'password' => $password,
                'role' => 'member'
            ]);
            
            return redirect('/login')->with('success', 'Akun berhasil dibuat! Silakan login untuk mulai belanja.');
        }
    }
}