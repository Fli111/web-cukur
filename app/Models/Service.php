<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    // Beritahu Laravel kalau primary key-nya adalah service_id
    protected $primaryKey = 'service_id';

    // Matikan fitur timestamps karena tabel services tidak punya created_at & updated_at
    public $timestamps = false;

    // Kolom yang diizinkan untuk diisi
    protected $fillable = [
        'nama_service',
        'harga',
        'deskripsi',
    ];
}