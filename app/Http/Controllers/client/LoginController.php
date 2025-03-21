<?php

namespace App\Http\Controllers\client;


use App\Models\Register;
use App\Models\SiswaBaru;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Document;
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

        $data = session('register_data');

        $siswa = Register::create([
            'nisn' => $data['nisn'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'id_jalur' => session('jalur_ppdb'),
            'email_verified_at' => now(),
            'verification_code' => null,
        ]);
        SiswaBaru::create([
            'id_register_siswa' => $siswa->id,
            'nama' => $data['nama_lengkap'],
            'nisn' => $data['nisn'],
            'email' => $data['email'],
            'nik' => "_",
            "tempat_lahir" => "_",
            "tanggal_lahir" => "_",
            "asal_sekolah" => "_",
            "kabupaten" => "_",
            "kecamatan" => "_",
            "desa" => "_",
            "dusun" => "_",
            "rt" => "_",
            "rw" => "_",
            "alamat" => "_",
            "no_hp" => "_",
            "lokasi" => "_",
            "foto_kk" => 'default_document.png',
            "foto_siswa" => 'default_siswa.png',
            "foto_akte" => 'default_document.png',
        ]);
        if (session('jalur_ppdb') !== "1" && session('jalur_ppdb') !== "5") {

            Document::create([
                'id_jalur' => session('jalur_ppdb'),
                'document' => 'default_document.png'
            ]);
        }

        Auth::guard('siswa')->login($siswa);
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
