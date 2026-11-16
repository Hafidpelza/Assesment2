<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    // READ (list) + form tambah + ringkasan, sesuai desain
    public function index()
    {
        $hariIni = Kegiatan::whereDate('tanggal_kegiatan', today());

        $durasiHariIni = Kegiatan::formatMenit((int) (clone $hariIni)->sum('total_menit'));
        $totalAktif    = (clone $hariIni)->count();   // aktif = kegiatan yang terjadwal hari ini
        $totalKegiatan = Kegiatan::count();

        $kegiatans = Kegiatan::orderByDesc('tanggal_kegiatan')
            ->orderByDesc('waktu_mulai')
            ->paginate(10);

        return view('kegiatan.index', compact('durasiHariIni', 'totalAktif', 'totalKegiatan', 'kegiatans'));
    }

    // CREATE
    public function store(Request $request)
    {
        $data = $this->validated($request);
        Kegiatan::create($data);

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil disimpan.');
    }

    // READ (detail)
    public function show(Kegiatan $kegiatan)
    {
        return view('kegiatan.show', compact('kegiatan'));
    }

    // UPDATE (form)
    public function edit(Kegiatan $kegiatan)
    {
        return view('kegiatan.edit', compact('kegiatan'));
    }

    // UPDATE (proses)
    public function update(Request $request, Kegiatan $kegiatan)
    {
        $kegiatan->update($this->validated($request));

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil diperbarui.');
    }

    // DELETE
    public function destroy(Kegiatan $kegiatan)
    {
        $kegiatan->delete();

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'nama_kegiatan'    => ['required', 'string', 'max:100'],
            'tanggal_kegiatan' => ['required', 'date'],
            'waktu_mulai'      => ['required', 'date_format:H:i'],
            'waktu_selesai'    => ['required', 'date_format:H:i', 'after:waktu_mulai'],
        ], [
            'waktu_selesai.after' => 'Waktu selesai harus setelah waktu mulai.',
        ]);

        $mulai   = Carbon::createFromFormat('H:i', $data['waktu_mulai']);
        $selesai = Carbon::createFromFormat('H:i', $data['waktu_selesai']);
        $data['total_menit'] = (int) abs($mulai->diffInMinutes($selesai));

        return $data;
    }
}
