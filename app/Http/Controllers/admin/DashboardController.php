<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $data;

    public function __construct()
    {
        $this->data =  Auth::guard('web')->user();;
    }

    public function index()
    {
        return view('admin.dashboard', ['data' => $this->data]);
    }
    public function viewUmum()
    {
        return view('admin.umum', ['data' => $this->data]);
    }
    public function viewAfirmasi()
    {
        return view('admin.afirmasi', ['data' => $this->data]);
    }
    public function viewpindahTugas()
    {
        return view('admin.pindahTugas', ['data' => $this->data]);
    }
    public function viewTahfidz()
    {
        return view('admin.tahfidz', ['data' => $this->data]);
    }
    public function viewPrestasi()
    {
        $prestasis = Pendaftaran::with('register')->whereHas('register', function ($query) {
            $query->where('id_jalur', '5');
        })->get();
        return view('admin.prestasi', ['data' => $this->data, 'prestasis' => $prestasis]);
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
