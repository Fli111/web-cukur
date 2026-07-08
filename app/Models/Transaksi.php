<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaksi extends Model
{
    /**
     * Nama tabel yang terhubung dengan model ini.
     *
     * @var string
     */
    protected $table = 'ec_transaksi';

    /**
     * Primary key untuk model ini.
     *
     * @var string
     */
    protected $primaryKey = 'transaksi_id';

    /**
     * Memberitahu Eloquent bahwa kolom 'created_at' kita bernama 'tanggal_transaksi'.
     */
    const CREATED_AT = 'tanggal_transaksi';

    /**
     * Menonaktifkan kolom 'updated_at'.
     */
    const UPDATED_AT = null;

    /**
     * Kolom yang diizinkan untuk diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'total_harga',
        'alamat_pengiriman',
        'metode_pembayaran',
        'opsi_pengiriman',
        'status_pesanan',
    ];

    /**
     * Mendefinisikan relasi "one-to-many" ke DetailTransaksi.
     * Satu transaksi bisa punya banyak detail item.
     */
    public function detailItems(): HasMany
    {
        // Asumsi kamu akan membuat model DetailTransaksi juga
        return $this->hasMany(DetailTransaksi::class, 'transaksi_id', 'transaksi_id');
    }
}