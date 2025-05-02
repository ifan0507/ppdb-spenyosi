<?php

namespace App\Exports;

use App\Models\Pendaftaran;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PendaftaranExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $sort, $start, $end, $top_n;

    public function __construct($sort, $start, $end, $top_n)
    {
        $this->sort = $sort;
        $this->start = $start;
        $this->end = $end;
        $this->top_n = $top_n;
    }

    public function view(): View
    {
        $query = Pendaftaran::query();
        $query->with(['register', 'register.siswa.ortu']);
        $query->whereHas('register', function ($q) {
            $q->where('id_jalur', '1');
        });

        if ($this->sort == 'valid') {
            $query->where('confirmations', '1');
        } elseif ($this->sort == 'invalid') {
            $query->where('decline', '1');
        }

        if ($this->sort == 'peringkat_zonasi') {
            $query->join('registers', 'pendaftarans.id_register', '=', 'registers.id')
                ->join('siswa_barus', 'registers.id', '=', 'siswa_barus.id_register_siswa')
                ->orderBy('siswa_barus.jarak_sekolah', 'asc')
                ->select('pendaftarans.*');
        } else {
            $query->latest();
        }

        $pendaftarans = $query->get();

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

        return view('admin/export/exportExel', [
            'pendaftarans' => $pendaftarans
        ]);
    }
}
