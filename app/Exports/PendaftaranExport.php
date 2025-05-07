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

    protected $jalur, $sort, $start, $end, $top_n, $query, $tingkatPrestasi, $sortJuaraMap;

    public function __construct($jalur, $sort, $start, $end, $top_n)
    {
        $this->jalur = $jalur;
        $this->sort = $sort;
        $this->start = $start;
        $this->end = $end;
        $this->top_n = $top_n;
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
                return view('admin.export.exportExel', ['pendaftarans' => $pendaftarans,  'jalur' => $this->jalur]);

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
                return view('admin.export.exportExel', ['pendaftarans' => $pendaftarans,  'jalur' => $this->jalur]);

            case 'mutasi':
                $this->query->whereHas('register', fn($q) => $q->where('id_jalur', 3));
                $this->sortStatusPendaftaran($this->sort);
                $pendaftarans = $this->query->get();
                $pendaftarans = $this->applyLimit($pendaftarans);
                return view('admin.export.exportExel', ['pendaftarans' => $pendaftarans,  'jalur' => $this->jalur]);

            case 'akademik':
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
                $pendaftarans = $this->applyLimit($pendaftarans);
                return view('admin.export.exportExel', ['pendaftarans' => $pendaftarans,  'jalur' => $this->jalur]);
            case 'non-akademik':
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
                $pendaftarans = $this->applyLimit($pendaftarans);
                return view('admin.export.exportExel', ['pendaftarans' => $pendaftarans,  'jalur' => $this->jalur]);

            case 'raport':
                $this->query->whereHas('register', fn($q) => $q->where('id_jalur', 6));
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
                return view('admin.export.exportExel', ['pendaftarans' => $pendaftarans,  'jalur' => $this->jalur]);

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
