<?php

use App\Http\Controllers\client\BerandaController;
use App\Http\Controllers\client\LoginController;
use App\Http\Controllers\client\PortalController;
use App\Http\Controllers\client\RegisterController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Route;

// Beranda
Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');
// Portal
Route::get('/portal', [PortalController::class, 'index'])->name('portal');
// Register
Route::post('/register-khusus', [RegisterController::class, 'registerKhusus'])->name('registerKhusus');
Route::post('/register-umum', [RegisterController::class, 'registerUmum'])->name('registerUmum');
// Login

Route::middleware('auth:siswa')->group(function () {
    Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->middleware('signed')->name('verification.verify');
    Route::post('/email/verification-notification', [VerificationController::class, 'resend'])->middleware('throttle:6,1')->name('verification.send');
});

Route::post('/login-siswa', [LoginController::class, 'login']);
// Dashboard hanya untuk pengguna yang sudah verifikasi
// Route::get('/dashboard-siswa', function () {
//     return view('dashboard-siswa');
// })->middleware(['auth:siswa', 'verified']);
