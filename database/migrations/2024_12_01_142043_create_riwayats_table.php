<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('riwayats', function (Blueprint $table) {
            $table->id(); // Kolom ID otomatis
            $table->string('tanggal_peminjaman'); // Kolom untuk tanggal peminjaman
            $table->string('id_peminjam'); // Kolom untuk ID peminjam
            $table->string('nama_ruangan'); // Kolom untuk nama ruangan
            $table->string('tipe_ruangan'); // Kolom untuk tipe ruangan
            $table->string('kapasitas'); // Kolom untuk kapasitas ruangan
            $table->string('fasilitas'); // Kolom untuk fasilitas ruangan
            $table->timestamps(); // Kolom untuk created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayats');
    }
};
