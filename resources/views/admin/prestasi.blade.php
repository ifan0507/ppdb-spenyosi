@extends('layouts.admin.template')

@section('content')
    @include('layouts.admin.breadcrumb', [
        'title' => 'Jalur Prestasi',
        'breadcrumb' => [
            'Master Data' => '',
            'Jalur Prestasi' => '',
        ],
    ])
    {{-- <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Datatables</h5>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            No. Pendaftaran
                                        </th>
                                        <th>Tanggal Daftar</th>
                                        <th>Nama Lengkap</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pendaftarans as $pendaftaran)
                                        <tr>
                                            <td>{{ $pendaftaran->register->no_register }}</td>
                                            <td>{{ $pendaftaran->tanggal_daftar }}</td>
                                            <td>{{ $pendaftaran->register->siswa->nama }}</td>
                                            <td>
                                                @if ($pendaftaran->decline == '1')
                                                    <span class="badge bg-danger"><i
                                                            class="bi bi-exclamation-octagon me-1"></i>
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
                                            <td>
                                                <a href="{{ route('admin.confirm', ['id' => $pendaftaran->id]) }}"
                                                    class="btn btn-success btn-sm"><i class="bi bi-check-circle"></i>
                                                </a>
                                                <a href="{{ route('admin.decline', ['id' => $pendaftaran->id]) }}"
                                                    class="btn btn-danger btn-sm"><i class="bi bi-exclamation-octagon"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-info btn-sm"><i
                                                        class="bi bi-info-circle"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <td>Tidak ada data</td>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section> --}}
@endsection
