<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Info;

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $active = 'info';
        $infos = Info::latest()->paginate(3);
        return view('clients.info', ['infos' => $infos, 'active' => $active]);
    }

    public function detailInfo(string $slug)
    {
        $active = 'info';
        $infos = Info::where('slug', $slug)->firstOrFail();
        // Mendapatkan artikel sebelumnya dan sesudahnya
        $prevInfo = Info::where('id', '<', $infos->id)
            ->orderBy('id', 'desc')
            ->first();

        $nextInfo = Info::where('id', '>', $infos->id)
            ->orderBy('id', 'asc')
            ->first();

        // Mendapatkan artikel terkait (bisa berdasarkan kategori atau tag)
        // Contoh: mengambil 3 info terbaru selain info saat ini
        $relatedInfos = Info::where('id', '!=', $infos->id)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        return view('clients.info-detail', compact('infos', 'prevInfo', 'nextInfo', 'relatedInfos', 'active'));
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
