<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ruangans', function (Blueprint $table) {
            $table->id(); // Menambahkan kolom ID otomatis
            $table->string('nama_ruangan'); // Kolom untuk nama ruangan
            $table->string('tipe_ruangan'); // Kolom untuk tipe ruangan
            $table->string('kapasitas'); // Kolom untuk kapasitas
            $table->string('fasilitas'); // Kolom untuk fasilitas
            $table->string('status_ruangan'); // Kolom untuk status ruangan
            $table->timestamps(); // Kolom untuk created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruangans');
    }
};
