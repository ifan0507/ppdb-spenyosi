<?php

namespace App\Http\Controllers\siswa;

use App\Http\Controllers\Controller;
use App\Models\DataRaport;
use App\Models\MataPelajaran;
use App\Models\RataRataRaport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RaportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data  = Auth::guard('siswa')->user();
        $raports = DataRaport::where('id_register', $data->id)->get();
        $active_tab = "raport";
        return view('siswa.raport', compact('data', 'raports'), ['active_tab' => $active_tab,]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumb = (object) [
            'list' => ['Data Raport', 'Tambah Data Raport']
        ];
        $data  = Auth::guard('siswa')->user();
        $header = "Form input raport";
        $mapel = MataPelajaran::all();
        return view('siswa.form-raport', compact('data'), ["breadcrumb" => $breadcrumb, "mapels" => $mapel, "header" => $header]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_register' => 'required|exists:registers,id',
            'id_mapel' => 'required|array',
            'kelas4_1' => 'nullable|array',
            'kelas4_2' => 'nullable|array',
            'kelas5_1' => 'nullable|array',
            'kelas5_2' => 'nullable|array',
            'kelas6_1' => 'nullable|array',
            'rata_kelas4_sem1' => 'nullable|numeric',
            'rata_kelas4_sem2' => 'nullable|numeric',
            'rata_kelas5_sem1' => 'nullable|numeric',
            'rata_kelas5_sem2' => 'nullable|numeric',
            'rata_kelas6_sem1' => 'nullable|numeric',
            'keterangan' => 'nullable|array',
        ]);

        foreach ($request->id_mapel as $key => $id_mapel) {
            DataRaport::create([
                'id_register' => $request->id_register,
                'id_mapel' => $id_mapel,
                'kelas4_1' => $request->kelas4_1[$key] ?? null,
                'kelas4_2' => $request->kelas4_2[$key] ?? null,
                'kelas5_1' => $request->kelas5_1[$key] ?? null,
                'kelas5_2' => $request->kelas5_2[$key] ?? null,
                'kelas6_1' => $request->kelas6_1[$key] ?? null,
            ]);
        }

        $totalRata = (
            $request->rata_kelas4_sem1 +
            $request->rata_kelas4_sem2 +
            $request->rata_kelas5_sem1 +
            $request->rata_kelas5_sem2 +
            $request->rata_kelas6_sem1
        ) / 4;

        RataRataRaport::create([
            'id_register' => $request->id_register,
            'total_rata_rata' => $totalRata,
        ]);

        DataRaport::where('id_register', $request->id_register)->update([
            'rata_kelas4_sem1' => $request->rata_kelas4_sem1,
            'rata_kelas4_sem2' => $request->rata_kelas4_sem2,
            'rata_kelas5_sem1' => $request->rata_kelas5_sem1,
            'rata_kelas5_sem2' => $request->rata_kelas5_sem2,
            'rata_kelas6_sem1' => $request->rata_kelas6_sem1,
            'status' => '1'
        ]);

        return response()->json(['redirect' => route('raport')]);
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
    public function edit(string $id)
    {
        $breadcrumb = (object) [
            'list' => ['Data Raport', 'Edit Data Raport']
        ];
        $data  = Auth::guard('siswa')->user();
        $raports = DataRaport::where('id_register', $id)->get();
        $header = "Perbarui raport";
        return view('siswa.edit-raport', compact('raports', 'data'), ["breadcrumb" => $breadcrumb ,"header" => $header]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_mapel' => 'required|array',
            'kelas4_1' => 'nullable|array',
            'kelas4_2' => 'nullable|array',
            'kelas5_1' => 'nullable|array',
            'kelas5_2' => 'nullable|array',
            'kelas6_1' => 'nullable|array',
            'rata_kelas4_sem1' => 'nullable|numeric',
            'rata_kelas4_sem2' => 'nullable|numeric',
            'rata_kelas5_sem1' => 'nullable|numeric',
            'rata_kelas5_sem2' => 'nullable|numeric',
            'rata_kelas6_sem1' => 'nullable|numeric',
            'keterangan' => 'nullable|array',
        ]);

        foreach ($request->id_mapel as $key => $id_mapel) {
            DataRaport::where('id_register', $id)
                ->where('id_mapel', $id_mapel)
                ->update([
                    'kelas4_1' => $request->kelas4_1[$key] ?? null,
                    'kelas4_2' => $request->kelas4_2[$key] ?? null,
                    'kelas5_1' => $request->kelas5_1[$key] ?? null,
                    'kelas5_2' => $request->kelas5_2[$key] ?? null,
                    'kelas6_1' => $request->kelas6_1[$key] ?? null,
                ]);
        }

        $totalRata = (
            $request->rata_kelas4_sem1 +
            $request->rata_kelas4_sem2 +
            $request->rata_kelas5_sem1 +
            $request->rata_kelas5_sem2 +
            $request->rata_kelas6_sem1
        ) / 4;

        RataRataRaport::where('id_register', $id)->update([
            'total_rata_rata' => $totalRata
        ]);

        DataRaport::where('id_register', $id)->update([
            'rata_kelas4_sem1' => $request->rata_kelas4_sem1,
            'rata_kelas4_sem2' => $request->rata_kelas4_sem2,
            'rata_kelas5_sem1' => $request->rata_kelas5_sem1,
            'rata_kelas5_sem2' => $request->rata_kelas5_sem2,
            'rata_kelas6_sem1' => $request->rata_kelas6_sem1,
            'status' => '1'
        ]);

        return response()->json(['redirect' => route('raport')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
