<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiGuru extends Model
{
    use HasFactory;

    protected $table = 'absensi_guru';

    protected $fillable = [
        'name',
        'attendance',
        'reason',
        'time',
    ];

    protected $casts = [
        'attendance' => 'string',
        'time' => 'datetime',
    ];

    protected $dates = [
        'time',
        'created_at',
    ];
}