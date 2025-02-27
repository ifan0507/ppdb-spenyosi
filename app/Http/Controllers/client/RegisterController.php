<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Mail\VerificationMail;
use App\Models\Register;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function regist()
    {
        return view('clients.regist');
    }

    public function registUmum()
    {
        return view('clients.umum');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function registerKhusus(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'nisn' => ['unique:registers,nisn', 'required'],
            'email' => ['unique:registers,email', 'required', 'email'],
            'password' => ['required'],
            'jalur_ppdb' => ['required'],
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nisn.unique' => 'NISN sudah terdaftar.',
            'email.unique' => 'Email sudah terdaftar.',
            'email.email' => 'Email harus valid.',
            'password.required' => 'Password wajib diisi.',
            'jalur_ppdb.required' => 'Jalur PPDB wajib dipilih.',
        ]);

        $siswa = Register::create([
            'nama_lengkap' => $request->nama_lengkap,
            'nisn' => $request->nisn,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'jalur_ppdb' => $request->jalur_ppdb,
        ]);

        event(new Registered($siswa));

        Auth::guard('siswa')->login($siswa);
        return redirect('/email/verify');
    }

    public function registerUmum(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'nisn' => ['unique:registers,nisn', 'required'],
            'email' => ['unique:registers,email', 'required', 'email'],
            'password' => ['required'],
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nisn.unique' => 'NISN sudah terdaftar.',
            'email.unique' => 'Email sudah terdaftar.',
            'email.email' => 'Email harus valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $otp = rand(100000, 999999);

        $siswa = Register::create([
            'nama_lengkap' => $request->nama_lengkap,
            'nisn' => $request->nisn,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'jalur_ppdb' => 'Umum',
            'verification_code' => $otp,
        ]);

        Mail::to($siswa->email)->send(new VerificationMail($otp));
        $email = $siswa->email;
        // Auth::guard('siswa')->login($siswa);
        return view('auth.verify-email', ['email' => $email]);
    }

    /**
     * Store a newly created resource in storage.
     */
}
