<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barber;
use App\Models\Service;

class BookController extends Controller
{
    // Method untuk menampilkan halaman pilih barber (dulu book.php)
    public function pilihBarber($service_id)
    {
        // Ambil semua data barber
        $barbers = Barber::all();
        
        // Return view ke resources/views/booking/pilih_barber.blade.php
        return view('booking.pilih_barber', compact('barbers', 'service_id'));
    }

    // Method untuk menampilkan halaman pilih tanggal & jam (dulu tanggal_book.php)
    public function pilihTanggal(Request $request)
    {
        $artisan = $request->query('artisan');
        $service_id = $request->query('service_id');

        // Validasi jika user langsung akses tanpa pilih barber/service
        if (!$artisan || !$service_id) {
            return redirect('/');
        }

        $barber = Barber::find($artisan);
        $service = Service::find($service_id);

        return view('booking.tanggal_book', compact('barber', 'service'));
    }

    // Method untuk memproses simpan booking ke database
    public function simpanBooking(Request $request)
    {
        // Validasi input form
        $request->validate([
            'tanggal' => 'required|date',
            'jam' => 'required',
            'barber_id' => 'required',
            // ... field lain
        ]);

        // Simpan data ke database (pake model Booking)
        // Booking::create([...]);

        return redirect('/success')->with('message', 'Booking berhasil!');
    }
}