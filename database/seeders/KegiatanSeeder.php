<?php

namespace Database\Seeders;

use App\Models\Kegiatan;
use Illuminate\Database\Seeder;

class KegiatanSeeder extends Seeder
{
    public function run(): void
    {
        Kegiatan::create([
            'nama_kegiatan' => 'Chest Day', 'tanggal_kegiatan' => '2026-06-01',
            'waktu_mulai' => '06:30', 'waktu_selesai' => '10:00', 'total_menit' => 210,
        ]);
        Kegiatan::create([
            'nama_kegiatan' => 'Leg Day', 'tanggal_kegiatan' => '2026-06-04',
            'waktu_mulai' => '10:00', 'waktu_selesai' => '15:30', 'total_menit' => 330,
        ]);
    }
}
