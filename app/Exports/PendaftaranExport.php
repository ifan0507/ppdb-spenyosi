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

    protected $jalur, $sort, $start, $end, $top_n, $query;

    public function __construct($jalur, $sort, $start, $end, $top_n)
    {
        $this->jalur = $jalur;
        $this->sort = $sort;
        $this->start = $start;
        $this->end = $end;
        $this->top_n = $top_n;
        $this->query = Pendaftaran::query();
    }

    public function view(): View
    {
        switch ($this->jalur) {
            case 'zonasi':
                $this->query->whereHas('register', fn($q) => $q->where('id_jalur', 1));
                $this->sortStatusPendaftaran($this->sort);

                if ($this->sort === 'peringkat_zonasi') {
                    $this->query->join('registers', 'pendaftarans.id_register', '=', 'registers.id')
                        ->join('siswa_barus', 'registers.id', '=', 'siswa_barus.id_register_siswa')
                        ->orderBy('siswa_barus.jarak_sekolah', 'asc')
                        ->select('pendaftarans.*');
                } else {
                    $this->query->latest();
                }

                $pendaftarans = $this->query->get();

                $temp = $pendaftarans->sortBy(fn($p) => $p->register->siswa->jarak_sekolah ?? PHP_INT_MAX)->values();
                foreach ($temp as $i => $p) {
                    $original = $pendaftarans->firstWhere('id', $p->id);
                    if ($original) $original->peringkat_zonasi = $i + 1;
                }

                $pendaftarans = $this->applyLimit($pendaftarans, $temp);
                return view('admin.export.exportExel', compact('pendaftarans'));

            case 'afirmasi':
                $this->query->whereHas('register', fn($q) => $q->where('id_jalur', 2));
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
                $pendaftarans = $this->applyLimit($pendaftarans);
                return view('admin.export.exportExel', compact('pendaftarans'));

            case 'mutasi':
                $this->query->whereHas('register', fn($q) => $q->where('id_jalur', 3));
                $this->sortStatusPendaftaran($this->sort);
                $pendaftarans = $this->query->get();
                $pendaftarans = $this->applyLimit($pendaftarans);
                return view('admin.export.exportExel', compact('pendaftarans'));

            case 'raport':
                $this->query->whereHas('register', fn($q) => $q->where('id_jalur', 5));
                $this->sortStatusPendaftaran($this->sort);

                if ($this->sort === 'peringkat_raport') {
                    $this->query->join('registers', 'pendaftarans.id_register', '=', 'registers.id')
                        ->join('rata_rata_raports', 'registers.id', '=', 'rata_rata_raports.id_register')
                        ->orderByDesc('rata_rata_raports.total_rata_rata')
                        ->select('pendaftarans.*');
                } else {
                    $this->query->latest('pendaftarans.created_at');
                }

                $pendaftarans = $this->query->get();
                $temp = $pendaftarans->sortByDesc(fn($p) => optional($p->register->rata_rata_raport)->total_rata_rata ?? -1)->values();
                foreach ($temp as $i => $p) {
                    $p->peringkat_raport = $i + 1;
                }

                $pendaftarans = $this->applyLimit($pendaftarans, $temp);
                return view('admin.export.exportExel', compact('pendaftarans'));

            default:
                return view('admin.export.exportExel', ['pendaftarans' => collect(), 'jalur' => $this->jalur]);
        }
    }

    private function sortStatusPendaftaran($sort)
    {
        if ($sort === 'valid') {
            $this->query->where('confirmations', 1);
        } elseif ($sort === 'invalid') {
            $this->query->where('decline', 1);
        }
    }

    private function applyLimit($original, $custom = null)
    {
        $data = $custom ?? $original;

        if ($this->top_n) {
            $data = $data->take($this->top_n);
        }

        if ($this->start && $this->end) {
            $limit = $this->end - ($this->start - 1);
            $data = $data->slice($this->start - 1, $limit)->values();
        }

        return $data;
    }
}
