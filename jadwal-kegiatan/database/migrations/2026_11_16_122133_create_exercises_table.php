<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->string('nama');              // Contoh: Jumping Jack
            $table->string('kategori');          // Contoh: CARDIO / PLYOMETRICS
            $table->text('deskripsi');           // Deskripsi gerakan
            $table->string('intensitas');        // Contoh: High Intensity
            $table->integer('durasi_detik');     // Contoh: 60
            $table->string('tipe');              // Contoh: Bodyweight
            $table->integer('est_burn');         // Contoh: 12 (kcal/min)
            $table->integer('heart_rate');       // Contoh: 145 (bpm)
            $table->integer('cardio_load');      // Contoh: 85 (%)
            $table->string('primary_muscle');    // Contoh: Calves
            $table->string('secondary_muscles'); // Contoh: Shoulders, Glutes, Quadriceps
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};