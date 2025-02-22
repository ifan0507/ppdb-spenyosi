<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\PortalController;
use Illuminate\Support\Facades\Route;

// Beranda
Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');

// Portal
Route::get('/portal', [PortalController::class, 'index'])->name('portal');
