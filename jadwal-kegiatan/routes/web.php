<?php

use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\AsupanMakananController;
use Illuminate\Support\Facades\Route;


Route::redirect('/', '/kegiatan');
Route::resource('kegiatan', KegiatanController::class);

// Rute CRUD Exercise (Bagian Qidam)
Route::resource('exercise', ExerciseController::class)->only(['index', 'store', 'update', 'destroy']);

//RUTE CRUD ASUPAN MAKANAN (BAGIAN TIARA)
Route::resource('asupan-makanan', AsupanMakananController::class);
