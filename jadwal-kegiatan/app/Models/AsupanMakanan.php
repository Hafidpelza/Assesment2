<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsupanMakanan extends Model
{
    protected $fillable = [
        'nama_makanan',
        'porsi',
        'satuan',
        'kalori_per_satuan',
        'total_kalori',
        'tanggal_konsumsi',
        'catatan'
    ];
}
