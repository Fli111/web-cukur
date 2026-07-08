<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    /**
     * Nama tabel yang terhubung dengan model ini.
     */
    protected $table = 'ec_produk';

    /**
     * Primary key untuk model ini.
     */
    protected $primaryKey = 'barang_id';

    /**
     * Menonaktifkan fitur timestamps (created_at & updated_at).
     */
    public $timestamps = false;

    /**
     * Kolom yang diizinkan untuk diisi secara massal.
     */
    protected $fillable = [
        'nama_produk',
        'kategori',
        'harga',
        'stok',
        'gambar_produk',
        'deskripsi_produk', // Sesuai dengan AdminController, nama kolomnya 'deskripsi_produk'
    ];
}