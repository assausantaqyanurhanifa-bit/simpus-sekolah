<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;

// ===== Rute yang tidak butuh login =====
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login.submit');
});

Route::post('logout', [LoginController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// ===== Rute yang WAJIB login =====
Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('anggota', AnggotaController::class)->except('show');
    Route::resource('buku', BukuController::class)->except('show');
    Route::resource('peminjaman', PeminjamanController::class)->only(['index', 'create', 'store']);

    Route::post('peminjaman/{id}/kembali', [PeminjamanController::class, 'kembalikanBuku'])->name('peminjaman.kembali');
    Route::get('laporan', [PeminjamanController::class, 'laporan'])->name('laporan');
});