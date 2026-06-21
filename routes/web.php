<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\JurnalPertemuanController;
use App\Http\Controllers\LaporanPerkembanganController;
use App\Http\Controllers\AiRekomendasiController;

Route::get('/', fn() => redirect()->route('login'));

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');
    Route::resource('siswa', SiswaController::class);
});

Route::middleware(['auth', 'role:guru_wali'])->prefix('guru')->name('guru.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'guru'])->name('dashboard');
    Route::resource('siswa', SiswaController::class);
    Route::resource('jurnal', JurnalPertemuanController::class);
    Route::resource('laporan', LaporanPerkembanganController::class);
    Route::post('/ai/rekomendasi/{siswa}', [AiRekomendasiController::class, 'generate'])->name('ai.rekomendasi');
});

Route::middleware(['auth', 'role:orang_tua'])->prefix('ortu')->name('ortu.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'ortu'])->name('dashboard');
});

Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'siswa'])->name('dashboard');
});