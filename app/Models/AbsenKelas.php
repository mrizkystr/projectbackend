<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbsenKelas extends Model
{
    protected $fillable = [
        'jumlah_murid_masuk',
        'jumlah_murid_tidak_masuk',
        'keterangan',
    ];
}
