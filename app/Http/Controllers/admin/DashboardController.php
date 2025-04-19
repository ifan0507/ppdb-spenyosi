<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function index()
    {
        return view('admin.dashboard', ['data' => $this->data]);
    }
    public function viewUmum()
    {
        $pendaftarans = Pendaftaran::with('register')
            ->whereHas('register', function ($query) {
                $query->where('id_jalur', '1');
            })->get();
        return view('admin.umum', ['pendaftarans' => $pendaftarans, 'data' => $this->data]);
    }
    public function viewAfirmasi()
    {
        $pendaftarans = Pendaftaran::with('register')
            ->whereHas('register', function ($query) {
                $query->where('id_jalur', '2');
            })->get();
        return view('admin.afirmasi', ['pendaftarans' => $pendaftarans, 'data' => $this->data]);
    }
    public function viewpindahTugas()
    {
        $pendaftarans = Pendaftaran::with('register')
            ->whereHas('register', function ($query) {
                $query->where('id_jalur', '3');
            })->get();
        return view('admin.pindahTugas', ['pendaftarans' => $pendaftarans, 'data' => $this->data]);
    }
    public function viewTahfidz()
    {
        $pendaftarans = Pendaftaran::with('register')
            ->whereHas('register', function ($query) {
                $query->where('id_jalur', '4');
            })->get();
        return view('admin.tahfidz', ['pendaftarans' => $pendaftarans, 'data' => $this->data]);
    }
    public function viewPrestasi()
    {
        $prestasis = Pendaftaran::with('register')->whereHas('register', function ($query) {
            $query->where('id_jalur', '5');
        })->get();
        return view('admin.prestasi', ['data' => $this->data, 'prestasis' => $prestasis]);
    }

    public function detail()
    {
        return view('admin.detail');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function confirm(string $id)
    {

        $data = Auth::guard('web')->user();

        Pendaftaran::where('id', $id)->update([
            'confirmations' => '1',
            'status' => 'valid',
            'id_user' => $data->id
        ]);

        return redirect('/admin/umum');
    }

    public function decline(string $id)
    {
        Pendaftaran::where('id', $id)->update([
            'decline' => '1',
            'status' => 'invalid',
            'id_user' => $this->data->id,
        ]);

        return response()->json(['success' => true]);
    }
}
