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
    public function loginView()
    {
        return view('clients.login');
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
            'otp' => 'required|digits:6',
        ]);

        if ($request->otp != session('otp')) {
            return response()->json(['message' => 'Kode OTP salah atau sudah kedaluwarsa.'], 400);
        }
        $data = session('register_data');
        $siswa = Register::create([
            'nama_lengkap' => $data['nama_lengkap'],
            'nisn' => $data['nisn'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'jalur_ppdb' => session('jalur_ppdb'),
            'email_verified_at' => now(),
            'verification_code' => null,
        ]);

        Auth::guard('siswa')->login($siswa);
        session()->forget(['register_data', 'otp']);
        return response()->json(['redirect' => route('dashboard-siswa')]);
    }
}
