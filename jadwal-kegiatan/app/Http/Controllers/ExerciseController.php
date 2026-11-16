<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    public function index(Request $request)
    {
        if (Exercise::count() === 0) {
            Exercise::create([
                'nama' => 'Jumping Jack',
                'kategori' => 'CARDIO / PLYOMETRICS',
                'deskripsi' => 'A total-body aerobic exercise that works your heart, lungs, and muscles at the same time.',
                'intensitas' => 'High Intensity',
                'durasi_detik' => 60,
                'tipe' => 'Bodyweight',
                'est_burn' => 12,
                'heart_rate' => 145,
                'cardio_load' => 85,
                'primary_muscle' => 'Calves',
                'secondary_muscles' => 'Shoulders, Glutes, Quadriceps',
            ]);
        }

        $exercises = Exercise::latest()->get();
        $activeExercise = $request->has('id')
            ? Exercise::findOrFail($request->id)
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
            // Nilai default otomatis agar tidak perlu diisi di form
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

    public function update(Request $request, $id)
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
        Exercise::findOrFail($id)->delete();

        return redirect()->route('exercise.index')
            ->with('success', 'Gerakan exercise berhasil dihapus.');
    }
}