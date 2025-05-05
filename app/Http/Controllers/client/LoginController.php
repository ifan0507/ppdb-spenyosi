<?php

namespace App\Http\Controllers\client;


use App\Models\Register;
use App\Models\SiswaBaru;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Akademik;
use App\Models\Document;
use App\Models\DocumentAfirmasi;
use App\Models\DocumentMutasi;
use App\Models\DocumentPrestasiLomba;
use App\Models\NonAkademik;
use App\Models\OrtuSiswa;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function loginView()
    {
        if (Auth::guard('siswa')->check()) {
            return redirect('/siswa');
        }
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

        if (Auth::guard('siswa')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/siswa');
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

        $tanggal = Carbon::now();
        $tglFormat = $tanggal->format('Ymd');

        $count = Register::whereDate('created_at', $tanggal->toDateString())->count() + 1;

        $noReg = $tglFormat . str_pad($count, 4, '0', STR_PAD_LEFT);


        $data = session('register_data');

        $akun = Register::create([
            'no_register' => $noReg,
            'nisn' => $data['nisn'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'id_jalur' => session('jalur_ppdb'),
            'email_verified_at' => now(),
            'verification_code' => null,
        ]);

        $siswa =  SiswaBaru::create([
            'id_register_siswa' => $akun->id,
            'nama' => $data['nama_lengkap'],
            'nisn' => $data['nisn'],
            'email' => $data['email'],
            "foto_kk" => 'default_document.png',
            "foto_siswa" => 'default_siswa.png',
            "foto_akte" => 'default_document.png',
        ]);

        OrtuSiswa::create([
            'id_siswa' => $siswa->id,
        ]);

        $mapping = [
            "2" => \App\Models\DocumentAfirmasi::class,
            "3" => \App\Models\DocumentMutasi::class,
        ];

        $jalur = session('jalur_ppdb');

        if (isset($mapping[$jalur])) {
            $mapping[$jalur]::create([
                'id_register' => $akun->id,
                'image' => 'default_document.png'
            ]);
        }

        Auth::guard('siswa')->login($akun);
        session()->forget(['register_data', 'otp']);

        return response()->json(['redirect' => route('dashboard-siswa')]);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('siswa')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/auth/login');
    }
}
