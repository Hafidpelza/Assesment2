<?php

use App\Http\Controllers\KegiatanController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/kegiatan');
Route::resource('kegiatan', KegiatanController::class);
