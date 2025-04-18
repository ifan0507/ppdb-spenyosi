<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
// routes/api.php
// routes/api.php
Route::middleware('auth:web')->get('/notifications/count', function (Request $request) {
    return response()->json([
        'count' => $request->user()->unreadNotifications->count()
    ]);
});
