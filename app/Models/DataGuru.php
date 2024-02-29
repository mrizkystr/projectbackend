<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataGuru extends Model
{
    use HasFactory;

    protected $table = 'data_guru';

    protected $fillable = [
        'name',
        'NIP',
        'tanggal_lahir',
        'alamat',
        'guru_mapel',
    ];

    protected $dates = [
        'tanggal_lahir',
    ];
}
