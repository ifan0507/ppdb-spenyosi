<?php

use App\Http\Controllers\client\BerandaController;
use App\Http\Controllers\client\PortalController;
use App\Http\Controllers\client\RegisterController;
use Illuminate\Support\Facades\Route;

// Beranda
Route::get('/', [BerandaController::class, 'index'])->name('beranda');

// Portal
Route::get('/portal', [PortalController::class, 'index'])->name('portal');

// Register
Route::get('/regist', [RegisterController::class, 'regist'])->name('regist');
Route::get('/register/umum', [RegisterController::class, 'registUmum'])->name('register.umum');