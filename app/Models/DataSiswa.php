<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataSiswa extends Model
{
    protected $fillable = [
        'name',
        'NISN',
        'tanggal_lahir',
        'alamat',
        'kelas',
        'jurusan',
    ];
}
