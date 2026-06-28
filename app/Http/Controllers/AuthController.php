<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Buat manggil database

class AuthController extends Controller
{
    // Nampilin halaman form login
    public function showLogin() {
        return view('auth.login');
    }

    // Proses cek login (Gantiin proses_login.php)
    public function prosesLogin(Request $request) {
        $email = $request->input('email');
        $password = $request->input('password');

        // Cari user di database (Ubah tb_users jadi users)
        $user = DB::table('users')->where('email', $email)->where('password', $password)->first();

        if ($user) {
            // Set session kalau berhasil login
            session([
                'user_id' => $user->user_id,
                'nama' => $user->nama,
                'role' => $user->role,
                'status' => 'sudah_login'
            ]);

            // Cek role untuk redirect
            if ($user->role == 'admin') {
                return redirect('/admin/dashboard');
            } else {
                return redirect('/'); // Arahkan ke homepage
            }
        } else {
            // Kalau gagal, balik ke halaman login bawa pesan error
            return back()->with('error', 'Email atau Password salah cuy! Coba lagi.');
        }
    }

    public function logout() {
        session()->flush(); // Hapus semua session
        return redirect('/')->with('success', 'Berhasil Logout!');
    }

    // Nampilin halaman form register
    public function showRegister() {
        return view('auth.register');
    }

    // Proses daftar (Gantiin proses_register.php)
    public function prosesRegister(Request $request) {
        $nama = $request->input('nama');
        $email = $request->input('email');
        $password = $request->input('password');

        // Cek email udah ada atau belum (Ubah tb_users jadi users)
        $cek_email = DB::table('users')->where('email', $email)->first();

        if ($cek_email) {
            return back()->with('error', 'Email sudah terdaftar cuy! Gunakan email lain.');
        } else {
            // Insert ke database kalau email aman (Ubah tb_users jadi users)
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