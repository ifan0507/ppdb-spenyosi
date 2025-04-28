<?php

namespace App\Http\Controllers\siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenunjangController extends Controller
{

    protected $data;

    public function __construct()
    {
        $this->data = Auth::guard('siswa')->user();
    }

    public function viewPrestasi()
    {
        $active_tab = "document_pendaftaran";
        return view('siswa.prestasi', ['data' => $this->data, "active_tab" => $active_tab]);
    }
}
