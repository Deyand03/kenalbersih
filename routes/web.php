<?php

use App\Http\Controllers\HomepageController;
use App\Http\Controllers\JadwalAngkutController;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RtController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomepageController::class, 'index'])->name('homepage');
Route::get('/jadwal-angkut', [HomepageController::class, 'data_jadwal'])->name('data_jadwal');
Route::get('/getTahunByRt', [HomepageController::class, 'fetchTahun'])->name('fetch.tahun');
Route::get('/laporan_sampah', [NavigationController::class, 'laporan_sampah'])->name('laporan_sampah');

<<<<<<< HEAD
Route::get('/about', [AboutController::class, 'about'])->name('about');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
=======
// tambahin middleware role rt
>>>>>>> ee9dcfb64be16e43c7f1ffce30e73470647f8544

Route::middleware(['auth', 'role:rt'])->group(function () {
    Route::get('/dashboard', [RtController::class, 'index'])->name('dashboard');
});

require __DIR__.'/auth.php';

