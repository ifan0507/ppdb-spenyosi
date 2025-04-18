<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Auth::guard('web')->user();
        return view('admin.dashboard', ['data' => $data]);
    }
    public function viewUmum()
    {
        return view('admin.umum');
    }
    public function viewAfirmasi()
    {
        return view('admin.afirmasi');
    }
    public function viewpindahTugas()
    {
        return view('admin.pindahTugas');
    }
    public function viewTahfidz()
    {
        return view('admin.tahfidz');
    }
    public function viewPrestasi()
    {
        return view('admin.prestasi');
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
