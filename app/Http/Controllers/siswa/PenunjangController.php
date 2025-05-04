<?php

namespace App\Http\Controllers\siswa;

use App\Http\Controllers\Controller;
use App\Models\DocumentAfirmasi;
use App\Models\DocumentMutasi;
use App\Models\DocumentPrestasiLomba;
use App\Models\Register;
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

    public function siswaAfirmasi()
    {
        $active_tab = "dokumen_afirmasi";
        return view('siswa.afirmasi', ['data' => $this->data, "active_tab" => $active_tab]);
    }

    public function editAfirmasi()
    {

        $header = "Perbarui Dokumen Afirmasi";

        return view('siswa.edit-afirmasi', [
            'data' => $this->data,
            "header" => $header
        ]);
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

        $update = DocumentAfirmasi::where('id', $id)->update([
            'jenis_afirmasi' => $request->jenis_afirmasi,
            'image' => $documentPath,
            'status_berkas' => '1'
        ]);
        if ($update) {
            return response()->json(['redirect' => route('siswa.afirmasi')]);
        } else {
            return back()->withInput()->withErrors('ERROR CONTROLLER');
        }
    }

    //Pindah Tugas

    public function viewMutasi()
    {
        $active_tab = "dokumen_mutasi";
        return view('siswa.mutasi', ['data' => $this->data, "active_tab" => $active_tab]);
    }

    public function editMutasi()
    {
        $header = "Perbarui dokumen mutasi";
        return view('siswa.edit-mutasi', [
            'data' => $this->data,
            "header" => $header
        ]);
    }

    public function updateMutasi(Request $request, string $id)
    {
        $defaultDocument = 'default_document.png';

        $request->validate([
            'image' => 'file|image'
        ], [
            'image.file' => 'Dokumen harus berupa file!'
        ]);

        if ($this->data->mutasi->image === $defaultDocument && !$request->hasFile('image')) {
            return response()->json(['errors' => ['image' => ['Dokumen tidak boleh kosong!']]], 400);
        }

        if ($request->hasFile('image')) {
            if ($this->data->mutasi->image !== $defaultDocument) {
                Storage::delete($this->data->mutasi->image);
            }
            $documentPath = $request->file('image')->store('siswa/mutasi');
        } else {
            $documentPath = $this->data->mutasi->image;
        }

        DocumentMutasi::where('id', $id)->update([
            'asal_tugas' => $request->asal_tugas,
            'image' => $documentPath,
            'thn_pindah' => $request->thn_pindah,
            'status_berkas' => '1'
        ]);

        return response()->json(['redirect' => route('siswa.mutasi')]);
    }

    //prestasi
    public function viewPrestasi()
    {
        $active_tab = "dokumen_prestasi";

        return view('siswa.prestasi', [
            'data' => $this->data,
            'active_tab' => $active_tab
        ]);
    }


    public function editPrestasiLomba()
    {
        $header = "Perbarui Dokumen Prestasi";

        return view('siswa.edit-prestasi', [
            'data' => $this->data,
            "header" => $header
        ]);
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
            $documentPath = $this->data->lomba->image;
        }


        $update =  DocumentPrestasiLomba::where('id', $id)->update([
            'nama_prestasi' => $request->nama_prestasi,
            'kategori' => $request->kategori,
            'tingkat_prestasi' => $request->tingkat_prestasi,
            'thn_perolehan' => $request->thn_perolehan,
            'perolehan' => $request->perolehan,
            'image' => $documentPath,
            'status_berkas' => '1'
        ]);
        if ($update) {
            return response()->json(['redirect' => route('siswa.prestasi')]);
        } else {
            return back()->withInput()->withErrors('ERROR CONTROLLER');
        }
    }
}
