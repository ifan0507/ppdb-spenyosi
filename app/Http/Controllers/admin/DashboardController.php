<?php

namespace App\Http\Controllers\admin;

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
    //dashboard
    public function index()
    {
        $breadcrumb = (object) [
            'list' => ['Dashboard', '']
        ];
        return view('admin.dashboard', ['data' => $this->data, 'breadcrumb' => $breadcrumb]);
    }
    public function viewUmum(Request $request)
    {
        $breadcrumb = (object) [
            'list' => ['Master Data', 'Jalur Umum']
        ];

        $sort = $request->input('sort');
        // query builder dasar
        $query = Pendaftaran::query();
        $query->with(['register', 'register.siswa.ortu']);
        $query->whereHas('register', function ($q) {
            $q->where('id_jalur', '1');
        });

        // Jika sorting berdasarkan zonasi, gunakan subquery untuk ordering
        if ($sort == 'peringkat_zonasi') {
            $query->join('registers', 'pendaftarans.id_register', '=', 'registers.id')
                ->join('siswa_barus', 'registers.id', '=', 'siswa_barus.id_register_siswa')
                ->orderBy('siswa_barus.jarak_sekolah', 'asc')
                ->select('pendaftarans.*');
        } else {
            $query->latest();
        }
        $pendaftarans = $query->get();

        // peringkat zonasi
        $tempPendaftarans = $pendaftarans->sortBy(function ($pendaftaran) {
            return $pendaftaran->register->siswa->jarak_sekolah ?? PHP_INT_MAX;
        })->values();

        foreach ($tempPendaftarans as $index => $pendaftaran) {
            $original = $pendaftarans->firstWhere('id', $pendaftaran->id);
            if ($original) {
                $original->peringkat_zonasi = $index + 1;
            }
        }

        return view('admin.dataPendaftaran', [
            'pendaftarans' => $pendaftarans,
            'data' => $this->data,
            'breadcrumb' => $breadcrumb,
            'jalur' => 'Jalur Umum',
            'sort' => $sort
        ]);
    }
    public function viewAfirmasi()
    {
        $breadcrumb = (object) [
            'list' => ['Master Data', 'Jalur Afirmasi']
        ];
        $pendaftarans = Pendaftaran::with('register', 'register.siswa.ortu')
            ->whereHas('register', function ($query) {
                $query->where('id_jalur', '2');
            })->paginate(10);
        return view('admin.dataPendaftaran', ['pendaftarans' => $pendaftarans, 'data' => $this->data, 'breadcrumb' => $breadcrumb, 'jalur' => 'Jalur Afirmasi']);
    }
    public function viewpindahTugas()
    {
        $breadcrumb = (object) [
            'list' => ['Master Data', 'Jalur Pindah Tugas']
        ];
        $pendaftarans = Pendaftaran::with('register', 'register.siswa.ortu')
            ->whereHas('register', function ($query) {
                $query->where('id_jalur', '3');
            })->paginate(10);
        return view('admin.dataPendaftaran', ['pendaftarans' => $pendaftarans, 'data' => $this->data, 'breadcrumb' => $breadcrumb, 'jalur' => 'Jalur Pindah Tugas']);
    }
    public function viewTahfidz()
    {
        $breadcrumb = (object) [
            'list' => ['Master Data', 'Jalur Tahfidz']
        ];
        $pendaftarans = Pendaftaran::with('register', 'register.siswa.ortu')
            ->whereHas('register', function ($query) {
                $query->where('id_jalur', '4');
            })->paginate(10);
        return view('admin.dataPendaftaran', ['pendaftarans' => $pendaftarans, 'data' => $this->data, 'breadcrumb' => $breadcrumb, 'jalur' => 'Jalur Tahfidz']);
    }
    public function viewPrestasi(Request $request)
    {
        $breadcrumb = (object) [
            'list' => ['Master Data', 'Jalur Prestasi Raport']
        ];

        $sort = $request->input('sort');
        $query = Pendaftaran::query();
        $query->with(['register', 'register.siswa.ortu', 'register.raport.mapel']);
        $query->whereHas('register', function ($q) {
            $q->where('id_jalur', '5');
        });

        if ($sort == 'peringkat_raport') {
            $query->join('registers', 'pendaftarans.id_register', '=', 'registers.id')
                ->join('data_raports', 'registers.id', '=', 'data_raports.id_register')
                ->orderByDesc('data_raports.total_rata_rata')
                ->select('pendaftarans.*')->distinct('pendaftarans.id');
        } else {
            $query->latest();
        }

        $pendaftarans = $query->get();

        $tempPendaftarans = $pendaftarans->sortByDesc(function ($pendaftaran) {
            return $pendaftaran->register->raport->total_rata_rata ?? -1; // Nilai default -1 untuk yang tidak memiliki nilai
        })->values();

        foreach ($tempPendaftarans as $index => $pendaftaran) {
            $original = $pendaftarans->firstWhere('id', $pendaftaran->id);
            if ($original) {
                $original->peringkat_raport = $index + 1;
            }
        }

        return view('admin.dataPendaftaran', [
            'data' => $this->data,
            'pendaftarans' => $pendaftarans,
            'breadcrumb' => $breadcrumb,
            'jalur' => 'Jalur Prestasi Raport',
            'sort' => $sort
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
}
