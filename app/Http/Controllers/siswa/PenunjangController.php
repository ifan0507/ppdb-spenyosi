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

    public function editMutasi(string $id)
    {
        $data = DocumentMutasi::where("id", $id)->first();
        $header = "Form mutasi";

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

    //prestasi
    public function viewPrestasi()
    {
        $active_tab = "dokumen_prestasi";
        return view('siswa.prestasi', ['data' => $this->data, "active_tab" => $active_tab]);
    }

    public function editPrestasiLomba()
    {
        $header = "Perbarui Document Prestasi";

        return view('siswa.edit-prestasi', [
            'data' => $this->data,
            "header" => $header
        ]);
    }


    public function updatePrestasiLomba(Request $request, string $id)
    {
        $defaultDocument = 'default_document.png';

        // Validasi semua field yang diperlukan
        $request->validate([
            'nama_prestasi' => 'required|string|max:255',
            'kategori' => 'required|in:Akademik,Non-akademik',
            'tingkat_prestasi' => 'required|string',
            'thn_perolehan' => 'required|numeric|digits:4',
            'perolehan' => 'required|string',
            'image' => 'nullable|file|image|max:2048'
        ], [
            'nama_prestasi.required' => 'Nama prestasi harus diisi!',
            'kategori.required' => 'Kategori harus dipilih!',
            'kategori.in' => 'Kategori harus Akademik atau Non-akademik!',
            'tingkat_prestasi.required' => 'Tingkat prestasi harus diisi!',
            'thn_perolehan.required' => 'Tahun perolehan harus diisi!',
            'thn_perolehan.numeric' => 'Tahun perolehan harus berupa angka!',
            'thn_perolehan.digits' => 'Tahun perolehan harus 4 digit!',
            'perolehan.required' => 'Perolehan harus diisi!',
            'image.file' => 'Document harus berupa file!',
            'image.image' => 'Document harus berupa gambar!',
            'image.max' => 'Ukuran document maksimal 2MB!'
        ]);

        try {
            // Ambil data prestasi yang akan diupdate
            $prestasiLomba = DocumentPrestasiLomba::findOrFail($id);
            $pendaftaranId = session('id_register');

            // Verifikasi kepemilikan data (keamanan)
            if ($prestasiLomba->id_register != $pendaftaranId) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Anda tidak memiliki akses untuk mengubah data ini!'
                ], 403);
            }

            // Cek jumlah prestasi berdasarkan kategori yang sudah diinput
            // Kecualikan data yang sedang diupdate jika kategori sama
            $kategori = $request->kategori;
            $kategoriLama = $prestasiLomba->kategori;

            // Jika kategori berubah, perlu cek kuota kategori baru
            if ($kategori != $kategoriLama) {
                $jumlahPrestasiKategori = DocumentPrestasiLomba::where('id_register', $pendaftaranId)
                    ->where('kategori', $kategori)
                    ->count();

                if ($jumlahPrestasiKategori >= 3) {
                    $kategoriLabel = ($kategori == 'Akademik') ? 'Akademik' : 'Non-akademik';
                    return response()->json([
                        'status' => 'error',
                        'message' => "Anda sudah menginput 3 prestasi {$kategoriLabel}. Tidak bisa menambah lagi untuk kategori ini."
                    ], 400);
                }
            }

            // Penanganan file dokumen
            if ($request->hasFile('image')) {
                // Jika file sebelumnya bukan default, hapus
                if ($prestasiLomba->image !== $defaultDocument) {
                    Storage::delete($prestasiLomba->image);
                }
                $documentPath = $request->file('image')->store('siswa/lomba');
            } else {
                // Jika tidak ada file baru, tetap pakai file lama
                // Tapi jika file lama adalah default dan tidak ada file baru, tolak
                if ($prestasiLomba->image === $defaultDocument) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Document tidak boleh kosong!',
                        'errors' => ['image' => ['Document tidak boleh kosong!']]
                    ], 400);
                }
                $documentPath = $prestasiLomba->image;
            }

            $prestasiLomba->update([
                'nama_prestasi' => $request->nama_prestasi,
                'kategori' => $kategori,
                'tingkat_prestasi' => $request->tingkat_prestasi,
                'thn_perolehan' => $request->thn_perolehan,
                'perolehan' => $request->perolehan,
                'image' => $documentPath,
                'status_berkas' => '1'
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Data prestasi berhasil diperbarui!',
                'redirect' => route('siswa.prestasi')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat memperbarui data prestasi!',
                'error_detail' => env('APP_DEBUG') ? $e->getMessage() : null
            ], 500);
        }
    }
    public function deletePrestasiLomba(string $id)
    {
        try {
            // Ambil data prestasi yang akan dihapus
            $prestasiLomba = DocumentPrestasiLomba::findOrFail($id);
            $pendaftaranId = session('id_register');

            // Verifikasi kepemilikan data (keamanan)
            if ($prestasiLomba->id_register != $pendaftaranId) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Anda tidak memiliki akses untuk menghapus data ini!'
                ], 403);
            }

            $defaultDocument = 'default_document.png';

            // Hapus file jika bukan default
            if ($prestasiLomba->image !== $defaultDocument) {
                Storage::delete($prestasiLomba->image);
            }

            // Hapus data dari database
            $prestasiLomba->delete();

            // Response sukses
            return response()->json([
                'status' => 'success',
                'message' => 'Data prestasi berhasil dihapus!',
                'redirect' => route('siswa.prestasi')
            ]);
        } catch (\Exception $e) {
            // Tangani exception/error
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menghapus data prestasi!',
                'error_detail' => env('APP_DEBUG') ? $e->getMessage() : null
            ], 500);
        }
    }
}
