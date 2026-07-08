<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailTransaksi extends Model
{
    /**
     * Nama tabel yang terhubung dengan model ini.
     *
     * @var string
     */
    protected $table = 'ec_detail_transaksi';

    /**
     * Menonaktifkan fitur timestamps (created_at & updated_at).
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Kolom yang diizinkan untuk diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'transaksi_id',
        'barang_id',
        'qty',
        'harga_satuan',
    ];

    public function produk(): BelongsTo
    {
        // Nanti kamu bisa buat model Produk dan hubungkan di sini
        return $this->belongsTo(Produk::class, 'barang_id', 'barang_id');
    }

    /**
     * Mendefinisikan relasi ke model Transaksi.
     */
    public function transaksi(): BelongsTo
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id', 'transaksi_id');
    }
}