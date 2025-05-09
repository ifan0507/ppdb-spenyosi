<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Info;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $infos = Info::all();
        $active = 'beranda';
        return view('clients.beranda', ['infos' => $infos, 'active' => $active]);
    }
}
