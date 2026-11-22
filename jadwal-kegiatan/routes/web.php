<?php

use App\Http\Controllers\AsupanMakananController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\KegiatanController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/kegiatan');

Route::resource('kegiatan', KegiatanController::class);
Route::resource('exercise', ExerciseController::class)->only(['index', 'store', 'update', 'destroy']);
Route::resource('asupan-makanan', AsupanMakananController::class);