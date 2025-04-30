<?php

namespace App\Http\Controllers\siswa;

use App\Events\SiswaBaruMendaftar;
use App\Http\Controllers\Controller;
use App\Models\Pendaftaran as ModelsPendaftaran;
use App\Models\Register;
use App\Models\User;
use App\Notifications\SiswaBaruDaftar;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

use function Pest\Laravel\json;

class Pendaftaran extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Auth::guard('siswa')->user();
        $active_tab = "pendaftaran";
        return view('siswa.pendaftaran', compact('data'), ["active_tab" => $active_tab]);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function store(string $id)
    {

        $data = Register::where("id", $id)->first();

        if ($data->siswa->status_berkas == "0") {
            return response()->json(['errors' => ['Biodata siswa belum lengkap!']], 422);
        }

        if ($data->siswa->ortu->status_berkas == "0") {
            return response()->json(['errors' => ['Data Orang Tua belum lengkap!']], 422);
        }

        if ($data->jalur->id == 2 && $data->afirmasi->status_berkas == "0") {
            return response()->json(['errors' => ['Dokumen afirmasi belum lengkap!']], 422);
        }

        if ($data->jalur->id == 3 && $data->mutasi->status_berkas == "0") {
            return response()->json(['errors' => ['Dokumen mutasi belum lengkap!']], 422);
        }

        if ($data->jalur->id == 4 && $data->lomba->status_berkas == "0") {
            return response()->json(['errors' => ['Dokumen prestasi belum lengkap!']], 422);
        }

        if ($data->jalur->id == "5" && $data->raport?->status == "0") {
            return response()->json(['errors' => ['Raport belum lengkap!']], 422);
        }

        $admin = User::where('role', 'admin')->get();

        $cekData =  ModelsPendaftaran::where('id_register', $data->id)->first();
        if ($cekData) {
            $cekData->update([
                'status' => 'Diperbarui',
                'decline' => "0",
            ]);

            Notification::send($admin, new SiswaBaruDaftar($cekData, 'diperbarui'));
            event(new SiswaBaruMendaftar($cekData, 'diperbarui'));
            Register::where('id', $id)->update([
                "submit" => "1"
            ]);
        } else {
            $dataSiswa = ModelsPendaftaran::create([
                'tanggal_daftar' => Carbon::now(),
                'id_register' => $data->id,
                'status' => 'Pending'
            ]);

            Notification::send($admin, new SiswaBaruDaftar($dataSiswa, 'mendaftar'));
            event(new SiswaBaruMendaftar($dataSiswa, 'mendaftar'));
            Register::where('id', $id)->update([
                "submit" => "1"
            ]);
        }
        return response()->json(['redirect' => route('pendaftaran')]);
    }
}
