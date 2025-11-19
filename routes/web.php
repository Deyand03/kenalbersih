<?php

use App\Http\Controllers\HomepageController;
use App\Http\Controllers\JadwalAngkutController;
use App\Http\Controllers\LaporanSampahController;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RtController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomepageController::class, 'index'])->name('homepage');
Route::get('/jadwal-angkut', [HomepageController::class, 'data_jadwal'])->name('data_jadwal');
Route::get('/getTahunByRt', [HomepageController::class, 'fetchTahun'])->name('fetch.tahun');
Route::get('/about', [AboutController::class, 'about'])->name('about');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/laporan_sampah', [LaporanSampahController::class, 'index_warga'])->name('laporan_sampah');
    Route::post('/laporan_sampah/store', [LaporanSampahController::class, 'store'])->name('laporan_sampah.store');
});

Route::middleware(['auth', 'role:rt'])->group(function () {

    Route::get('/dashboard', [RtController::class, 'index'])->name('dashboard');
    Route::prefix('rt')->name('rt.')->group(function () {

        // Laporan sampah Admin
        Route::get('/laporan_sampah', [LaporanSampahController::class, 'index_rt'])->name('laporan_sampah');
        Route::post('/laporan_sampah/update/{id}', [LaporanSampahController::class, 'updateStatus'])->name('laporan_sampah.update');

        // CRUD Jadwal Angkut
        Route::controller(RtController::class)->group(function () {
            Route::post('/volume/store', 'storeVolumeSampah')->name('volume.store');

            Route::get('/jadwal/events', 'getEvents')->name('jadwal.events');
            Route::post('/jadwal/store', 'storeEvent')->name('jadwal.store');
            Route::post('/jadwal/update/{id}', 'updateEvent')->name('jadwal.update');
            Route::post('/jadwal/delete/{id}', 'deleteEvent')->name('jadwal.delete');
        });

    });
});

require __DIR__ . '/auth.php';

