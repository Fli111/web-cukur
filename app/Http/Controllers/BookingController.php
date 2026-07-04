<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barber;
use App\Models\Service;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // 1. Menampilkan daftar Barber
    public function showBarbers(Request $request) 
    {
        // Menggunakan Eloquent untuk mengambil semua data barber
        $barbers = Barber::all(); 
        $service_id = $request->query('service_id');

        // Pastikan kamu punya file blade di: resources/views/book.blade.php
        return view('book', compact('barbers', 'service_id'));
    }

    // 2. Menampilkan halaman pilih tanggal
    public function showTanggal(Request $request) 
    {
        // Cek login ala Laravel
        if (!Auth::check()) {
            return redirect()->route('home'); // Pastikan route 'home' sudah diberi nama di web.php
        }

        $artisan_id = $request->query('artisan');
        $service_id = $request->query('service_id');

        if (empty($artisan_id) || empty($service_id)) {
            return redirect()->route('home');
        }

        $dataBarber = Barber::find($artisan_id);
        $dataService = Service::find($service_id);

        // Pastikan kamu punya file blade di: resources/views/tanggal_book.blade.php
        return view('tanggal_book', compact('dataBarber', 'dataService'));
    }

    // 3. Memproses Booking (Sesuai dengan error trace sebelumnya, metodenya bernama 'store')
    public function store(Request $request) 
    {
        // 1. Cek Login
        if (!Auth::check()) {
            return response("<script>
                alert('Sistem mendeteksi kamu belum login! Silakan login ulang.'); 
                window.history.back();
            </script>");
        }

        try {
            // 2. Menerjemahkan format '01:45 PM' menjadi format MySQL '13:45:00'
            $jamDariForm = $request->input('jam');
            $jamUntukDatabase = date('H:i:s', strtotime($jamDariForm));

            // 3. Simpan data menggunakan waktu yang sudah dikonversi
            $booking = Booking::create([
                'user_id'    => Auth::id(),
                'barber_id'  => $request->input('artisan'),
                'service_id' => $request->input('service_id'),
                'tanggal'    => $request->input('tanggal'),
                'waktu'      => $jamUntukDatabase, // Gunakan variabel yang sudah diubah formatnya
                'status'     => 'pending',
            ]);

            // Jika sukses melewati Booking::create
            return response("<script>
                alert('Booking berhasil dibuat!'); 
                window.location.href='".url('/')."'; 
            </script>");

        } catch (\Exception $e) {
            // Kita tetap biarkan try-catch ini untuk jaga-jaga kalau ada error lain
            dd([
                "Pesan Error Database" => $e->getMessage(),
                "Data yang dikirim dari Form HTML" => $request->all()
            ]);
        }
    }
}