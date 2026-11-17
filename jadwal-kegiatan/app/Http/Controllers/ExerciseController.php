<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    public function index(Request $request)
    {
        $exercises = Exercise::latest()->get();
        $activeExercise =$request->has('id')
            ? Exercise::find($request->id)
            : $exercises->first();

        return view('exercise.index', compact('exercises', 'activeExercise'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'kategori' => 'required|string|max:100',
            'durasi_detik' => 'required|integer|min:10',
            'deskripsi' => 'required|string',
        ]);

        $exercise = Exercise::create([
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'durasi_detik' => $request->durasi_detik,
            'deskripsi' => $request->deskripsi,
            'intensitas' => 'Medium Intensity',
            'tipe' => 'Bodyweight',
            'est_burn' => 10,
            'heart_rate' => 135,
            'cardio_load' => 75,
            'primary_muscle' => 'Full Body',
            'secondary_muscles' => 'Core, Legs, Arms',
        ]);

        return redirect()->route('exercise.index', ['id' => $exercise->id])
            ->with('success', 'Gerakan exercise berhasil ditambahkan!');
    }

    public function update(Request $request,$id)
    {
        $exercise = Exercise::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:100',
            'kategori' => 'required|string|max:100',
            'durasi_detik' => 'required|integer|min:10',
            'deskripsi' => 'required|string',
        ]);

        $exercise->update([
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'durasi_detik' => $request->durasi_detik,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('exercise.index', ['id' => $exercise->id])
            ->with('success', 'Data exercise berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $exercise = Exercise::find($id);
        if ($exercise) {$exercise->delete();
        }

        return redirect()->route('exercise.index')
            ->with('success', 'Gerakan exercise berhasil dihapus.');
    }
}