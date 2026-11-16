<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $table = 'kegiatans';

    protected $fillable = [
        'nama_kegiatan',
        'tanggal_kegiatan',
        'waktu_mulai',
        'waktu_selesai',
        'total_menit',
    ];

    protected $casts = [
        'tanggal_kegiatan' => 'date',
    ];

    /** Format "3 jam/30 menit" (dipakai di tabel) */
    public function getTotalWaktuAttribute(): string
    {
        return self::formatMenit($this->total_menit, '/');
    }

    /** Format "06:30-10:00" */
    public function getRentangWaktuAttribute(): string
    {
        return substr($this->waktu_mulai, 0, 5) . '-' . substr($this->waktu_selesai, 0, 5);
    }

    public static function formatMenit(int $menit, string $pemisah = ' '): string
    {
        $jam = intdiv($menit, 60);
        $sisa = $menit % 60;

        return "{$jam} jam{$pemisah}{$sisa} menit";
    }
}
