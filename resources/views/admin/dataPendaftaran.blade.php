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
                                <h6 class="mb-3">Filter No Urut</h6>
                                <form id="export-form">
                                    <div class="row g-2 mb-3">
                                        <div class="col-6">
                                            <input type="number" id="start_number" name="start_number" class="form-control"
                                                placeholder="Dari: 1">
                                        </div>
                                        <div class="col-6">
                                            <input type="number" id="end_number" name="end_number" class="form-control"
                                                placeholder="Sampai: 50">
                                        </div>
                                    </div>
                                </form>

                                <h6 class="mb-3">Urutkan Berdasarkan Kriteria</h6>
                                <form action="{{ route('umum') }}">
                                    <div class="mb-3">
                                        <select class="form-select select-filter" id="urutkan" name="sort"
                                            onchange="this.form.submit()">
                                            <option value="">--- Pilih kriteria urutan ---</option>
                                            @if ($jalur == 'Jalur Umum')
                                                <option value="peringkat_zonasi"
                                                    {{ $sort == 'peringkat_zonasi' ? 'selected' : '' }}>
                                                    Peringkat Zonasi
                                                </option>
                                            @endif
                                            @if ($jalur == 'Jalur Prestasi Raport')
                                                <option value="peringkat_raport"
                                                    {{ $sort == 'peringkat_raport' ? 'selected' : '' }}>
                                                    Peringkat Raport
                                                </option>
                                            @endif
                                            <option value="valid" {{ $sort == 'valid' ? 'selected' : '' }}>Valid</option>
                                            <option value="invalid" {{ $sort == 'invalid' ? 'selected' : '' }}>Invalid
                                            </option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Card Kanan: Tombol Export -->
                        <div class="col-12 col-md-6">
                            <div class="card p-3 shadow-sm d-flex flex-column justify-content-between">
                                <h6 class="mb-3">Export Data</h6>
                                <div class="d-grid gap-2 d-md-flex ">
                                    <button class="btn btn-success btn-export" id="export-excel">
                                        <i class="bi bi-file-earmark-excel me-2"></i> Export Excel
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
                                @elseif ($jalur == 'Jalur Umum')
                                    <th scope="col">Peringkat Zonasi</th>
                                @endif
                                <th scope="col">Tanggal Daftar</th>
                                <th scope="col" class="text-center">Status</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @forelse ($pendaftarans as $pendaftaran)
                                <tr>
                                    <th>{{ $no++ }}</th>
                                    <td>{{ $pendaftaran->register->no_register }}</td>
                                    <td>{{ $pendaftaran->register->siswa->nama }}</td>

                                    @if ($pendaftaran->register->id_jalur == 5)
                                        <td class="text-center">
                                            <strong>{{ $pendaftaran->peringkat_raport ?? '-' }}</strong>
                                            ({{ $pendaftaran->register->raport->total_rata_rata }})
                                        </td>
                                    @elseif ($pendaftaran->register->id_jalur == 1)
                                        <td>
                                            <strong>{{ $pendaftaran->peringkat_zonasi ?? '-' }}</strong>
                                            ({{ $pendaftaran->register->siswa->jarak_sekolah }} km)
                                        </td>
                                    @endif
                                    </td>
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
                                <th scope="col">Action</th>
                                <th scope="col" class="text-nowrap">No Register</th>
                                <th scope="col">Nama</th>
                                @if ($jalur == 'Jalur Prestasi Raport')
                                    <th scope="col" class="text-center text-nowrap">Peringkat Raport</th>
                                @elseif ($jalur == 'Jalur Umum')
                                    <th scope="col" class="text-center text-nowrap">Peringkat Zonasi</th>
                                @endif
                                <th scope="col" class="text-nowrap">Tanggal Daftar</th>
                                <th scope="col" class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pendaftarans as $pendaftaran)
                                <tr>
                                    <td>
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
                                    <td class="text-nowrap">{{ $pendaftaran->register->siswa->nama }}</td>

                                    <td>
                                        @if ($pendaftaran->register->id_jalur == 5)
                                            <strong>{{ $pendaftaran->peringkat_raport ?? '-' }}</strong>
                                            ({{ $pendaftaran->register->raport->total_rata_rata }})
                                        @elseif ($pendaftaran->register->id_jalur == 1)
                                            <strong>{{ $pendaftaran->peringkat_zonasi ?? '-' }}</strong>
                                            ({{ $pendaftaran->register->siswa->jarak_sekolah }} km)
                                        @endif
                                    </td>
                                    <td class="text-nowrap">{{ $pendaftaran->created_at?->format('d/m/Y') ?? '-' }}</td>
                                    <td>
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
                                    <td colspan="6" class="text-center">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
                {{-- {{ $pendaftarans->links('pagination::bootstrap-5') }} --}}

            </div>
        </div>

    </section>
    <script>
        $(document).ready(function() {
            $("#urutkan").on("change", function(e) {
                const selected = $(this).val();
                const url = new URL(window.location.href);
                url.searchParams.set('sort', selected);
                window.location.href = url.toString();
            })
        });
    </script>
@endsection
