<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Booking; // 1. Tambahkan model Booking di sini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    // Menampilkan Dashboard Admin (Etalase Produk)
    public function dashboard()
    {
        $produk = Produk::orderBy('barang_id', 'desc')->get();
        return view('admin.dashboard', compact('produk'));
    }

    // Menampilkan Jadwal Booking Masuk
    public function bookings()
    {
        // 2. Mengambil semua data booking beserta relasi user, barber, dan service
        $bookings = Booking::with(['user', 'barber', 'service'])
                           ->orderBy('tanggal', 'desc')
                           ->orderBy('waktu', 'asc')
                           ->get();

        // Diarahkan ke folder views/admin/bookings.blade.php
        return view('admin.bookings', compact('bookings'));
    }

    // Menampilkan Form Tambah Produk
    public function create()
    {
        return view('admin.tambah_produk');
    }

    // Proses Simpan Produk Baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'gambar_produk' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi_produk' => 'required|string',
        ]);

        $gambar = $request->file('gambar_produk');
        $nama_file = time() . "_" . $gambar->getClientOriginalName();
        $gambar->move(public_path('uploads'), $nama_file);

        Produk::create([
            'nama_produk' => $request->nama_produk,
            'kategori' => $request->kategori,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'gambar_produk' => $nama_file,
            'deskripsi_produk' => $request->deskripsi_produk
        ]);

        return redirect('/admin/dashboard')->with('success', 'Barang baru sukses masuk ke etalase.');
    }

    // Menampilkan Form Edit Produk
    public function edit($id)
    {
        $data = Produk::find($id);
        if (!$data) return redirect('/admin/dashboard');

        return view('admin.edit_produk', compact('data'));
    }

    // Proses Update Produk
    public function update(Request $request, $id)
    {
        $produk = Produk::find($id);
        if (!$produk) return redirect('/admin/dashboard');

        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'gambar_produk' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi_produk' => 'required|string',
        ]);

        $data_update = [
            'nama_produk' => $request->nama_produk,
            'kategori' => $request->kategori,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'deskripsi_produk' => $request->deskripsi_produk
        ];

        if ($request->hasFile('gambar_produk')) {
            $gambar = $request->file('gambar_produk');
            $nama_file = time() . "_" . $gambar->getClientOriginalName();
            $gambar->move(public_path('uploads'), $nama_file);
            
            $data_update['gambar_produk'] = $nama_file;
        }

        $produk->update($data_update);

        return redirect('/admin/dashboard')->with('success', 'Mantap! Data produk berhasil diupdate.');
    }

    // Proses Hapus Produk
    public function destroy($id)
    {
        Produk::destroy($id);
        return redirect('/admin/dashboard')->with('success', 'Sukses! Barang berhasil dihapus dari etalase.');
    }
}