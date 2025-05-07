<div class="card-header p-0 border-bottom-0">
    <ul class="nav nav-tabs" id="formulir-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link remove-tab-format font-bold {{ $active_tab == 'biodata' ? 'active' : '' }}"
                id="biodata-tab" data-toggle="pill" href="{{ route('dashboard-siswa') }}" role="tab">Biodata</a>
        </li>
        <li class="nav-item">
            <a class="nav-link remove-tab-format font-bold {{ $active_tab == 'orang tua' ? 'active' : '' }}"
                id="biodata-tab" data-toggle="pill" href="{{ route('ortu') }}" role="tab">Orang Tua</a>
        </li>
        @if ($data->jalur->id == 2)
            <li class="nav-item">
                <a class="nav-link remove-tab-format font-bold {{ $active_tab == 'dokumen_afirmasi' ? 'active' : '' }}"
                    id="dokumen-afirmasi-tab" data-toggle="pill" href="{{ route('siswa.afirmasi') }}" role="tab">
                    Dokumen Afirmasi
                </a>
            </li>
        @elseif ($data->jalur->id == 3)
            <li class="nav-item">
                <a class="nav-link remove-tab-format font-bold {{ $active_tab == 'dokumen_mutasi' ? 'active' : '' }}"
                    id="dokumen-mutasi-tab" data-toggle="pill" href="{{ route('siswa.mutasi') }}" role="tab">
                    Dokumen Pindah-tugas
                </a>
            </li>
        @elseif ($data->jalur->id == 4)
            <li class="nav-item">
                <a class="nav-link remove-tab-format font-bold {{ $active_tab == 'prestasi_lomba' ? 'active' : '' }}"
                    id="dokumen-prestasi-tab" data-toggle="pill" href="{{ route('siswa.akademik') }}" role="tab">
                    Dokumen Prestasi Akademik
                </a>
            </li>
        @elseif ($data->jalur->id == 5)
            <li class="nav-item">
                <a class="nav-link remove-tab-format font-bold {{ $active_tab == 'prestasi_lomba' ? 'active' : '' }}"
                    id="dokumen-prestasi-tab" data-toggle="pill" href="{{ route('siswa.non-akademik') }}"
                    role="tab">
                    Dokumen Prestasi Nonakademik
                </a>
            </li>
        @elseif ($data->jalur->id == 6)
            <li class="nav-item">
                <a class="nav-link remove-tab-format font-bold {{ $active_tab == 'raport' ? 'active' : '' }}"
                    id="raport-tab" data-toggle="pill" href="{{ route('siswa.raport') }}" role="tab">
                    Rapor
                </a>
            </li>
        @endif
        <li class="nav-item">
            <a class="nav-link remove-tab-format font-bold {{ $active_tab == 'pendaftaran' ? 'active' : '' }}"
                id="biodata-tab" data-toggle="pill" href="{{ route('pendaftaran') }}" role="tab"
                aria-controls="biodata" aria-selected="true">Konfirmasi pendaftaran</a>
        </li>
    </ul>
</div>
