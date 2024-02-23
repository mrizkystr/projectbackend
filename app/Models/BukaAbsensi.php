<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukaAbsensi extends Model
{
    use HasFactory;

    protected $table = 'buka_absensi';

    protected $fillable = [
        'status',
    ];
}
