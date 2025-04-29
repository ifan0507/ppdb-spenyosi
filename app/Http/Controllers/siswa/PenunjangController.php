<?php

namespace App\Http\Controllers\siswa;

use App\Http\Controllers\Controller;
use App\Models\DocumentAfirmasi;
use App\Models\DocumentMutasi;
use App\Models\DocumentPrestasiLomba;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PenunjangController extends Controller
{

    protected $data;
    public function __construct()
    {
        $this->data = Auth::guard('siswa')->user();
    }

    public function updateAfirmasi(Request $request, string $id)
    {
        $defaultDocument = 'default_document.png';

        $request->validate([
            'image' => 'file|image'
        ], [
            'image.file' => 'Document harus berupa file!'
        ]);

        if ($this->data->afirmasi->image === $defaultDocument && !$request->hasFile('image')) {
            return response()->json(['errors' => ['image' => ['Document tidak boleh kosong!']]], 400);
        }

        if ($request->hasFile('image')) {
            if ($this->data->afirmasi->image !== $defaultDocument) {
                Storage::delete($this->data->afirmasi->image);
            }
            $documentPath = $request->file('image')->store('siswa/afirmasi');
        } else {
            $documentPath = $request->file('image')->store('siswa/afirmasi');
        }

        DocumentAfirmasi::where('id', $id)->update([
            'jenis_afirmasi' => $request->jenis_afirmasi,
            'image' => $documentPath,
            'status_berkas' => '1'
        ]);

        return response()->json(['redirect' => route('')]);
    }
    public function updateMutasi(Request $request, string $id)
    {
        $defaultDocument = 'default_document.png';

        $request->validate([
            'image' => 'file|image'
        ], [
            'image.file' => 'Document harus berupa file!'
        ]);

        if ($this->data->mutasi->image === $defaultDocument && !$request->hasFile('image')) {
            return response()->json(['errors' => ['image' => ['Document tidak boleh kosong!']]], 400);
        }

        if ($request->hasFile('image')) {
            if ($this->data->mutasi->image !== $defaultDocument) {
                Storage::delete($this->data->mutasi->image);
            }
            $documentPath = $request->file('image')->store('siswa/mutasi');
        } else {
            $documentPath = $request->file('image')->store('siswa/mutasi');
        }

        DocumentMutasi::where('id', $id)->update([
            'asal_tugas' => $request->asal_tugas,
            'image' => $documentPath,
            'thn_pindah' => $request->thn_pindah,
            'status_berkas' => '1'
        ]);

        return response()->json(['redirect' => route('')]);
    }
    public function updatePrestasiLomba(Request $request, string $id)
    {
        $defaultDocument = 'default_document.png';

        $request->validate([
            'image' => 'file|image'
        ], [
            'image.file' => 'Document harus berupa file!'
        ]);

        if ($this->data->lomba->image === $defaultDocument && !$request->hasFile('image')) {
            return response()->json(['errors' => ['image' => ['Document tidak boleh kosong!']]], 400);
        }

        if ($request->hasFile('image')) {
            if ($this->data->lomba->image !== $defaultDocument) {
                Storage::delete($this->data->lomba->image);
            }
            $documentPath = $request->file('image')->store('siswa/lomba');
        } else {
            $documentPath = $request->file('image')->store('siswa/lomba');
        }

        DocumentPrestasiLomba::where('id', $id)->update([
            'nama_prestasi' => $request->nama_prestasi,
            'jenis_prestasi' => $request->jenis_prestsi,
            'tingkat_prestasi' => $request->tingkat_prestasi,
            'thn_perolehan' => $request->thn_perolehan,
            'perolehan' => $request->perolehan,
            'image' => $documentPath,
            'status_berkas' => '1'
        ]);

        return response()->json(['redirect' => route('')]);
    }
}
