<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function login(Request $request)
    {
        $request->validate(
            [
                'email' => 'required',
                'password' => 'required'
            ],
            [
                'email.required' => 'email harus diisi!',
                'password.required' => 'Password harus diisi!',
            ],
        );

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard-siswa');
        }

        return back()->withInput()->withErrors('Email or Password Incorrect!');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6',
        ]);

        $siswa = Register::where('email', $request->email)
            ->where('verification_code', $request->otp)
            ->first();

        if (!$siswa) {
            return response()->json(['message' => 'Kode OTP salah atau sudah kedaluwarsa'], 400);
        }

        $siswa->update([
            'email_verified_at' => now(),
            'verification_code' => null,
        ]);

        // Login user setelah verifikasi sukses
        Auth::guard('siswa')->login($siswa);

        // Redirect ke dashboard siswa
        return redirect()->route('dashboard-siswa')->with('success', 'Email berhasil diverifikasi dan Anda telah masuk!');
    }
}
