<?php

namespace App\Http\Controllers\siswa;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Register;
use App\Models\SiswaBaru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    // Function untuk mengihitung jarak titik rumah ke smp
    private function hitungJarak($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // km

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Auth::guard('siswa')->user();
        $active_tab = 'biodata';

        return view('siswa.dashboard', compact('data', 'active_tab'));
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
        $header = "Perbarui Biodata";
        return view('siswa.update-biodata', compact('data', 'header'));
    }

    public function update(Request $request)
    {
        $defaultSiswa = 'default_siswa.png';
        $defaultDocument = 'default_document.png';

        $request->validate([
            'foto_siswa' => 'file|image',
            'foto_kk' => 'file|image',
            'foto_akte' => 'file|image',
        ], [
            'foto_siswa.file' => 'Foto pribadi harus berupa file!',
            'foto_siswa.image' => 'Foto pribadi harus berupa gambar!',
            'foto_kk.file' => 'Foto kk harus berupa file!',
            'foto_kk.image' => 'Foto kk harus berupa gambar!',
            'foto_akte.file' => 'Foto akte harus berupa file!',
            'foto_akte.image' => 'Foto akte harus berupa gambar!',
        ]);

        $akun = Auth::guard('siswa')->user();

        if ($akun->siswa->foto_siswa === $defaultSiswa && !$request->hasFile('foto_siswa')) {
            return response()->json(['errors' => ['foto_siswa' => ['Foto pribadi tidak boleh kosong!']]], 400);
        }
        if ($akun->siswa->foto_kk === $defaultDocument  && !$request->hasFile('foto_kk')) {
            return response()->json(['errors' => ['foto_kk' => ['Foto KK tidak boleh kosong!']]], 400);
        }
        if ($akun->siswa->foto_akte === $defaultDocument  && !$request->hasFile('foto_akte')) {
            return response()->json(['errors' => ['foto_akte' => ['Foto Akte tidak boleh kosong!']]], 400);
        }

        // if ($akun->jalur->id == "2"  ||  $akun->jalur->id == "3" || $akun->jalur->id == "4") {

        //     if ($akun->document->document === $defaultDocument && !$request->hasFile('document')) {
        //         return response()->json(['errors' => ['document' => ['Dokumen penunjang tidak boleh kosong!']]], 400);
        //     }

        //     if ($request->hasFile('document')) {
        //         if ($akun->document->document !== $defaultDocument) {
        //             Storage::delete($akun->document->document);
        //         }
        //         $documentPath = $request->file('document')->store('siswa/dokumen');
        //         Document::where("id_register", $akun->id)->update([
        //             "document" => $documentPath
        //         ]);
        //     }
        // }

        if ($request->hasFile('foto_siswa')) {
            if ($akun->siswa->foto_siswa !== $defaultSiswa) {
                Storage::delete($akun->siswa->foto_siswa);
            }
            $fotoSiswaPath = $request->file('foto_siswa')->store('siswa/foto');
        } else {
            $fotoSiswaPath = $akun->siswa->foto_siswa;
        }

        if ($request->hasFile('foto_kk')) {
            if ($akun->siswa->foto_kk !== $defaultDocument) {
                Storage::delete($akun->siswa->foto_kk);
            }
            $fotoKKPath = $request->file('foto_kk')->store('siswa/kk');
        } else {
            $fotoKKPath = $akun->siswa->foto_kk;
        }

        if ($request->hasFile('foto_akte')) {
            if ($akun->siswa->foto_akte !== $defaultDocument) {
                Storage::delete($akun->siswa->foto_akte);
            }
            $fotoAktePath = $request->file('foto_akte')->store('siswa/akte');
        } else {
            $fotoAktePath = $akun->siswa->foto_akte;
        }

        $lokasi = explode(',', $request->lokasi);
        $latSiswa = floatval(trim($lokasi[0]));
        $lngSiswa = floatval(trim($lokasi[1]));

        // Koordinat SMP
        $latSMP = -8.234165;
        $lngSMP = 113.310387;

        $jarak = $this->hitungJarak($latSiswa, $lngSiswa, $latSMP, $lngSMP);


        $update = SiswaBaru::where("id", $akun->siswa->id)->update([
            "foto_siswa" => $fotoSiswaPath,
            "nik" => $request->nik,
            "jenis_kelamin" => $request->jenis_kelamin,
            "tempat_lahir" => $request->tempat_lahir,
            "tanggal_lahir" => $request->tanggal_lahir,
            "asal_sekolah" => $request->asal_sekolah,
            "kabupaten" => $request->kabupaten,
            "kab_id" => $request->kab_id,
            "kecamatan" => $request->kecamatan,
            "kec_id" => $request->kec_id,
            "desa" => $request->desa,
            "desa_id" => $request->desa_id,
            "alamat" => $request->alamat,
            "no_hp" => $request->no_hp,
            "lokasi" => $request->lokasi,
            'jarak_sekolah' => round($jarak, 2),
            "foto_kk" => $fotoKKPath,
            "foto_akte" => $fotoAktePath,
            "status_berkas" => "1"
        ]);

        if ($update) {
            return response()->json(['redirect' => route('dashboard-siswa')]);
        } else {
            return back()->withInput()->withErrors('ERROR CONTROLLER');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
