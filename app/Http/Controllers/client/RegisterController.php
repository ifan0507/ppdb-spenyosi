<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
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

        $register = Register::create([
            'nama_lengkap' => $request->nama_lengkap,
            'nisn' => $request->nisn,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'jalur_ppdb' => $request->jalur_ppdb,
        ]);

        if ($register) {
            return response()->json([
                'success' => true,
                'redirect_url' => route('login-siswa')
            ]);
        }
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

        $register = Register::create([
            'nama_lengkap' => $request->nama_lengkap,
            'nisn' => $request->nisn,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'jalur_ppdb' => 'Umum',
        ]);

        if ($register) {
            return response()->json([
                'success' => true,
                'redirect_url' => route('login-siswa')
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
}
