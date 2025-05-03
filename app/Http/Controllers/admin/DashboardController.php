<?php

namespace App\Http\Controllers\admin;

use App\Exports\PendaftaranExport;
use App\Http\Controllers\Controller;
use App\Mail\Confirmation;
use App\Mail\DeclineMail;
use App\Models\DataRaport;
use App\Models\Pendaftaran;
use App\Models\Register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    protected $data, $sort, $start, $end, $top_n, $query;

    public function __construct(Request $request)
    {
        $this->data =  Auth::guard('web')->user();
        $this->sort = $request->input('sort');
        $this->start = $request->input('start_rank');
        $this->end = $request->input('end_rank');
        $this->top_n = $request->input('top_n');
        $this->query = Pendaftaran::query();
    }
    //dashboard
    public function index()
    {
        $breadcrumb = (object) [
            'list' => ['Dashboard', '']
        ];
        return view('admin.dashboard', ['data' => $this->data, 'breadcrumb' => $breadcrumb]);
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
    public function viewAkademik(Request $request)
    {
        $breadcrumb = (object) [
            'list' => ['Master Data', 'Jalur Prestasi Akademik']
        ];
        $sort = $request->input('sort');
        $pendaftarans = Pendaftaran::with('register', 'register.siswa.ortu')
            ->whereHas('register', function ($query) {
                $query->where('id_jalur', '4');
            })->get();
        return view('admin.dataPendaftaran', ['pendaftarans' => $pendaftarans, 'data' => $this->data, 'breadcrumb' => $breadcrumb, 'jalur' => 'Jalur Prestasi Akademik', 'sort' => $sort, 'jalur_export' => 'akademik']);
    }
    public function viewRaport()
    {
        $breadcrumb = (object) [
            'list' => ['Master Data', 'Jalur Prestasi Raport']
        ];

        $this->query->whereHas('register', function ($q) {
            $q->where('id_jalur', '5');
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
            if ($pendaftarans->register->jalur->id == "5") {
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
            $pendaftaran->update([
                'confirmations' => '1',
                'status' => 'valid',
                'id_user' => $this->data->id
            ]);

            Mail::to($pendaftaran->register->email)->send(new Confirmation($pendaftaran->register->siswa->nama));
        };

        return response()->json(['success' => true]);
    }

    public function decline(string $id, Request $request)
    {
        $pendaftaran = Pendaftaran::where('id', $id)->first();

        if ($pendaftaran) {
            $pendaftaran->update([
                'decline' => '1',
                'status' => 'invalid',
                'id_user' => $this->data->id,
            ]);

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

    private function sortStatusPendaftaran($sort)
    {
        if ($sort == 'valid') {
            $this->query->where('confirmations', '1');
        } else if ($sort == 'invalid') {
            $this->query->where('decline', '1');
        }
    }
}
