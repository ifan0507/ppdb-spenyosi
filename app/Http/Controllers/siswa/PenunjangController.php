<?php

namespace App\Http\Controllers\siswa;

use App\Http\Controllers\Controller;
use App\Models\Akademik;
use App\Models\DocumentAfirmasi;
use App\Models\DocumentMutasi;
use App\Models\DocumentPrestasiLomba;
use App\Models\NonAkademik;
use App\Models\Register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use function Pest\Laravel\json;

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
        $breadcrumb = (object) [
            'list' => ['Afirmasi', 'Perbarui Dokumen Afirmasi']
        ];

        return view('siswa.edit-afirmasi', [
            'data' => $this->data,
            "header" => $header,
            'breadcrumb' => $breadcrumb
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
        $breadcrumb = (object) [
            'list' => ['Mutasi', 'Perbarui Dokumen Mutasi']
        ];
        return view('siswa.edit-mutasi', [
            'data' => $this->data,
            'breadcrumb' => $breadcrumb,
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
        $active_tab = "prestasi_lomba";
        return view('siswa.prestasi', ['data' => $this->data, "active_tab" => $active_tab]);
    }

    public function createAkademik()
    {
        $breadcrumb = (object) [
            'list' => ['Prestasi Akademik', 'Tambah Dokumen Prestasi Akademik']
        ];
        $header = "Tambah Dokumen Prestasi Akademik";
        return view('siswa.tambah-prestasi', [
            'data' => $this->data,
            'breadcrumb' => $breadcrumb,
            'header' => $header
        ]);
    }

    public function storeAkademik(Request $request)
    {
        $request->validate([
            'image' => 'file|image'
        ], [
            'image.file' => 'Document harus berupa file!'
        ]);

        if ($request->hasFile('image')) {
            $documentPath = $request->file('image')->store('siswa/prestasi/akademik');
        }

        Akademik::create([
            'id_register' => $this->data->id,
            'nama_prestasi' => $request->nama_prestasi,
            'tingkat_prestasi' => $request->tingkat_prestasi,
            'thn_perolehan' => $request->thn_perolehan,
            'perolehan' => $request->perolehan,
            'image' => $documentPath,
            'status_berkas' => '1'
        ]);

        return response()->json(['redirect' => route('siswa.akademik')]);
    }

    public function editPrestasiAkademik(string $id)
    {
        $breadcrumb = (object) [
            'list' => ['Prestasi Akademik', 'Perbarui Dokumen Prestasi Akademik']
        ];
        $header = "Perbarui Dokumen Prestasi Akademik";
        $prestasis = Akademik::find($id);

        return view('siswa.edit-prestasi', [
            'data' => $this->data,
            'breadcrumb' => $breadcrumb,
            'prestasis' => $prestasis,
            'header' => $header
        ]);
    }


    public function updatePrestasiAkademik(Request $request, string $id)
    {
        $dataLama = Akademik::find($id);
        $request->validate([
            'image' => 'file|image'
        ], [
            'image.file' => 'Document harus berupa file!'
        ]);

        if ($request->hasFile('image')) {
            Storage::delete($dataLama->image);
            $documentPath = $request->file('image')->store('siswa/prestasi/akademik');

            Akademik::where('id', $id)->update([
                'nama_prestasi' => $request->nama_prestasi,
                'tingkat_prestasi' => $request->tingkat_prestasi,
                'thn_perolehan' => $request->thn_perolehan,
                'perolehan' => $request->perolehan,
                'image' => $documentPath,
                'status_berkas' => '1'
            ]);
        } else {
            Akademik::where('id', $id)->update([
                'nama_prestasi' => $request->nama_prestasi,
                'tingkat_prestasi' => $request->tingkat_prestasi,
                'thn_perolehan' => $request->thn_perolehan,
                'perolehan' => $request->perolehan,
                'status_berkas' => '1'
            ]);
        }

        return response()->json(['redirect' => route('siswa.akademik')]);
    }

    public function deletePrestasiAkademik(string $id)
    {
        $data = Akademik::find($id);
        if ($data) {
            Storage::delete($data->image);
            $data->delete();
            return response()->json(['redirect' => route('siswa.akademik')]);
        }
    }

    public function createNonAkademik()
    {
        $breadcrumb = (object) [
            'list' => ['Prestasi Non Akademik', 'Tambah Dokumen Prestasi Non Akademik']
        ];
        $header = "Tambah Dokumen Prestasi Non Akademik";
        return view('siswa.tambah-prestasi', [
            'data' => $this->data,
            'breadcrumb' => $breadcrumb,
            'header' => $header
        ]);
    }

    public function storeNonAkademik(Request $request)
    {
        $request->validate([
            'image' => 'file|image'
        ], [
            'image.file' => 'Document harus berupa file!'
        ]);

        if ($request->hasFile('image')) {
            $documentPath = $request->file('image')->store('siswa/prestasi/non-akademik');
        }

        NonAkademik::create([
            'id_register' => $this->data->id,
            'nama_prestasi' => $request->nama_prestasi,
            'tingkat_prestasi' => $request->tingkat_prestasi,
            'thn_perolehan' => $request->thn_perolehan,
            'perolehan' => $request->perolehan,
            'image' => $documentPath,
            'status_berkas' => '1'
        ]);

        return response()->json(['redirect' => route('siswa.non-akademik')]);
    }

    public function editPrestasiNonAkademik(string $id)
    {
        $breadcrumb = (object) [
            'list' => ['Prestasi Non Akademik', 'Tambah Dokumen Prestasi Non Akademik']
        ];
        $header = "Perbarui Dokumen Prestasi Non Akademik";
        $prestasis = NonAkademik::find($id);

        return view('siswa.edit-prestasi', [
            'data' => $this->data,
            'breadcrumb' => $breadcrumb,
            'prestasis' => $prestasis,
            'header' => $header
        ]);
    }


    public function updatePrestasiNonAkademik(Request $request, string $id)
    {
        $request->validate([
            'image' => 'file|image'
        ], [
            'image.file' => 'Document harus berupa file!'
        ]);

        if ($request->hasFile('image')) {
            Storage::delete($this->data->akademik->image);
            $documentPath = $request->file('image')->store('siswa/prestasi/non-akademik');

            NonAkademik::where('id', $id)->update([
                'nama_prestasi' => $request->nama_prestasi,
                'tingkat_prestasi' => $request->tingkat_prestasi,
                'thn_perolehan' => $request->thn_perolehan,
                'perolehan' => $request->perolehan,
                'image' => $documentPath,
                'status_berkas' => '1'
            ]);
        } else {
            NonAkademik::where('id', $id)->update([
                'nama_prestasi' => $request->nama_prestasi,
                'tingkat_prestasi' => $request->tingkat_prestasi,
                'thn_perolehan' => $request->thn_perolehan,
                'perolehan' => $request->perolehan,
                'status_berkas' => '1'
            ]);
        }

        return response()->json(['redirect' => route('siswa.non-akademik')]);
    }

    public function deletePrestasiNonAkademik(string $id)
    {
        $data = NonAkademik::find($id);
        if ($data) {
            Storage::delete($data->image);
            $data->delete();
            return response()->json(['redirect' => route('siswa.non-akademik')]);
        }
    }
}
