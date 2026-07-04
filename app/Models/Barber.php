<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barber extends Model
{
    // Beritahu Laravel kalau primary key-nya adalah barber_id
    protected $primaryKey = 'barber_id';

    // Matikan fitur timestamps karena tabel barbers tidak punya created_at & updated_at
    public $timestamps = false;
}