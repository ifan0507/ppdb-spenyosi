<div class="card-header p-0 border-bottom-0">
    <ul class="nav nav-tabs" id="formulir-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link remove-tab-format font-bold {{ $active_tab == 'biodata' ? 'active' : '' }}"
                id="biodata-tab" data-toggle="pill" href="{{ route('dashboard-siswa') }}" role="tab">Biodata</a>
        </li>
        @if ($data->jalur_ppdb == 'Prestasi')
            <li class="nav-item">
                <a class="nav-link remove-tab-format font-bold {{ $active_tab == 'raport' ? 'active' : '' }}"
                    id="keluarga-tab" data-toggle="pill" href="{{ route('raport') }}" role="tab">Raport</a>
            </li>
        @endif
        <li class="nav-item">
            <a class="nav-link remove-tab-format font-bold {{ $active_tab == 'pendaftaran' ? 'active' : '' }}"
                id="biodata-tab" data-toggle="pill" href="{{ route('pendaftaran') }}" role="tab"
                aria-controls="biodata" aria-selected="true">Konfirmasi pendaftaran</a>
        </li>
    </ul>
</div>
