<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Proses Register
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email', // otomatis cek email dobel
            'password' => 'required|min:8'
        ]);

        // Simpan ke database
        User::create([
            'nama' => $request->nama, // Ubah bagian ini
            'email' => $request->email,
            'password' => Hash::make($request->password), 
        ]);

        // Kembalikan alert Javascript seperti kodemu sebelumnya
        return response("<script>
            alert('Account berhasil dibuat');
            window.parent.document.getElementById('popupFrame').src='".route('login')."';
        </script>");
    }

    // Proses Login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Tambahkan baris ini agar session benar-benar tersimpan!
            $request->session()->regenerate(); 

            return response("<script>
                alert('Login berhasil');
                window.parent.location.href='".route('home')."';
            </script>");
        } else {
            return response("<script>
                alert('Email atau password salah');
                window.history.back();
            </script>");
        }
    }
}