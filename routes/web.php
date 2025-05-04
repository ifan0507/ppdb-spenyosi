<?php

use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\BroadcastingController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\admin\InfoController;
use App\Http\Controllers\client\InfoController as ClientInfoController;
use App\Http\Controllers\client\BerandaController;
use App\Http\Controllers\client\LoginController;
use App\Http\Controllers\client\PortalController;
use App\Http\Controllers\client\RegisterController;

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\siswa\DashboardController;
use App\Http\Controllers\siswa\OrtuController;
use App\Http\Controllers\siswa\Pendaftaran;
use App\Http\Controllers\siswa\PenunjangController;
use App\Http\Controllers\siswa\RaportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Request;

// Beranda
Route::get('/', [BerandaController::class, 'index'])->name('beranda');

// Info Terkini
Route::get('/info-terkini', [ClientInfoController::class, 'index'])->name('info.lengkap');
Route::get('/info-terkini/detail/{id}', [ClientInfoController::class, 'detailInfo'])->name('info.detail');

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

    route::get('/prestasi', [PenunjangController::class, 'viewPrestasi'])->name('siswa.prestasi');
    Route::get('/prestasi/edit', [PenunjangController::class, 'editPrestasiLomba'])->name('prestasi.edit');
    Route::put('/prestasi/{id}/update', [PenunjangController::class, 'updatePrestasiLomba'])->name('prestasi.update');
    Route::get('/prestasi/create', [PenunjangController::class, 'createPrestasiLomba'])->name('prestasi.create');
    Route::post('/prestasi/store', [PenunjangController::class, 'storePrestasiLomba'])->name('prestasi.store');


    // Raport
    Route::get('/raport', [RaportController::class, 'index'])->name('raport');
    Route::get('/form-raport', [RaportController::class, 'create'])->name('form-raport');
    Route::post('/form-raport', [RaportController::class, 'store'])->name('form-raport.post');
    Route::get('/raport/{id}', [RaportController::class, 'edit'])->name('edit-raport');
    Route::put('/raport/{id}', [RaportController::class, 'update'])->name('update-raport');

    // Afirmasi
    Route::get('/afirmasi', [PenunjangController::class, 'siswaAfirmasi'])->name('siswa.afirmasi');
    Route::get('/afirmasi/{id}/edit', [PenunjangController::class, 'editAfirmasi'])->name('afirmasi.edit');
    Route::put('/afirmasi/{id}/update', [PenunjangController::class, 'updateAfirmasi'])->name('afirmasi.update');

    //PindahTugas
    Route::get('/mutasi', [PenunjangController::class, 'viewMutasi'])->name('siswa.mutasi');
    Route::get('/mutasi/edit', [PenunjangController::class, 'editMutasi'])->name('mutasi.edit');
    Route::put('/mutasi/{id}/update', [PenunjangController::class, 'updateMutasi'])->name('mutasi.update');

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
    Route::get('/admin/zonasi', [AdminDashboardController::class, 'viewZonasi'])->name('zonasi');
    Route::get('/admin/afirmasi', [AdminDashboardController::class, 'viewAfirmasi'])->name('afirmasi');
    Route::get('/admin/pindah-tugas', [AdminDashboardController::class, 'viewpindahTugas'])->name('pindah.tugas');
    Route::get('/admin/prestasi-akademik', [AdminDashboardController::class, 'viewAkademik'])->name('akademik');
    Route::get('/admin/raport', [AdminDashboardController::class, 'viewRaport'])->name('raport');

    Route::get('/admin/{id}/confirm', [AdminDashboardController::class, 'confirm'])->name('admin.confirm');
    Route::post('/admin/{id}/decline', [AdminDashboardController::class, 'decline'])->name('admin.decline');
    Route::get('/admin/{id}/detail', [AdminDashboardController::class, 'detail'])->name('admin.detail');

    Route::delete('/admin/notif/{id}/delete', [AdminDashboardController::class, 'notifDeleteById'])->name('delete-notif-byId');
    Route::delete('/admin/notif/delete-all', [AdminDashboardController::class, 'notifDeleteAll'])->name('delete-all-notif');

    Route::get('/admin/export/zonasi', [AdminDashboardController::class, 'exportZonasi'])->name('export.zonasi');



    Route::get('/admin/manajemen-info', [InfoController::class, 'index'])->name('admin.info');
    Route::post('/admin/info', [InfoController::class, 'store'])->name('info.post');
    Route::put('/admin/info/{id}/update', [InfoController::class, 'update'])->name('info.update');
    Route::delete('/admin/info{id}/delete', [InfoController::class, 'destroy'])->name('info.delete');
    Route::get('/admin/logout', [AuthController::class, 'logout'])->name('logout-admin');
});
