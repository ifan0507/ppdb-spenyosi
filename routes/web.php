<?php

use App\Http\Controllers\client\BerandaController;
use App\Http\Controllers\client\LoginController;
use App\Http\Controllers\client\PortalController;
use App\Http\Controllers\client\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VerificationController;

// Beranda
Route::get('/', [BerandaController::class, 'index'])->name('beranda');

// Portal
Route::get('/portal', [PortalController::class, 'index'])->name('portal');

// Register
Route::get('/regist', [RegisterController::class, 'regist'])->name('regist');
Route::get('/register/umum', [RegisterController::class, 'registUmum'])->name('register.umum');
Route::get('/register/khusus', [RegisterController::class, 'registKhusus'])->name('register.khusus');
Route::post('/register-khusus', [RegisterController::class, 'registerKhusus'])->name('registerKhusus');
Route::post('/register-umum', [RegisterController::class, 'registerUmum'])->name('registerUmum');

<<<<<<< HEAD
// Login
Route::get('/login', [LoginController::class, 'loginView'])->name('login');
Route::middleware('auth:siswa')->group(function () {
    Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->middleware('signed')->name('verification.verify');
    Route::post('/email/verification-notification', [VerificationController::class, 'resend'])->middleware('throttle:6,1')->name('verification.send');
});
=======
// Route::middleware('auth:siswa')->group(function () {
//     Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');
//     Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->middleware('signed')->name('verification.verify');
//     Route::post('/email/verification-notification', [VerificationController::class, 'resend'])->middleware('throttle:6,1')->name('verification.send');
// });

Route::post('/verify', [LoginController::class, 'verify']);


>>>>>>> a18f6aa4294373da108cc94e81c3dfa3f2d247e0
Route::post('/login-siswa', [LoginController::class, 'login']);
// Dashboard hanya untuk pengguna yang sudah verifikasi
Route::get('/dashboard-siswa', function () {
    return view('siswa.dashboard');
})->middleware(['auth:siswa'])->name('dashboard-siswa');
