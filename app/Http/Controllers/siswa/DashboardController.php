<?php

namespace App\Http\Controllers\siswa;

use App\Http\Controllers\Controller;
use App\Models\SiswaBaru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Auth::guard('siswa')->user();
        $active_tab = 'biodata';

        $jalur_ppdb = $data->jalur_ppdb ?? null;

        return view('siswa.dashboard', compact('data', 'jalur_ppdb', 'active_tab'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $data = Auth::guard('siswa')->user();
        return view('siswa.update-biodata', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $siswa = SiswaBaru::findOrFail($id);

        $siswa->update([
            'nama' => $request->nama,
            'nisn' => $request->nisn,
            'nik' => $request->nik,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
        ]);

        if ($request->hasFile('foto_kk')) {
            $fileName = time() . '_kk.' . $request->foto_kk->extension();
            $request->foto_kk->move(public_path('images'), $fileName);
            $siswa->foto_kk = $fileName;
        }

        if ($request->hasFile('foto_akte')) {
            $fileName = time() . '_akte.' . $request->foto_akte->extension();
            $request->foto_akte->move(public_path('images'), $fileName);
            $siswa->foto_akte = $fileName;
        }

        $siswa->save();

        return redirect('/siswa/dashboard')->with('success', 'Biodata berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
