<?php

namespace App\Http\Controllers\siswa;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
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
        $active_tab = "raport";
        return view('siswa.raport', compact('data'), ['active_tab' => $active_tab]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data  = Auth::guard('siswa')->user();
        $mapel = MataPelajaran::all();
        return view('siswa.form-raport', compact('data'), ["mapels" => $mapel]);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
