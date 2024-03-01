<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';

    protected $fillable = [
        'data_siswa_id',
        'class',
        'departement',
        'attendance',
        'reason',
        'date_time'
    ];

    protected $casts = [
        'attendance' => 'string',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function siswa()
    {
        return $this->belongsTo(DataSiswa::class, 'data_siswa_id');
    }

}