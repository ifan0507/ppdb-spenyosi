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
    public function viewUmum()
    {
        $breadcrumb = (object) [
            'list' => ['Master Data', 'Jalur Umum']
        ];

        $pendaftarans = Pendaftaran::with('register', 'register.siswa.ortu')
            ->whereHas('register', function ($query) {
                $query->where('id_jalur', '1');
            })->join('registers', 'pendaftarans.id_register', '=', 'registers.id')
            ->join('siswa_barus', 'registers.id', '=', 'siswa_barus.id_register_siswa')
            ->orderBy('siswa_barus.jarak_sekolah')
            ->select('pendaftarans.*')
            ->paginate(2);


        foreach ($pendaftarans as $index => $pendaftaran) {
            $pendaftaran->peringkat_zonasi = $index + 1;
        }

        return view('admin.dataPendaftaran', ['pendaftarans' => $pendaftarans, 'data' => $this->data, 'breadcrumb' => $breadcrumb, 'jalur' => 'Jalur Umum']);
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
    public function viewPrestasi()
    {
        $breadcrumb = (object) [
            'list' => ['Master Data', 'Jalur Prestasi Raport']
        ];
        $pendaftarans = Pendaftaran::with('register.raport.mapel', 'register.siswa.ortu')->whereHas('register', function ($query) {
            $query->where('id_jalur', '5');
        })->join('registers', 'pendaftarans.id_register', '=', 'registers.id')
            ->join('data_raports', 'registers.id', '=', 'data_raports.id_register')
            ->orderByDesc('data_raports.total_rata_rata')
            ->select('pendaftarans.*')->distinct('pendaftarans.id')
            ->paginate(10);

        foreach ($pendaftarans as $index => $pendaftaran) {
            $pendaftaran->peringkat_raport = $index + 1;
        }

        return view('admin.dataPendaftaran', ['data' => $this->data, 'pendaftarans' => $pendaftarans, 'breadcrumb' => $breadcrumb, 'jalur' => 'Jalur Prestasi Raport']);
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
