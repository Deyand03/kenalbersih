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
});

require __DIR__.'/auth.php';

