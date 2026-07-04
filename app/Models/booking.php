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
    ];
}