<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsupanMakananController;

// Halaman utama langsung ke aplikasi kita
Route::get('/', function () {
    return redirect()->route('asupan-makanan.index');
});

Route::resource('asupan-makanan', AsupanMakananController::class);
