<?php

namespace App\Http\Controllers\siswa;

use App\Http\Controllers\Controller;
use App\Models\DataRaport;
use App\Models\MataPelajaran;
use App\Models\RataRataRaport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class RaportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $data;
    public function __construct()
    {
        $this->data = Auth::guard('siswa')->user();
    }


    public function index()
    {
        $raports = DataRaport::where('id_register', $this->data->id)->get();
        $active_tab = "raport";
        return view('siswa.raport', ['data' => $this->data, "raports" => $raports, 'active_tab' => $active_tab,]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumb = (object) [
            'list' => ['Data Rapor', 'Tambah Data Rapor']
        ];
        $header = "Form input raport";
        $mapel = MataPelajaran::all();
        return view('siswa.form-raport',  ['data' => $this->data, "breadcrumb" => $breadcrumb, "mapels" => $mapel, "header" => $header]);
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

        return response()->json(['redirect' => route('siswa.raport')]);
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
            'list' => ['Data Rapor', 'Edit Data Rapor']
        ];

        $raports = DataRaport::where('id_register', $id)->get();
        $header = "Perbarui Rapor";
        return view('siswa.edit-raport',  ['data' => $this->data, "raports" => $raports, "breadcrumb" => $breadcrumb, "header" => $header]);
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

        return response()->json(['redirect' => route('siswa.raport')]);
    }

    public function uploadFile(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:jpg,jpeg|max:1024',
        ]);

        $cekImage = RataRataRaport::where('id_register', $this->data->id)->first();

        if (!$cekImage) {
            return response()->json([
                'message' => 'Data raport belum tersedia. Silakan tambahkan data raport terlebih dahulu.'
            ], 422);
        }

        if ($request->hasFile('image')) {
            $documentPath = $request->file('image')->store('siswa/raport');

            if ($cekImage->image) {
                Storage::disk('public')->delete($cekImage->image);
            }
            $cekImage->update([
                'image' => $documentPath
            ]);

            return response()->json([
                'preview_url' => asset('storage/' . $documentPath),
            ]);
        }

        return response()->json([
            'message' => 'File tidak ditemukan.'
        ], 422);
    }



    public function exportPdf()
    {
        $siswa = $this->data;
        $raports = DataRaport::where('id_register', $this->data->id)->get();
        $pdf = Pdf::loadView('siswa.raportPdf', compact('raports', 'siswa'));
        return $pdf->download('data-rapor.pdf');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
