<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Keranjang extends Model
{
    /**
     * Nama tabel yang terhubung dengan model ini.
     */
    protected $table = 'ec_keranjang';

    /**
     * Primary key untuk model ini.
     */
    protected $primaryKey = 'keranjang_id';

    /**
     * Menonaktifkan fitur timestamps (created_at & updated_at).
     */
    public $timestamps = false;

    /**
     * Kolom yang diizinkan untuk diisi secara massal.
     */
    protected $fillable = [
        'user_id',
        'barang_id',
        'qty',
    ];

    /**
     * Mendefinisikan relasi ke model Produk.
     */
    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class, 'barang_id', 'barang_id');
    }

    /**
     * Mendefinisikan relasi ke model User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}