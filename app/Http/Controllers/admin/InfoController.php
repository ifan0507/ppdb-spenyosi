<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class InfoController extends Controller
{


    public function index()
    {
        $data = Auth::guard('web')->user();
        $breadcrumb = (object) [
            'list' => ['Manajemen Info', '']
        ];

        $infos = Info::all();
        return view('admin.info', ['data' => $data, 'breadcrumb' => $breadcrumb, 'infos' => $infos]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'file' => 'mimes:pdf,jpg,jpeg,png,gif,webp'
        ], [
            'file.mimes' => 'File yang diunggah harus berupa PDF atau gambar (jpg, jpeg, png, gif, webp).',
        ]);

        $slug = $this->generateUniqueSlug($request->judul);


        try {
            if ($request->hasFile('file')) {
                $path = $request->file('file')->store('admin/info-files');

                Info::create([
                    'judul' => $request->judul,
                    'slug' => $slug,
                    'file' => $path,
                    'deskripsi' => $request->deskripsi
                ]);
            } else {
                Info::create([
                    'judul' => $request->judul,
                    'slug' => $slug,
                    'deskripsi' => $request->deskripsi
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil ditambahkan',
                'redirect' => route('admin.info')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan data: ' . $e->getMessage()
            ], 500);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'file' => 'nullable|mimes:pdf,jpg,jpeg,png,gif,webp'
        ]);

        try {
            $dataLama = Info::where('slug', $slug)->firstOrFail();

            $newSlug = $dataLama->slug;
            if ($dataLama->judul != $request->judul) {
                $newSlug = $this->generateUniqueSlug($request->judul);
            }

            $updateData = [
                'judul' => $request->judul,
                'slug' => $newSlug,
                'deskripsi' => $request->deskripsi
            ];

            if ($request->hasFile('file')) {
                if ($dataLama->file) {
                    Storage::delete($dataLama->file);
                }
                $updateData['file'] = $request->file('file')->store('admin/info-files');
            }

            $dataLama->update($updateData);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diperbarui',
                'redirect' => route('admin.info')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Info::where('id', $id)->delete();
        return response()->json(['success' => true]);
    }

    private function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        // Periksa apakah slug sudah ada
        while (Info::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }

        return $slug;
    }
}
