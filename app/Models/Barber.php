<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barber extends Model
{
    protected $table = 'barbers';
    protected $primaryKey = 'barber_id';
    public $timestamps = false;
}
