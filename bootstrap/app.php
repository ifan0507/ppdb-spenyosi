<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            "cache_verify" => App\Http\Middleware\chace_verify::class,
            "cache_login" => App\Http\Middleware\cache_login::class,
            "custom_broadcast_auth" => App\Http\Middleware\CustomBroadcastAuth::class,
            "auth_admin" => App\Http\Middleware\AdminMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
