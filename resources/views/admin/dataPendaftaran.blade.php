@extends('layouts.admin.template')

@section('content')
    <section class="section">
        @include('layouts.admin.breadcrumb')
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Jalur Umum</h5>
                <!-- Default Table -->
                <div class="table-responsive">
                    <table class="table d-none d-md-table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">No Register</th>
                                <th scope="col">Nama</th>
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
                                            <button type="button" class="btn btn-info btn-sm""><i
                                                    class="bi bi-info-circle"></i></button>
                                            <button type="button" class="btn btn-success btn-sm btn-confirm"
                                                data-id="{{ $pendaftaran->id }}"><i class="bi bi-check-circle"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm btn-decline"
                                                data-id="{{ $pendaftaran->id }}"><i class="bi bi-x-circle"></i></button>
                                        </div>
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
                <!-- End Default Table Example -->


                {{-- Mobile --}}
                <div class="table-responsive d-md-none">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Action</th>
                                <th scope="col">No Register</th>
                                <th scope="col">Nama</th>
                                <th scope="col" class="text-nowrap">Tanggal Daftar</th>
                                <th scope="col" class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($pendaftarans as $pendaftaran)
                                <tr>
                                    <td>
                                        <div class="d-flex gap-2 justify-content-center">
                                            <button type="button" class="btn btn-info btn-sm"><i
                                                    class="bi bi-info-circle"></i></button>
                                            <button type="button" class="btn btn-success btn-sm btn-confirm"
                                                data-id="{{ $pendaftaran->id }}"><i class="bi bi-check-circle"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm btn-decline"
                                                data-id="{{ $pendaftaran->id }}"><i class="bi bi-x-circle"></i></button>
                                        </div>
                                    </td>
                                    <td>{{ $pendaftaran->register->no_register }}</td>
                                    <td class="text-nowrap">{{ $pendaftaran->register->siswa->nama }}</td>
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
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </section>
@endsection
