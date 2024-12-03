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
        Schema::table('peminjamans', function (Blueprint $table) {
            $table->foreignId('ruangan_id')->constrained('ruangans')->onDelete('cascade'); // Relasi dengan tabel ruangans
            $table->time('jam_mulai'); // Kolom untuk jam mulai peminjaman
            $table->time('jam_selesai'); // Kolom untuk jam selesai peminjaman
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ruangans', function (Blueprint $table) {
            //
        });
    }
};
