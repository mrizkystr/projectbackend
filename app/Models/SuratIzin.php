<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratIzin extends Model
{
    use HasFactory;

    protected $table = 'surat_izin';

    protected $fillable = [
        'name',
        'class',
        'departement',
        'reason',
        'date_submission',
    ];

    protected $dates = [
        'date_submission',
        'created_at',
        'updated_at',
    ];
} 