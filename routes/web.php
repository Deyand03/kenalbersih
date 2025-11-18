<?php

use App\Http\Controllers\HomepageController;
use App\Http\Controllers\JadwalAngkutController;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RtController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomepageController::class, 'index'])->name('homepage');
Route::get('/jadwal-angkut', [HomepageController::class, 'data_jadwal'])->name('data_jadwal');
Route::get('/getTahunByRt', [HomepageController::class, 'fetchTahun'])->name('fetch.tahun');
Route::get('/laporan_sampah', [NavigationController::class, 'laporan_sampah'])->name('laporan_sampah');

// tambahin middleware role rt

Route::middleware(['auth', 'role:rt'])->group(function () {

    Route::get('/dashboard', [RtController::class, 'index'])->name('dashboard');
    Route::prefix('rt')->name('rt.')->group(function () {
        Route::controller(RtController::class)->group(function() {
            Route::get('/jadwal/events', 'getEvents')->name('jadwal.events');
            Route::post('/jadwal/store', 'storeEvent')->name('jadwal.store');
            Route::post('/jadwal/update/{id}', 'updateEvent')->name('jadwal.update');
            Route::post('/jadwal/delete/{id}', 'deleteEvent')->name('jadwal.delete');
        });

    });
});

require __DIR__.'/auth.php';

