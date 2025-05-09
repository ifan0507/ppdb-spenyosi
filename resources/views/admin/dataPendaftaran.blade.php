@extends('layouts.admin.template')

@section('content')
    <section class="section">
        @include('layouts.admin.breadcrumb')
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">{{ $jalur }}</h5>
                    <div class="accordion accordion-flush " id="accordionFlushExample">
                        <div class="accordion-item">
                            <h5 class="accordion-header" id="flush-headingOne" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                <button class="btn btn-outline-secondary btn-small dropdown-toggle" type="button"
                                    id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-sliders"></i> Opsi
                                </button>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>


            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                data-bs-parent="#accordionFlushExample">
                <div class="card-body mt-3">
                    <div class="alert alert-info alert-blue-outline mb-3">
                        <div class="row align-items-center">
                            <div class="col text-center" style="flex: 0 0 5%;">
                                <i class="fas fa-info-circle fa-2x"></i>
                            </div>
                            <div class="col">
                                <small class="mb-0 text-navi">
                                    Untuk mengekspor data dengan filter tertentu, silakan atur filter atau urutan terlebih
                                    dahulu.
                                    Jika ingin mengekspor semua data, langsung klik tombol export tanpa perlu memfilter.
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <!-- Card Kiri: Semua Filter -->
                        <div class="col-12 col-md-6">
                            <div class="card p-3 shadow-sm h-100">

                                <h6 class="mb-3">Urutkan Berdasarkan Kriteria</h6>
                                <form action="" id="keriteria">
                                    <div class="mb-3">

                                        <select class="form-select select-filter" id="urutkan" name="sort">
                                            <option value="">--- Pilih kriteria urutan ---</option>
                                            @if ($jalur == 'Jalur Zonasi')
                                                <option value="peringkat_zonasi"
                                                    {{ $sort == 'peringkat_zonasi' ? 'selected' : '' }}>
                                                    Peringkat Zonasi
                                                </option>
                                            @endif
                                            @if ($jalur == 'Jalur Afirmasi')
                                                <option value="KIP" {{ $sort == 'KIP' ? 'selected' : '' }}>Afirmasi KIP
                                                </option>
                                                <option value="KKS" {{ $sort == 'KKS' ? 'selected' : '' }}>Afirmasi KKS
                                                </option>
                                                <option value="PKH" {{ $sort == 'PKH' ? 'selected' : '' }}>Afirmasi PKH
                                                </option>
                                            @endif
                                            @if ($jalur == 'Jalur Prestasi Raport')
                                                <option value="peringkat_raport"
                                                    {{ $sort == 'peringkat_raport' ? 'selected' : '' }}>
                                                    Peringkat Raport
                                                </option>
                                            @endif
                                            @if ($jalur == 'Jalur Prestasi Akademik' || $jalur == 'Jalur Prestasi Non Akademik')
                                                <option value="Kecamatan" {{ $sort == 'Kecamatan' ? 'selected' : '' }}>
                                                    Tingkat Kecamatan
                                                </option>
                                                <option value="p1_kecamatan"
                                                    {{ $sort == 'p1_kecamatan' ? 'selected' : '' }}>Peringkat 1 (Kecamatan)
                                                </option>
                                                <option value="p2_kecamatan"
                                                    {{ $sort == 'p2_kecamatan' ? 'selected' : '' }}>Peringkat 2 (Kecamatan)
                                                </option>
                                                <option value="p3_kecamatan"
                                                    {{ $sort == 'p3_kecamatan' ? 'selected' : '' }}>Peringkat 3 (Kecamatan)
                                                </option>
                                                <option value="Kabupaten/Kota"
                                                    {{ $sort == 'Kabupaten/Kota' ? 'selected' : '' }}>Tingkat
                                                    Kabupaten/Kota
                                                </option>
                                                <option value="p1_kabupaten"
                                                    {{ $sort == 'p1_kabupaten' ? 'selected' : '' }}>Peringkat 1 (Kabupaten)
                                                </option>
                                                <option value="p2_kabupaten"
                                                    {{ $sort == 'p2_kabupaten' ? 'selected' : '' }}>Peringkat 2 (Kabupaten)
                                                </option>
                                                <option value="p3_kabupaten"
                                                    {{ $sort == 'p3_kabupaten' ? 'selected' : '' }}>Peringkat 3 (Kabupaten)
                                                </option>
                                                <option value="Provinsi" {{ $sort == 'Provinsi' ? 'selected' : '' }}>
                                                    Tingkat Provinsi</option>
                                                <option value="p1_provinsi" {{ $sort == 'p1_provinsi' ? 'selected' : '' }}>
                                                    Peringkat 1 (Provinsi)</option>
                                                <option value="p2_provinsi" {{ $sort == 'p2_provinsi' ? 'selected' : '' }}>
                                                    Peringkat 2 (Provinsi)</option>
                                                <option value="p3_provinsi" {{ $sort == 'p3_provinsi' ? 'selected' : '' }}>
                                                    Peringkat 3 (Provinsi)</option>
                                                <option value="Nasional" {{ $sort == 'Nasional' ? 'selected' : '' }}>
                                                    Tingkat Nasional</option>
                                                <option value="p1_nasional" {{ $sort == 'p1_nasional' ? 'selected' : '' }}>
                                                    Peringkat 1 (Nasional)</option>
                                                <option value="p2_nasional" {{ $sort == 'p2_nasional' ? 'selected' : '' }}>
                                                    Peringkat 2 (Nasional)</option>
                                                <option value="p3_nasional" {{ $sort == 'p3_nasional' ? 'selected' : '' }}>
                                                    Peringkat 3 (Nasional)</option>
                                                <option value="lainnya" {{ $sort == 'lainnya' ? 'selected' : '' }}>Lainnya
                                                </option>
                                            @endif
                                            <option value="valid" {{ $sort == 'valid' ? 'selected' : '' }}>Valid</option>
                                            <option value="invalid" {{ $sort == 'invalid' ? 'selected' : '' }}>Invalid
                                            </option>
                                        </select>
                                    </div>
                                </form>

                                <div class="row g-2 mb-3">
                                    <div class="col-md-6">
                                        <style>
                                            .gray-hover:hover {
                                                background-color: rgb(180, 180, 180);
                                            }
                                        </style>
                                        <form action="" method="GET" id="filter_no">

                                            <label class="form-label">Filter No Urut (Dari - Sampai)</label>
                                            <div class="input-group">
                                                <input type="number" name="start_rank" class="form-control"
                                                    placeholder="Dari" id="start_rank"
                                                    value="{{ old('start_rank', $start_rank) }}">
                                                <input type="number" name="end_rank" class="form-control"
                                                    placeholder="Sampai" id="end_rank"
                                                    value="{{ old('end_rank', $end_rank) }}">
                                                <span class="input-group-text p-0">
                                                    <button class="btn gray-hover" type="submit" name="filter">
                                                        <i class="bi bi-funnel"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </form>
                                    </div>

                                    @if ($jalur == 'Jalur Prestasi Raport' || $jalur == 'Jalur Zonasi')
                                        <div class="col-md-6">
                                            <form action="" method="GET">
                                                <label for="top_n" class="form-label">Top Berapa Besar</label>
                                                <div class="input-group">
                                                    <input type="number" id="top_n" name="top_n"
                                                        class="form-control" placeholder="Misalnya: 10"
                                                        value="{{ old('top_n', $top_n) }}">
                                                    <span class="input-group-text p-0">
                                                        <button class="btn gray-hover" type="submit">
                                                            <i class="bi bi-funnel"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Card Kanan: Tombol Export -->
                        <div class="col-12 col-md-6">
                            <div class="card p-3 shadow-sm d-flex flex-column justify-content-between">
                                <h6 class="mb-3">Export Data</h6>
                                <div class="d-grid gap-2 d-md-flex ">
                                    <button id="exportExcel" class="btn btn-success btn-export" id="export-excel">
                                        <i class="bi bi-file-earmark-excel me-2 export"></i> <span id="btnText">Export
                                            Exel</span>
                                        <span id="btnLoading" class="spinner-border spinner-border-sm d-none"
                                            role="status" aria-hidden="true"></span>
                                    </button>
                                    <button class="btn btn-danger btn-export" id="export-pdf">
                                        <i class="bi bi-file-earmark-pdf me-2"></i> Export PDF
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table d-none d-md-table tblPendaftaran datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" class="text-nowrap">No Register</th>
                                <th scope="col">Nama</th>
                                @if ($jalur == 'Jalur Prestasi Raport')
                                    <th scope="col" class="text-center">Peringkat Raport</th>
                                @elseif ($jalur == 'Jalur Zonasi')
                                    <th scope="col">Peringkat Zonasi</th>
                                @elseif ($jalur == 'Jalur Afirmasi')
                                    <th scope="col" class="text-nowrap">Jenis Afirmasi</th>
                                @elseif ($jalur == 'Jalur Prestasi Akademik' || $jalur == 'Jalur Prestasi Non Akademik')
                                    <th scope="col">Nama Lomba</th>
                                    <th scope="col" class="text-nowrap">Perolehan</th>
                                @endif
                                <th scope="col">Tanggal Daftar</th>
                                <th scope="col" class="text-center">Status</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = request('start_rank') ? (int) request('start_rank') : 1;
                            @endphp
                            @forelse ($pendaftarans as $pendaftaran)
                                <tr>
                                    <th>{{ $no++ }}</th>
                                    <td>{{ $pendaftaran->register->no_register }}</td>
                                    <td>{{ $pendaftaran->register->siswa->nama }}</td>

                                    @if ($pendaftaran->register->id_jalur == 6)
                                        <td class="text-center">
                                            <strong>{{ $pendaftaran->peringkat_raport ?? '-' }}</strong>
                                            ({{ $pendaftaran->register->rata_rata_raport?->total_rata_rata }})
                                        </td>
                                    @elseif ($pendaftaran->register->id_jalur == 1)
                                        <td>
                                            <strong>{{ $pendaftaran->peringkat_zonasi ?? '-' }}</strong>
                                            ({{ $pendaftaran->register->siswa->jarak_sekolah }} km)
                                        </td>
                                    @elseif ($pendaftaran->register->id_jalur == 2)
                                        <td>
                                            {{ $pendaftaran->register->afirmasi->jenis_afirmasi }}
                                        </td>
                                    @elseif ($pendaftaran->register->id_jalur == 4)
                                        <td>
                                            {!! $pendaftaran->register->akademik->map(fn($a) => "<div>$a->nama_prestasi</div>")->implode('') !!}
                                        </td>
                                        <td>
                                            {!! $pendaftaran->register->akademik->map(fn($a) => "<div>{$a->perolehan} ({$a->tingkat_prestasi})</div>")->implode('') !!}
                                        </td>
                                    @elseif ($pendaftaran->register->id_jalur == 5)
                                        <td>
                                            {!! $pendaftaran->register->nonAkademik->map(fn($a) => "<div>$a->nama_prestasi</div>")->implode('') !!}
                                        </td>
                                        <td>
                                            {!! $pendaftaran->register->nonAkademik->map(fn($a) => "<div>{$a->perolehan} ({$a->tingkat_prestasi})</div>")->implode('') !!}
                                        </td>
                                    @endif

                                    <td>{{ $pendaftaran->created_at?->format('d/m/Y') ?? '-' }}</td>
                                    <td class="text-center">
                                        @if ($pendaftaran->decline == '1')
                                            <span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i>
                                                {{ $pendaftaran->status }}</span>
                                        @elseif ($pendaftaran->confirmations == '1')
                                            <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>
                                                {{ $pendaftaran->status }}</span>
                                        @else
                                            <span class="badge bg-warning text-dark"><i
                                                    class="bi bi-exclamation-triangle me-1"></i>
                                                {{ $pendaftaran->status }}</span>
                                        @endif
                                    </td>

                                    <td class="align-middle">
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a href="{{ route('admin.detail', $pendaftaran->id) }}"
                                                class="btn btn-info btn-sm">
                                                <i class="bi bi-info-circle"></i>
                                            </a>
                                            <button type="button" class="btn btn-success btn-sm btn-confirm"
                                                data-id="{{ $pendaftaran->id }}"><i
                                                    class="bi bi-check-circle"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm btn-decline"
                                                data-id="{{ $pendaftaran->id }}"><i class="bi bi-x-circle"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
                <!-- End Default Table Example -->


                {{-- Mobile --}}
                <div class="table-responsive d-md-none">
                    <table class="table tblPendaftaran">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Action</th>
                                <th scope="col" class="text-nowrap">No Register</th>
                                <th scope="col">Nama</th>
                                @if ($jalur == 'Jalur Prestasi Raport')
                                    <th scope="col" class="text-center text-nowrap">Peringkat Raport</th>
                                @elseif ($jalur == 'Jalur Zonasi')
                                    <th scope="col" class="text-nowrap">Peringkat Zonasi</th>
                                @elseif ($jalur == 'Jalur Afirmasi')
                                    <th scope="col" class="text-nowrap">Jenis Afirmasi</th>
                                @elseif ($jalur == 'Jalur Prestasi Akademik' || $jalur == 'Jalur Prestasi Non Akademik')
                                    <th scope="col">Nama Lomba</th>
                                    <th scope="col" class="text-nowrap">Perolehan</th>
                                @endif
                                <th scope="col" class="text-nowrap">Tanggal Daftar</th>
                                <th scope="col" class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = request('start_rank') ? (int) request('start_rank') : 1;
                            @endphp
                            @forelse ($pendaftarans as $pendaftaran)
                                <tr>
                                    <th>{{ $no++ }}</th>
                                    <td class="align-middle">
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a href="{{ route('admin.detail', $pendaftaran->id) }}"
                                                class="btn btn-info btn-sm">
                                                <i class="bi bi-info-circle"></i>
                                            </a>
                                            <button type="button" class="btn btn-success btn-sm btn-confirm"
                                                data-id="{{ $pendaftaran->id }}"><i
                                                    class="bi bi-check-circle"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm btn-decline"
                                                data-id="{{ $pendaftaran->id }}"><i class="bi bi-x-circle"></i></button>
                                        </div>
                                    </td>
                                    <td>{{ $pendaftaran->register->no_register }}</td>
                                    <td>{{ $pendaftaran->register->siswa->nama }}</td>

                                    @if ($pendaftaran->register->id_jalur == 6)
                                        <td class="text-center">
                                            <strong>{{ $pendaftaran->peringkat_raport ?? '-' }}</strong>
                                            ({{ $pendaftaran->register->rata_rata_raport?->total_rata_rata }})
                                        </td>
                                    @elseif ($pendaftaran->register->id_jalur == 1)
                                        <td>
                                            <strong>{{ $pendaftaran->peringkat_zonasi ?? '-' }}</strong>
                                            ({{ $pendaftaran->register->siswa->jarak_sekolah }} km)
                                        </td>
                                    @elseif ($pendaftaran->register->id_jalur == 2)
                                        <td>
                                            {{ $pendaftaran->register->afirmasi->jenis_afirmasi }}
                                        </td>
                                    @elseif ($pendaftaran->register->id_jalur == 4)
                                        <td>
                                            {!! $pendaftaran->register->akademik->map(fn($a) => "<div>$a->nama_prestasi</div>")->implode('') !!}
                                        </td>
                                        <td>
                                            {!! $pendaftaran->register->akademik->map(fn($a) => "<div>{$a->perolehan} ({$a->tingkat_prestasi})</div>")->implode('') !!}
                                        </td>
                                    @elseif ($pendaftaran->register->id_jalur == 5)
                                        <td>
                                            {!! $pendaftaran->register->nonAkademik->map(fn($a) => "<div>$a->nama_prestasi</div>")->implode('') !!}
                                        </td>
                                        <td>
                                            {!! $pendaftaran->register->nonAkademik->map(fn($a) => "<div>{$a->perolehan} ({$a->tingkat_prestasi})</div>")->implode('') !!}
                                        </td>
                                    @endif

                                    <td>{{ $pendaftaran->created_at?->format('d/m/Y') ?? '-' }}</td>
                                    <td class="text-center">
                                        @if ($pendaftaran->decline == '1')
                                            <span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i>
                                                {{ $pendaftaran->status }}</span>
                                        @elseif ($pendaftaran->confirmations == '1')
                                            <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>
                                                {{ $pendaftaran->status }}</span>
                                        @else
                                            <span class="badge bg-warning text-dark"><i
                                                    class="bi bi-exclamation-triangle me-1"></i>
                                                {{ $pendaftaran->status }}</span>
                                        @endif
                                    </td>


                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
                {{-- {{ $pendaftarans->links('pagination::bootstrap-5') }} --}}

            </div>
        </div>
        <input type="hidden" id="jalur_export" value="{{ $jalur_export }}">
    </section>
    <script>
        $(document).ready(function() {
            $('.select-filter').select2({
                placeholder: "--- Pilih kriteria urutan ---",
                allowClear: true,
                width: '100%'
            });
            $("#urutkan").on("change", function(e) {
                const selected = $(this).val();
                const url = new URL(window.location.href);
                url.searchParams.set('sort', selected);
                window.location.href = url.toString();
                Swal.fire({
                    title: 'Memuat data...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                $("#keriteria").submit();

            })


            $("#start_rank, #end_rank").on("input", function() {
                const startVal = parseInt($("#start_rank").val());
                const endVal = parseInt($("#end_rank").val());

                if (!startVal || startVal <= 0) {
                    $("#start_rank").addClass("is-invalid").removeClass("is-valid");
                } else {
                    $("#start_rank").removeClass("is-invalid").addClass("is-valid");
                }

                if (!endVal || endVal <= 0) {
                    $("#end_rank").addClass("is-invalid").removeClass("is-valid");
                } else {
                    $("#end_rank").removeClass("is-invalid").addClass("is-valid");
                }

                if (startVal > 0 && endVal > 0 && endVal < startVal) {
                    $("#end_rank").addClass("is-invalid").removeClass("is-valid");
                }
            });


            $("#filter_no").submit(function(e) {
                e.preventDefault();

                const startRank = parseInt($("#start_rank").val());
                const endRank = parseInt($("#end_rank").val());

                if (!startRank) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "No urut dari tidak boleh kosong"
                    });
                    $("#start_rank").addClass("is-invalid");
                    return;
                }

                if (!endRank) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "No urut sampai tidak boleh kosong"
                    });
                    $("#end_rank").addClass("is-invalid");
                    return;
                }

                if (startRank <= 0) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "No urut dari harus lebih dari 0"
                    });
                    $("#start_rank").addClass("is-invalid");
                    return;
                }

                if (endRank <= 0) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "No urut sampai harus lebih dari 0"
                    });
                    $("#end_rank").addClass("is-invalid");
                    return;
                }

                if (endRank < startRank) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "No urut sampai tidak boleh lebih kecil dari no urut dari"
                    });
                    $("#end_rank").addClass("is-invalid");
                    return;
                }

                Swal.fire({
                    title: 'Memuat data...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                this.submit();
            });
            $('#exportExcel').on('click', function(e) {
                e.preventDefault();

                $(".export").addClass('d-none');
                $('#btnText').addClass('d-none');
                $('#btnLoading').removeClass('d-none');
                $('#exportExcel').attr('disabled', true);

                let sort = $('#urutkan').val();
                let start_rank = $('#start_rank').val();
                let end_rank = $('#end_rank').val();
                let top_n = $('#top_n').val();
                let jalur = $('#jalur_export').val();

                let queryParams = $.param({
                    sort: sort,
                    start_rank: start_rank,
                    end_rank: end_rank,
                    top_n: top_n
                });

                window.location.href = `/admin/export/${jalur}?${queryParams}`;

                setTimeout(function() {
                    $(".export").removeClass('d-none');
                    $('#btnText').removeClass('d-none');
                    $('#btnLoading').addClass('d-none');
                    $('#exportExcel').attr('disabled', false);
                }, 3000);
            });

        });
    </script>
@endsection
