<?php

namespace App\Http\Controllers;

use App\Models\AsupanMakanan;
use Illuminate\Http\Request;

class AsupanMakananController extends Controller
{
    public function index()
    {
        $asupan = AsupanMakanan::latest()->get();
        return view('asupan-makanan.index', compact('asupan'));
    }

    public function create()
    {
        return view('asupan-makanan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_makanan'       => 'required|string|max:255',
            'porsi'              => 'required|numeric',
            'satuan'             => 'required|string|max:50',
            'kalori_per_satuan'  => 'required|numeric',
            'tanggal_konsumsi'   => 'required|date',
        ]);

        $data = $request->all();
        $data['total_kalori'] = $request->porsi * $request->kalori_per_satuan;

        AsupanMakanan::create($data);

        return redirect()->route('asupan-makanan.index')->with('success', '✅ Data berhasil ditambahkan!');
    }

    public function show(AsupanMakanan $asupanMakanan)
    {
        return view('asupan-makanan.show', compact('asupanMakanan'));
    }

    public function edit(AsupanMakanan $asupanMakanan)
    {
        return view('asupan-makanan.edit', compact('asupanMakanan'));
    }

    public function update(Request $request, AsupanMakanan $asupanMakanan)
    {
        $request->validate([
            'nama_makanan'       => 'required|string|max:255',
            'porsi'              => 'required|numeric',
            'satuan'             => 'required|string|max:50',
            'kalori_per_satuan'  => 'required|numeric',
            'tanggal_konsumsi'   => 'required|date',
        ]);

        $data = $request->all();
        $data['total_kalori'] = $request->porsi * $request->kalori_per_satuan;

        $asupanMakanan->update($data);

        return redirect()->route('asupan-makanan.index')->with('success', '✅ Data berhasil diperbarui!');
    }

    public function destroy(AsupanMakanan $asupanMakanan)
    {
        $asupanMakanan->delete();
        return redirect()->route('asupan-makanan.index')->with('success', '✅ Data berhasil dihapus!');
    }
}
