<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiMapel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'class',
        'departement',
        'attendance',
        'mapel',
        'reason',
        'date_time',
    ];

    public function getAttendanceLabelAttribute()
    {
        return match ($this->attendance) {
            'hadir' => 'Hadir',
            'izin' => 'Izin',
            'sakit' => 'Sakit',
            'alfa' => 'Alfa',
        };
    }
}