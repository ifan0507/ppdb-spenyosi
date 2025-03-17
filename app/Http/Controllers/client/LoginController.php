<?php

namespace App\Http\Controllers\client;


use App\Models\Register;
use App\Models\SiswaBaru;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
            'nama_lengkap' => $data['nama_lengkap'],
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
        ]);


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
