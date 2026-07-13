<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    // Beri tahu Laravel primary key-nya adalah book_id
    protected $primaryKey = 'book_id';

    // Tabel bookings milikmu punya 'created_at', tapi tidak punya 'updated_at'
    const UPDATED_AT = null;

    // Kolom-kolom yang boleh diisi secara langsung dari Controller
    protected $fillable = [
        'user_id',
        'barber_id',
        'service_id',
        'tanggal',
        'waktu',
        'status',
        'harga_final',    // ← tambah ini
        'diskon_persen',  // ← tambah ini
    ];
    // Relasi ke tabel users
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    // Relasi ke tabel barbers
    public function barber()
    {
        return $this->belongsTo(Barber::class, 'barber_id', 'barber_id');
    }

    // Relasi ke tabel services
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'service_id');
    }
}