<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    // Menampilkan Dashboard Admin
    public function dashboard()
    {
        $produk = DB::table('ec_produk')->orderBy('barang_id', 'desc')->get();
        return view('admin.dashboard', compact('produk'));
    }

    // Menampilkan Form Tambah Produk
    public function create()
    {
        return view('admin.tambah_produk');
    }

    // Proses Simpan Produk Baru
    public function store(Request $request)
    {
        $gambar = $request->file('gambar_produk');
        $nama_file = time() . "_" . $gambar->getClientOriginalName();
        // Pindahkan file ke folder public/uploads
        $gambar->move(public_path('uploads'), $nama_file);

        DB::table('ec_produk')->insert([
            'nama_produk' => $request->nama_produk,
            'kategori' => $request->kategori,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'gambar_produk' => $nama_file,
            'deskripsi_produk' => $request->deskripsi
        ]);

        return redirect('/admin/dashboard')->with('success', 'Barang baru sukses masuk ke etalase.');
    }

    // Menampilkan Form Edit Produk
    public function edit($id)
    {
        $data = DB::table('ec_produk')->where('barang_id', $id)->first();
        if (!$data) return redirect('/admin/dashboard');

        return view('admin.edit_produk', compact('data'));
    }

    // Proses Update Produk
    public function update(Request $request, $id)
    {
        $data_update = [
            'nama_produk' => $request->nama_produk,
            'kategori' => $request->kategori,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'deskripsi_produk' => $request->deskripsi_produk
        ];

        // Cek kalau admin upload gambar 
        if ($request->hasFile('gambar_produk')) {
            $gambar = $request->file('gambar_produk');
            $nama_file = time() . "_" . $gambar->getClientOriginalName();
            $gambar->move(public_path('uploads'), $nama_file);
            
            $data_update['gambar_produk'] = $nama_file;
        }

        DB::table('ec_produk')->where('barang_id', $id)->update($data_update);

        return redirect('/admin/dashboard')->with('success', 'Mantap! Data produk berhasil diupdate.');
    }

    // Proses Hapus Produk
    public function destroy($id)
    {
        DB::table('ec_produk')->where('barang_id', $id)->delete();
        return redirect('/admin/dashboard')->with('success', 'Sukses! Barang berhasil dihapus dari etalase.');
    }
}