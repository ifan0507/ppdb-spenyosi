<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CustomBroadcastAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */



    public function handle($request, Closure $next)
    {
        Log::info('Auth Web:', [Auth::guard('web')->check()]);
        Log::info('Auth Siswa:', [Auth::guard('siswa')->check()]);


        // Cek auth dari 'web' (admin)
        if (Auth::guard('web')->check()) {
            $request->setUserResolver(fn() => Auth::guard('web')->user());
        }

        // Cek auth dari 'siswa'
        elseif (Auth::guard('siswa')->check()) {
            $request->setUserResolver(fn() => Auth::guard('siswa')->user());
        }

        return $next($request);
    }
}
