<?php

use App\Http\Controllers\client\BerandaController;
use App\Http\Controllers\client\PortalController;
use Illuminate\Support\Facades\Route;

// Beranda
Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');

// Portal
Route::get('/portal', [PortalController::class, 'index'])->name('portal');
