<?php

use App\Http\Controllers\client\BerandaController;
use App\Http\Controllers\client\LoginController;
use App\Http\Controllers\client\PortalController;
use App\Http\Controllers\client\RegisterController;
use App\Http\Controllers\siswa\DashboardController;
use App\Http\Controllers\siswa\Pendaftaran;
use App\Http\Controllers\siswa\RaportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Auth;

// Beranda
Route::get('/', [BerandaController::class, 'index'])->name('beranda');

// Portal
Route::get('/portal', [PortalController::class, 'index'])->name('portal');

// Register
Route::get('/regist', [RegisterController::class, 'regist'])->name('regist');
Route::get('/register/umum', [RegisterController::class, 'registUmum'])->name('register.umum');
Route::get('/register/khusus', [RegisterController::class, 'registKhusus'])->name('register.khusus');


// Register
Route::post('/register-khusus', [RegisterController::class, 'registerKhusus'])->name('registerKhusus');
Route::post('/register-umum', [RegisterController::class, 'registerUmum'])->name('registerUmum');
Route::post('/register-khusus', [RegisterController::class, 'registerKhusus'])->name('registerKhusus');
Route::post('/register-umum', [RegisterController::class, 'registerUmum'])->name('registerUmum');

// route verikasi 
Route::get('/verify-email', function () {
    if (Auth::guard('siswa')->check()) {
        return redirect('/dashboard-siswa');
    }
    if (!session('email_verifikasi')) {
        return redirect('/');
    }
    return view('auth.verify-email', ['email' => session('email_verifikasi')]);
})->name('verify.email')->middleware('cache_verify');
Route::post('/verify', [LoginController::class, 'verify']);

// Login
Route::get('/login', [LoginController::class, 'loginView'])->name('login')->middleware('cache_verify');
Route::post('/login-siswa', [LoginController::class, 'login'])->name('login.post');
// Dashboard hanya untuk pengguna yang sudah verifikasi

Route::middleware(['auth:siswa', 'auth', 'cache_verify'])->group(function () {
    Route::get('/dashboard-siswa', [DashboardController::class, 'index'])->name('dashboard-siswa');

    // Raport
    Route::get('/raport', [RaportController::class, 'index'])->name('raport');
    Route::get('/form-raport', [RaportController::class, 'create'])->name('form-raport');
    Route::post('/form-raport', [RaportController::class, 'store'])->name('form-raport.post');
    Route::get('/raport/{id}', [RaportController::class, 'edit'])->name('edit-raport');
    Route::put('/raport/{id}', [RaportController::class, 'update'])->name('update-raport');

    // Pendaftaran
    Route::get('/pendaftaran', [Pendaftaran::class, 'index'])->name('pendaftaran');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});
