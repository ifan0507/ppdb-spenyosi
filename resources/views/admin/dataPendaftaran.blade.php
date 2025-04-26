@extends('layouts.admin.template')

@section('content')
    <section class="section">
        @include('layouts.admin.breadcrumb')
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">Jalur Pindah Tugas</h5>
                    {{-- Dectop --}}
                    <div class="d-none d-md-block position-relative" style="width:300px;">
                        <input id="searchInputDesktop" class="form-control ps-4" placeholder="Search"
                            style="padding-right: 2.5rem;">
                        <i class="bi bi-search position-absolute top-50 end-0 translate-middle-y me-3"></i>
                    </div>

                </div>
                {{-- Mobile --}}
                <div class="d-block d-md-none mb-3 position-relative">
                    <input id="searchInputDesktop" class="form-control ps-4" placeholder="Search"
                        style="padding-right: 2.5rem;">
                    <i class="bi bi-search position-absolute top-50 end-0 translate-middle-y me-3"></i>
                </div>

                <!-- Default Table -->
                <div class="table-responsive">
                    <table class="table d-none d-md-table tblPendaftaran">
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
                    {{ $pendaftarans->links() }}
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
                            @php
                                $no = 1;
                            @endphp
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

            </div>
        </div>

    </section>
    <script>
        $(document).ready(function() {
            const $rows = $('.tblPendaftaran tbody tr');

            ['#searchInputDesktop', '#searchInputMobile'].forEach(sel => {
                const $input = $(sel);
                if (!$input.length) return;

                $input.on('keyup', function() {
                    const filter = $(this).val().toLowerCase();

                    $rows.each(function() {
                        const $row = $(this);

                        if ($row.children().length === 1) return;

                        const rowText = $row.text().toLowerCase();
                        $row.toggle(rowText.includes(
                            filter));
                    });
                });
            });
        });
    </script>
@endsection
