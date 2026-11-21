<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asupan_makanans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_makanan');
            $table->decimal('porsi', 8, 2);
            $table->string('satuan');
            $table->decimal('kalori_per_satuan', 8, 2);
            $table->decimal('total_kalori', 10, 2);
            $table->date('tanggal_konsumsi');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asupan_makanans');
    }
};
