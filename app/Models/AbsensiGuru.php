<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiGuru extends Model
{
    use HasFactory;

    protected $table = 'absensi_guru';

    protected $fillable = [
        'data_guru_id',
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

    public function guru()
    {
        return $this->belongsTo(DataGuru::class, 'data_guru_id');
    }
}