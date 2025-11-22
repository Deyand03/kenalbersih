<?php

use App\Http\Controllers\HomepageController;
use App\Http\Controllers\IuranController;
use App\Http\Controllers\LaporanSampahController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RtController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomepageController::class, 'index'])->name('homepage');
Route::get('/jadwal-angkut', [HomepageController::class, 'data_jadwal'])->name('data_jadwal');
Route::get('/getTahunByRt', [HomepageController::class, 'fetchTahun'])->name('fetch.tahun');
Route::get('/about', [AboutController::class, 'about'])->name('about');
Route::get('/pengeluaran', [PengeluaranController::class, 'index_warga'])->name('pengeluaran');

Route::middleware(['auth'])->group(function () {
    // Laporan sampah
    Route::get('/laporan-sampah', [LaporanSampahController::class, 'index_warga'])->name('laporan_sampah');
    Route::post('/laporan-sampah/store', [LaporanSampahController::class, 'store'])->name('laporan_sampah.store');
    // Iuran
    Route::get('/iuran', [IuranController::class, 'index_warga'])->name('iuran');
    Route::post('/iuran/store', [IuranController::class, 'storeWarga'])->name('iuran.store');
});

Route::middleware(['auth', 'role:rt'])->group(function () {
    Route::get('/dashboard', [RtController::class, 'index'])->name('dashboard');

    Route::prefix('rt')->name('rt.')->group(function () {
        // CRUD Jadwal Angkut
        Route::controller(RtController::class)->group(function () {
            Route::post('/volume/store', 'storeVolumeSampah')->name('volume.store');
            Route::get('/jadwal/events', 'getEvents')->name('jadwal.events');
            Route::post('/jadwal/store', 'storeEvent')->name('jadwal.store');
            Route::post('/jadwal/update/{id}', 'updateEvent')->name('jadwal.update');
            Route::post('/jadwal/delete/{id}', 'deleteEvent')->name('jadwal.delete');
        });
        // Laporan Sampah
        Route::controller(LaporanSampahController::class)->group(function () {
            Route::get('/laporan-sampah', 'index_rt')->name('laporan_sampah');
            Route::post('/laporan-sampah/update/{id}', 'updateStatus')->name('laporan_sampah.update');
        });
        // Iuran Warga
        Route::controller(IuranController::class)->group(function () {
            Route::get('/kelola-iuran', 'index_rt')->name('kelola.iuran');
            Route::post('/kelola-iuran/store', 'store')->name('kelola.iuran.store');
            Route::post('/kelola-iuran/verify/{id}', 'verify')->name('kelola.iuran.verify');
            Route::post('/kelola-iuran/settings', 'updateSettings')->name('kelola.iuran.settings');
            // Laporan Pengeluaran
            Route::controller(PengeluaranController::class)->group(function () {
                Route::get('/pengeluaran', 'index_rt')->name('pengeluaran');
                Route::post('/pengeluaran/store', 'store')->name('pengeluaran.store');
            });

        });
    });
});

require __DIR__ . '/auth.php';

