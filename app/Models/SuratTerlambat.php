<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratTerlambat extends Model
{
    use HasFactory;

    protected $table = 'surat_terlambat';

    protected $fillable = [
        'name',
        'reason',
        'date_time',
    ];

    protected $dates = [
        'date_time',
        'created_at',
        'updated_at',
    ];
}