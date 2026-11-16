<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = [
        'nama',
        'kategori',
        'deskripsi',
        'intensitas',
        'durasi_detik',
        'tipe',
        'est_burn',
        'heart_rate',
        'cardio_load',
        'primary_muscle',
        'secondary_muscles',
    ];
}