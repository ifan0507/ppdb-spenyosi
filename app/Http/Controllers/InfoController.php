<?php

namespace App\Http\Controllers;

use App\Models\Info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.info');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'mimes:pdf,jpg,jpeg,png,gif,webp'
        ], [
            'file.mimes' => 'File yang diunggah harus berupa PDF atau gambar (jpg, jpeg, png, gif, webp).',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('admin/info-files');

            Info::create([
                'judul' => $request->judul,
                'file' => $path,
                'deskripsi' => $request->deskripsi
            ]);
        }

        return response()->json(['success' => true]);
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
        $request->validate([
            'file' => 'mimes:pdf,jpg,jpeg,png,gif,webp'
        ], [
            'file.mimes' => 'File yang diunggah harus berupa PDF atau gambar (jpg, jpeg, png, gif, webp).',
        ]);

        $dataLama = Info::where('id', $id)->first();

        if ($request->hasFile('file')) {
            Storage::delete($dataLama->file);
            $path = $request->file('file')->store('admin/info-files');
            $dataLama->update([
                'judul' => $request->judul,
                'file' => $path,
                'deskripsi' => $request->deskripsi
            ]);
        } else {
            $dataLama->update([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi
            ]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Info::where('id', $id)->delete();
        return response()->json(['success' => true]);
    }
}
