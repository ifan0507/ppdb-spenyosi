<?php

use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\BroadcastingController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\client\BerandaController;
use App\Http\Controllers\client\LoginController;
use App\Http\Controllers\client\PortalController;
use App\Http\Controllers\client\RegisterController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\siswa\DashboardController;
use App\Http\Controllers\siswa\OrtuController;
use App\Http\Controllers\siswa\Pendaftaran;
use App\Http\Controllers\siswa\RaportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Request;

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

// Login Siswa
Route::get('/auth/login', [LoginController::class, 'loginView'])->name('siswa-login')->middleware('cache_verify');
Route::post('/login-siswa', [LoginController::class, 'login'])->name('login.post');
// Dashboard hanya untuk pengguna yang sudah verifikasi

// Login admin
Route::get('/auth/master', [AuthController::class, 'loginView'])->name('admin.login')->middleware('cache_verify');
Route::post('/login-admin', [AuthController::class, 'login'])->name('admin.login.post');


Route::middleware(['cache_verify', 'auth_siswa'])->group(function () {

    Route::get('/siswa', [DashboardController::class, 'index'])->name('dashboard-siswa');
    Route::get('/siswa/edit-biodata', [DashboardController::class, 'edit'])->name('siswa.edit');
    Route::put('/siswa/update-biodata', [DashboardController::class, 'update'])->name('update-biodata');

    Route::get('/orang-tua', [OrtuController::class, 'index'])->name('ortu');
    Route::get('/orang-tua/{id}/edit', [OrtuController::class, 'edit'])->name('ortu.edit');
    route::put('/ortu/{id}/update', [OrtuController::class, 'update'])->name('ortu.update');

    Route::get('/raport', [RaportController::class, 'index'])->name('raport');
    Route::get('/form-raport', [RaportController::class, 'create'])->name('form-raport');
    Route::post('/form-raport', [RaportController::class, 'store'])->name('form-raport.post');
    Route::get('/raport/{id}', [RaportController::class, 'edit'])->name('edit-raport');
    Route::put('/raport/{id}', [RaportController::class, 'update'])->name('update-raport');

    // Pendaftaran
    Route::get('/pendaftaran', [Pendaftaran::class, 'index'])->name('pendaftaran');
    Route::post('/pendaftaran/${id}', [Pendaftaran::class, 'store'])->name('post.pendaftaran');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});

Broadcast::routes([
    'middleware' => ['custom_broadcast_auth', 'auth:web'],
]);
//Admin
Route::middleware(['cache_verify', 'auth_admin'])->group(function () {

    Route::get('/admin/notifikasi/read-all', function () {
        // AMAN MAKI ABANG MK INSTELENS TOK
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    })->name('notifikasi.read.all');

    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('dashboard-admin');
    Route::get('/admin/umum', [AdminDashboardController::class, 'viewUmum'])->name('umum');
    Route::get('/admin/afirmasi', [AdminDashboardController::class, 'viewAfirmasi'])->name('afirmasi');
    Route::get('/admin/pindah-tugas', [AdminDashboardController::class, 'viewpindahTugas'])->name('pindah.tugas');
    Route::get('/admin/tahfidz', [AdminDashboardController::class, 'viewTahfidz'])->name('tahfidz');
    Route::get('/admin/prestasi', [AdminDashboardController::class, 'viewPrestasi'])->name('prestasi');
    Route::get('/admin/{id}/confirm', [AdminDashboardController::class, 'confirm'])->name('admin.confirm');
    Route::post('/admin/{id}/decline', [AdminDashboardController::class, 'decline'])->name('admin.decline');
    Route::get('/admin/{id}/detail', [AdminDashboardController::class, 'detail'])->name('admin.detail');

    Route::get('/admin/logout', [AuthController::class, 'logout'])->name('logout-admin');
});
