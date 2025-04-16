<?php

namespace App\Http\Controllers\siswa;

use App\Http\Controllers\Controller;
use App\Models\Register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        if ($data->jalur->id == "5") {
            if ($data->raport?->status != "1" || $data->raport?->status == "0")
                return response()->json(['errors' => ['Raport belum lengkap!']], 422);
        }
    }
}
