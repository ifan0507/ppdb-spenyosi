<?php

namespace App\Http\Controllers\admin;

use App\Exports\PendaftaranExport;
use App\Http\Controllers\Controller;
use App\Mail\Confirmation;
use App\Mail\DeclineMail;
use App\Models\DataRaport;
use App\Models\Jalur;
use App\Models\Pendaftaran;
use App\Models\Register;
use App\Models\SiswaBaru;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    protected $data, $sort, $start, $end, $top_n, $query, $tingkatPrestasi, $sortJuaraMap;

    public function __construct(Request $request)
    {
        $this->data =  Auth::guard('web')->user();
        $this->sort = $request->input('sort');
        $this->start = $request->input('start_rank');
        $this->end = $request->input('end_rank');
        $this->top_n = $request->input('top_n');
        $this->query = Pendaftaran::query();
        $this->tingkatPrestasi = ['Kecamatan', 'Kabupaten/Kota', 'Provinsi', 'Nasional'];
        $this->sortJuaraMap = [
            'p1_kecamatan' => ['tingkat' => 'Kecamatan', 'juara' => 'Peringkat 1'],
            'p2_kecamatan' => ['tingkat' => 'Kecamatan', 'juara' => 'Peringkat 2'],
            'p3_kecamatan' => ['tingkat' => 'Kecamatan', 'juara' => 'Peringkat 3'],
            'p1_kabupaten' => ['tingkat' => 'Kabupaten/Kota', 'juara' => 'Peringkat 1'],
            'p2_kabupaten' => ['tingkat' => 'Kabupaten/Kota', 'juara' => 'Peringkat 2'],
            'p3_kabupaten' => ['tingkat' => 'Kabupaten/Kota', 'juara' => 'Peringkat 3'],
            'p1_provinsi' => ['tingkat' => 'Provinsi', 'juara' => 'Peringkat 1'],
            'p2_provinsi' => ['tingkat' => 'Provinsi', 'juara' => 'Peringkat 2'],
            'p3_provinsi' => ['tingkat' => 'Provinsi', 'juara' => 'Peringkat 3'],
            'p1_nasional' => ['tingkat' => 'Nasional', 'juara' => 'Peringkat 1'],
            'p2_nasional' => ['tingkat' => 'Nasional', 'juara' => 'Peringkat 2'],
            'p3_nasional' => ['tingkat' => 'Nasional', 'juara' => 'Peringkat 3'],
            'lainnya' => ['tingkat' => null, 'juara' => 'Lainnya'],
        ];
    }
    //dashboard

    public function index()
    {
        $breadcrumb = (object) [
            'list' => ['Dashboard', '']
        ];

        $jalurList = Jalur::pluck('nama_jalur', 'id');
        $pendaftarans = Pendaftaran::all();

        $jumlahPerJalur = Pendaftaran::with('register.jalur')
            ->get()
            ->groupBy(function ($item) {
                return $item->register->jalur->id ?? 'Unknown';
            })
            ->map(function ($group) {
                return $group->count();
            });

        $grouped = $pendaftarans->groupBy(function ($item) {
            return Carbon::parse($item->created_at)->format('o-W');
        })->map(function ($items) use ($jalurList) {
            $perJalur = [];

            foreach ($jalurList as $id => $nama) {
                $perJalur[$nama] = $items->filter(function ($i) use ($id) {
                    return $i->register->jalur->id == $id;
                })->count();
            }

            return $perJalur;
        });

        $labelsMingguan = $grouped->keys()->map(function ($key) {
            [$tahun, $minggu] = explode('-', $key);
            return "Minggu $minggu, $tahun";
        });

        $series = [];
        foreach ($jalurList as $nama) {
            $data = $grouped->map(fn($week) => $week[$nama] ?? 0)->values();
            $series[] = [
                'name' => $nama,
                'data' => $data
            ];
        }


        return view('admin.dashboard', [
            'data' => $this->data,
            'breadcrumb' => $breadcrumb,
            'pendaftarans' => $pendaftarans,
            'jumlahPerJalur' => $jumlahPerJalur,
            'labelsMingguan' => $labelsMingguan,
            'seriesChart' => $series
        ]);
    }

    public function viewZonasi()
    {
        $breadcrumb = (object) [
            'list' => ['Master Data', 'Jalur Zonasi']
        ];

        $this->query->whereHas('register', function ($q) {
            $q->where('id_jalur', '1');
        });

        $this->sortStatusPendaftaran($this->sort);

        if ($this->sort == 'peringkat_zonasi') {
            $this->query->join('registers', 'pendaftarans.id_register', '=', 'registers.id')
                ->join('siswa_barus', 'registers.id', '=', 'siswa_barus.id_register_siswa')
                ->orderBy('siswa_barus.jarak_sekolah', 'asc')
                ->select('pendaftarans.*');
        } else {
            $this->query->latest();
        }

        $pendaftarans = $this->query->get();

        $tempPendaftarans = $pendaftarans->sortBy(function ($pendaftaran) {
            return $pendaftaran->register->siswa->jarak_sekolah ?? PHP_INT_MAX;
        })->values();

        foreach ($tempPendaftarans as $index => $pendaftaran) {
            $original = $pendaftarans->firstWhere('id', $pendaftaran->id);
            if ($original) {
                $original->peringkat_zonasi = $index + 1;
            }
        }

        if ($this->top_n) {
            $pendaftarans = $tempPendaftarans->take($this->top_n);
        }

        if ($this->start && $this->end) {
            $limit = $this->end - ($this->start - 1);
            $pendaftarans = $pendaftarans->slice($this->start - 1, $limit)->values();
        }

        return view('admin.dataPendaftaran', [
            'pendaftarans' => $pendaftarans,
            'data' => $this->data,
            'breadcrumb' => $breadcrumb,
            'jalur' => 'Jalur Zonasi',
            'sort' => $this->sort,
            'start_rank' => $this->start,
            'end_rank' => $this->end,
            'top_n' => $this->top_n,
            'jalur_export' => 'zonasi'
        ]);
    }

    public function viewAfirmasi()
    {
        $breadcrumb = (object) [
            'list' => ['Master Data', 'Jalur Afirmasi']
        ];

        $this->query->whereHas('register', function ($q) {
            $q->where('id_jalur', '2');
        });

        $this->sortStatusPendaftaran($this->sort);

        if (in_array($this->sort, ['KIP', 'KKS', 'PKH'])) {
            $this->query->join('registers', 'pendaftarans.id_register', '=', 'registers.id')
                ->join('document_afirmasis', 'registers.id', '=', 'document_afirmasis.id_register')
                ->where('document_afirmasis.jenis_afirmasi', strtolower($this->sort))
                ->select('pendaftarans.*');
        } else {
            $this->query->latest();
        }

        $pendaftarans = $this->query->get();

        if ($this->start && $this->end) {
            $limit = $this->end - ($this->start - 1);
            $pendaftarans = $pendaftarans->slice($this->start - 1, $limit)->values();
        }

        return view('admin.dataPendaftaran', [
            'pendaftarans' => $pendaftarans,
            'data' => $this->data,
            'breadcrumb' => $breadcrumb,
            'jalur' => 'Jalur Afirmasi',
            'sort' => $this->sort,
            'start_rank' => $this->start,
            'end_rank' => $this->end,
            'jalur_export' => 'afirmasi'
        ]);
    }
    public function viewpindahTugas()
    {
        $breadcrumb = (object) [
            'list' => ['Master Data', 'Jalur Pindah Tugas']
        ];

        $this->query->whereHas('register', function ($q) {
            $q->where('id_jalur', '3');
        });

        $this->sortStatusPendaftaran($this->sort);

        $pendaftarans = $this->query->get();

        if ($this->start && $this->end) {
            $limit = $this->end - ($this->start - 1);
            $pendaftarans = $pendaftarans->slice($this->start - 1, $limit)->values();
        }
        return view('admin.dataPendaftaran', [
            'pendaftarans' => $pendaftarans,
            'data' => $this->data,
            'breadcrumb' => $breadcrumb,
            'jalur' => 'Jalur Pindah Tugas',
            'sort' => $this->sort,
            'start_rank' => $this->start,
            'end_rank' => $this->end,
            'jalur_export' => 'mutasi'
        ]);
    }
    public function viewAkademik()
    {
        $breadcrumb = (object) [
            'list' => ['Master Data', 'Jalur Prestasi Akademik']
        ];

        $this->query->whereHas('register', function ($q) {
            $q->where('id_jalur', '4');
        });

        $this->sortStatusPendaftaran($this->sort);

        if (in_array($this->sort, $this->tingkatPrestasi)) {
            $this->query->join('registers', 'pendaftarans.id_register', '=', 'registers.id')
                ->join('akademiks', 'registers.id', '=', 'akademiks.id_register')
                ->where('akademiks.tingkat_prestasi', $this->sort)
                ->select('pendaftarans.*');
        } elseif (array_key_exists($this->sort, $this->sortJuaraMap)) {
            $tingkat = $this->sortJuaraMap[$this->sort]['tingkat'];
            $juara = $this->sortJuaraMap[$this->sort]['juara'];

            $this->query->join('registers', 'pendaftarans.id_register', '=', 'registers.id')
                ->join('akademiks', 'registers.id', '=', 'akademiks.id_register');

            if ($tingkat !== null) {
                $this->query->where('akademiks.tingkat_prestasi', $tingkat);
            }

            $this->query->where('akademiks.perolehan', $juara)
                ->select('pendaftarans.*');
        } else {
            $this->query->latest();
        }


        $pendaftarans = $this->query->get();

        if ($this->start && $this->end) {
            $limit = $this->end - ($this->start - 1);
            $pendaftarans = $pendaftarans->slice($this->start - 1, $limit)->values();
        }

        return view('admin.dataPendaftaran', ['pendaftarans' => $pendaftarans, 'data' => $this->data, 'breadcrumb' => $breadcrumb, 'jalur' => 'Jalur Prestasi Akademik', 'sort' => $this->sort, 'start_rank' => $this->start, 'end_rank' => $this->end, 'jalur_export' => 'akademik']);
    }
    public function viewNonAkademik()
    {
        $breadcrumb = (object) [
            'list' => ['Master Data', 'Jalur Prestasi Nonakademik']
        ];

        $this->query->whereHas('register', function ($q) {
            $q->where('id_jalur', '5');
        });

        $this->sortStatusPendaftaran($this->sort);

        if (in_array($this->sort, $this->tingkatPrestasi)) {
            $this->query->join('registers', 'pendaftarans.id_register', '=', 'registers.id')
                ->join('non_akademiks', 'registers.id', '=', 'non_akademiks.id_register')
                ->where('non_akademiks.tingkat_prestasi', $this->sort)
                ->select('pendaftarans.*');
        } elseif (array_key_exists($this->sort, $this->sortJuaraMap)) {
            $tingkat = $this->sortJuaraMap[$this->sort]['tingkat'];
            $juara = $this->sortJuaraMap[$this->sort]['juara'];

            $this->query->join('registers', 'pendaftarans.id_register', '=', 'registers.id')
                ->join('non_akademiks', 'registers.id', '=', 'non_akademiks.id_register');

            if ($tingkat !== null) {
                $this->query->where('non_akademiks.tingkat_prestasi', $tingkat);
            }

            $this->query->where('non_akademiks.perolehan', $juara)
                ->select('pendaftarans.*');
        } else {
            $this->query->latest();
        }


        $pendaftarans = $this->query->get();

        if ($this->start && $this->end) {
            $limit = $this->end - ($this->start - 1);
            $pendaftarans = $pendaftarans->slice($this->start - 1, $limit)->values();
        }

        return view('admin.dataPendaftaran', ['pendaftarans' => $pendaftarans, 'data' => $this->data, 'breadcrumb' => $breadcrumb, 'jalur' => 'Jalur Prestasi Non Akademik', 'sort' => $this->sort, 'start_rank' => $this->start, 'end_rank' => $this->end, 'jalur_export' => 'non-akademik']);
    }
    public function viewRaport()
    {
        $breadcrumb = (object) [
            'list' => ['Master Data', 'Jalur Prestasi Raport']
        ];

        $this->query->whereHas('register', function ($q) {
            $q->where('id_jalur', '6');
        });

        $this->sortStatusPendaftaran($this->sort);

        if ($this->sort == 'peringkat_raport') {
            $this->query
                ->join('registers', 'pendaftarans.id_register', '=', 'registers.id')
                ->join('rata_rata_raports', 'registers.id', '=', 'rata_rata_raports.id_register')
                ->orderByDesc('rata_rata_raports.total_rata_rata')
                ->select('pendaftarans.*');
        } else {
            $this->query->latest('pendaftarans.created_at');
        }

        $pendaftarans = $this->query->get();

        $tempPendaftarans = $pendaftarans->sortByDesc(function ($pendaftaran) {
            return optional($pendaftaran->register->rata_rata_raport)->total_rata_rata ?? -1;
        })->values();

        foreach ($tempPendaftarans as $index => $pendaftaran) {
            $pendaftaran->peringkat_raport = $index + 1;
        }

        if ($this->top_n) {
            $pendaftarans = $tempPendaftarans->take($this->top_n);
        }

        if ($this->start && $this->end) {
            $pendaftarans = $pendaftarans->slice($this->start - 1, $this->end - $this->start + 1)->values();
        }

        return view('admin.dataPendaftaran', [
            'data' => $this->data,
            'pendaftarans' => $pendaftarans,
            'breadcrumb' => $breadcrumb,
            'jalur' => 'Jalur Prestasi Raport',
            'sort' => $this->sort,
            'start_rank' => $this->start,
            'end_rank' => $this->end,
            'top_n' => $this->top_n,
            'jalur_export' => 'raport'
        ]);
    }

    public function detail(string $id)
    {
        $pendaftarans = Pendaftaran::where('id', $id)->first();
        $raports = collect();
        if ($pendaftarans) {
            if ($pendaftarans->register->jalur->id == "6") {
                $raports = DataRaport::where('id_register', $pendaftarans->register->id)->get();
            }
        }

        return view('admin.detail', ['data' => $this->data, 'pendaftarans' => $pendaftarans, 'raports' => $raports]);
    }
    //Info

    /**
     * Show the form for creating a new resource.
     */
    public function confirm(string $id)
    {
        $pendaftaran = Pendaftaran::where('id', $id)->first();

        if ($pendaftaran) {
            if ($pendaftaran->decline == '0') {
                $pendaftaran->update([
                    'confirmations' => '1',
                    'status' => 'valid',
                    'id_user' => $this->data->id
                ]);
            } else {
                $pendaftaran->update([
                    'confirmations' => '1',
                    'decline' => '0',
                    'status' => 'valid',
                    'id_user' => $this->data->id
                ]);
                Register::where('id', $pendaftaran->id_register)->update([
                    'submit' => "1"
                ]);
            }

            Mail::to($pendaftaran->register->email)->send(new Confirmation($pendaftaran->register->siswa->nama));
        };

        return response()->json(['success' => true]);
    }

    public function decline(string $id, Request $request)
    {
        $pendaftaran = Pendaftaran::where('id', $id)->first();

        if ($pendaftaran) {
            if ($pendaftaran->confirmations == '0') {
                $pendaftaran->update([
                    'decline' => '1',
                    'status' => 'invalid',
                    'id_user' => $this->data->id,
                ]);
            } else {
                $pendaftaran->update([
                    'decline' => '1',
                    'confirmations' => '0',
                    'status' => 'invalid',
                    'id_user' => $this->data->id,
                ]);
            }


            Register::where('id', $pendaftaran->id_register)->update([
                'submit' => "0"
            ]);

            Mail::to($pendaftaran->register->email)->send(new DeclineMail($request->message, $pendaftaran->register->siswa->nama));
        }

        return response()->json(['success' => true]);
    }

    public function notifDeleteById($id)
    {
        DB::table('notifications')->where('id', $id)->delete();
        return response()->json(['success' => true]);
    }

    public function notifDeleteAll()
    {
        auth()->user()->notifications()->delete();
        return response()->json(['success' => true]);
    }

    public function exportExel(Request $request)
    {
        $jalur = $request->jalur;
        $sort = $request->sort;
        $start = $request->start_rank;
        $end = $request->end_rank;
        $top_n = $request->top_n;

        $filename = "pendaftaran";

        if ($jalur) {
            $filename .= "_{$jalur}";
        }

        if ($sort) {
            $filename .= "_{$sort}";
        }

        if ($start && $end) {
            $filename .= "_dari_{$start}_sampai_{$end}";
        } elseif ($top_n) {
            $filename .= "_peringkat_{$top_n}_teratas";
        }


        $filename = $filename . (str_ends_with($filename, '.xlsx') ? '' : '.xlsx');
        return Excel::download(new PendaftaranExport($jalur, $sort, $start, $end, $top_n), $filename);
    }

    public function downloadDocument($id, $tipe)
    {
        $dataSiswa = Pendaftaran::findOrFail($id);
        $siswa = $dataSiswa->register->siswa;

        // Mapping tipe dokumen ke field dan prefix
        $tipeMap = [
            'foto' => ['field' => 'foto_siswa', 'prefix' => 'FOTO'],
            'kk' => ['field' => 'foto_kk', 'prefix' => 'KK'],
            'akte' => ['field' => 'foto_akte', 'prefix' => 'AKTE'],
        ];

        if (!array_key_exists($tipe, $tipeMap)) {
            abort(404);
        }

        $field = $tipeMap[$tipe]['field'];
        $prefix = $tipeMap[$tipe]['prefix'];
        $fileName = $siswa->$field;

        if (!Storage::disk('public')->exists($fileName)) {
            Session::flash('status', 'File tidak ditemukan.');
            return redirect()->route('admin.detail', ['id' => $dataSiswa->id]);
        }

        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        $namaFileAsli = $prefix . '_' . $dataSiswa->register->no_register . '_' . str_replace(' ', '_', $siswa->nama) . '.' . $ext;

        return Storage::disk('public')->download($fileName, $namaFileAsli);
    }


    public function downloadDocumentAfirmasi($id)
    {
        $dataSiswa = Pendaftaran::findOrFail($id);
        $fileName = $dataSiswa->register->afirmasi->image;

        if (!Storage::disk('public')->exists($fileName)) {
            Session::flash('status', 'File tidak ditemukan.');
            return redirect()->route('admin.detail', ['id' => $dataSiswa->id]);
        }

        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        $namaFileAsli = 'AFIRMASI' . '_' . $dataSiswa->register->no_register . '_' . str_replace(' ', '_', $dataSiswa->register->siswa->nama) . '.' . $ext;

        return Storage::disk('public')->download($fileName, $namaFileAsli);
    }

    public function downloadRapor($id)
    {
        $dataSiswa = Pendaftaran::findOrFail($id);
        $fileName = $dataSiswa->register->rata_rata_raport->image;

        if (!Storage::disk('public')->exists($fileName)) {
            Session::flash('status', 'File tidak ditemukan.');
            return redirect()->route('admin.detail', ['id' => $dataSiswa->id]);
        }

        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        $namaFileAsli = 'RAPOR' . '_' . $dataSiswa->register->no_register . '_' . str_replace(' ', '_', $dataSiswa->register->siswa->nama) . '.' . $ext;

        return Storage::disk('public')->download($fileName, $namaFileAsli);
    }

    private function sortStatusPendaftaran($sort)
    {
        if ($sort == 'valid') {
            $this->query->where('confirmations', '1');
        } else if ($sort == 'invalid') {
            $this->query->where('decline', '1');
        }
    }
}
