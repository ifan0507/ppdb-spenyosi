<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    // public function show()
    // {
    //     return view('auth.verify-email');
    // }

    // public function verify(EmailVerificationRequest $request)
    // {
    //     $request->fulfill();
    //     return redirect('/dashboard-siswa')->with('message', 'Email berhasil diverifikasi!');
    // }

    // public function resend(Request $request)
    // {
    //     if ($request->user()->hasVerifiedEmail()) {
    //         return redirect('/dashboard-siswa');
    //     }

    //     $request->user()->sendEmailVerificationNotification();
    //     return back()->with('message', 'Link verifikasi telah dikirim!');
    // }
}
