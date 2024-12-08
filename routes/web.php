<?php

use App\Models\Peminjaman;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\WEB\KTPWebController;
use App\Http\Controllers\FullCalenderController;
use App\Http\Controllers\AdminActivityController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(
    function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::get('/export-pdf', [PeminjamanController::class, 'exportPDF'])->name('export.pdf');
    }
);

// Rute untuk user admin
Route::middleware(['role:admin,DPM,KADEP'])->group(function () {
    Route::get('/admin/activities', [AdminActivityController::class, 'index'])->name('admin.activities');
    Route::get('/admin/activities/export', [AdminActivityController::class, 'export'])->name('admin.activities.export');
    Route::get('/import', function () {
        return view('ktp.import');
    })->name('import');

    Route::get('ruangans', [RuanganController::class, 'index'])->name('ruangans.index');
    Route::get('ruangans/create', [RuanganController::class, 'create'])->name('ruangans.create');
    Route::post('ruangans', [RuanganController::class, 'store'])->name('ruangans.store');
    Route::get('ruangans/{ruangan}/edit', [RuanganController::class, 'edit'])->name('ruangans.edit');
    Route::put('ruangans/{ruangan}', [RuanganController::class, 'update'])->name('ruangans.update');
    Route::delete('ruangans/{ruangan}', [RuanganController::class, 'destroy'])->name('ruangans.destroy');

    Route::get('peminjaman', [PeminjamanController::class, 'viewTable'])->name('peminjaman.viewTable');
    Route::get('peminjaman/create', [PeminjamanController::class, 'create'])->name('peminjaman.create');
    Route::post('peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');
    Route::get('peminjaman/{id}/edit', [PeminjamanController::class, 'edit'])->name('peminjaman.edit');
    Route::put('peminjaman/{id}', [PeminjamanController::class, 'update'])->name('peminjaman.update');
    Route::delete('peminjaman/{id}', [PeminjamanController::class, 'destroy'])->name('peminjaman.destroy');
    Route::patch('/peminjaman/{id}/update-status', [PeminjamanController::class, 'updateStatus'])->name('peminjaman.updateStatus');
    Route::resource('peminjaman', PeminjamanController::class);
});

// Route::resource('ktp', KTPWebController::class);

Route::middleware(['role:user'])->group(function () {
    // Rute untuk melihat riwayat peminjaman pengguna
    Route::get('/riwayat-peminjaman', [PeminjamanController::class, 'riwayatPeminjaman'])->name('riwayat.peminjaman');
    Route::get('/peminjaman/{id}/export-pdf', [PeminjamanController::class, 'exportPdf'])->name('peminjaman.exportPdf');
});

Route::get('pinjam-ruangan', [PeminjamanController::class, 'ViewPeminjaman'])->name('pinjam.ruangan');
Route::post('fullcalenderAjax', [PeminjamanController::class, 'ajax'])->name('fullcalenderAjax');






Route::get('/no-access/{role}', function ($role) {
    return view('no-access', ['role' => $role]);
})->name('no.access');

require __DIR__ . '/auth.php';
