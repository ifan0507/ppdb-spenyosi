<?php

namespace App\Http\Controllers\siswa;

use App\Http\Controllers\Controller;
use App\Models\OrtuSiswa;
use App\Models\SiswaBaru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrtuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Auth::guard('siswa')->user();
        $active_tab = 'orang tua';
        return view('siswa.ortu-siswa', compact('data', 'active_tab'));
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
    public function edit(string $id)
    {
        $breadcrumb = (object) [
            'list' => ['Data Orang Tua', 'Tambah Data Orang Tua']
        ];
        $data = OrtuSiswa::where("id", $id)->first();
        $header = "Form Orang Tua";
        return view('siswa.form-ortu', compact('data', 'header'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = [
            "ayah" => $request->ayah,
            "status_ayah" => $request->status_ayah,
            "status_hubungan" => $request->status_hubungan,
            "hubungan_wali" => $request->status_hubungan === 'Wali' ? $request->hubungan_wali : null,
            "pendidikan_ayah" => $request->pendidikan_ayah,
            "pekerjaan_ayah" => $request->pekerjaan_ayah,
            "ibu" => $request->ibu,
            "status_ibu" => $request->status_ibu,
            "pendidikan_ibu" => $request->pendidikan_ibu,
            "pekerjaan_ibu" => $request->pekerjaan_ibu,
            "no_hp" => $request->no_hp,
            "status_berkas" => "1",
        ];

        OrtuSiswa::where("id", $id)->update($data);

        return response()->json(["redirect" => route("ortu")]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
