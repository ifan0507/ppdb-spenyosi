<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Mail\VerificationMail;
use App\Models\Jalur;
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

    public function registKhusus()
    {
        $jalur = Jalur::all();

        return view('clients.khusus', ["jalurs" => $jalur]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function registerKhusus(Request $request)
    {
        $request->validate([
            'nisn' => ['unique:registers,nisn'],
            'email' => ['unique:registers,email', 'email'],
        ], [
            'nisn.unique' => 'NISN sudah terdaftar!.',
            'email.unique' => 'Email sudah terdaftar!.',
            'email.email' => 'Email harus valid.',
        ]);

        $otp = rand(100000, 999999);

        session([
            'register_data' => $request->only('nama_lengkap', 'nisn', 'email', 'password'),
            'otp' => $otp,
            'jalur_ppdb' => $request->jalur_ppdb
        ]);

        Mail::to($request->email)->send(new VerificationMail($otp));

        session()->flash('email_verifikasi', $request->email);

        return response()->json(['redirect' => route('verify.email')]);
    }

    public function registerUmum(Request $request)
    {
        $request->validate([
            'nisn' => ['unique:registers,nisn'],
            'email' => ['unique:registers,email', 'email'],
        ], [
            'nisn.unique' => 'NISN sudah terdaftar.',
            'email.unique' => 'Email sudah terdaftar.',
            'email.email' => 'Email harus valid.',
        ]);

        $otp = rand(100000, 999999);


        session([
            'register_data' => $request->only('nama_lengkap', 'nisn', 'email', 'password'),
            'otp' => $otp,
            'jalur_ppdb' => '1',
        ]);

        Mail::to($request->email)->send(new VerificationMail($otp));

        session()->flash('email_verifikasi', $request->email);

        return response()->json(['redirect' => route('verify.email')]);
    }

    /**
     * Store a newly created resource in storage.
     */
}
