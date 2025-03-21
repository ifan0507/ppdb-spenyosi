@extends('layouts.siswa.template')
@section('content')
    <div class="misc-content pt-4">
        <div class="container">
            <div class="alert alert-primary">
                <i class="fas fa-check"></i>
                Jalur PPDB {{ $data->jalur->nama_jalur }}
            </div>
            <div class="row justify-content-center">
                <div class="card card-primary card-outline card-outline-tabs m-0 p-0 col-md-12">
                    <div class="card-header p-0 border-bottom-0">
                    </div>
                    <div class="card-body p-0">
                        <div class="accordion" id="accordionExample">
                            <div class="card card-primary card-outline">
                                <div class="card-header" id="headingOne">
                                    <h5 class="row justify-content-between">
                                        <div class="col-8 pt-lg-2">
                                            <h4 class="font-bold" style="display: inline-block";>
                                                Status Kelengkapan Berkas
                                            </h4>
                                            @if ($data->siswa->status_berkas == '0')
                                                <span class="badge badge-danger p-2 ml-2"
                                                    style="border-radius: 0.5rem";>Belum Lengkap</span>
                                            @else
                                                <span class="badge badge-success p-2 ml-2"
                                                    style="border-radius: 0.5rem";>Lengkap</span>
                                            @endif
                                        </div>

                                    </h5>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="card card-primary card-outline card-outline-tabs col-md-12">
                    @include('layouts.siswa.tab-content')
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="card-body p-0">
                                <div class="accordion" id="accordionExample">
                                    <div class="card card-primary card-outline">
                                        @if (!$raports->isEmpty() && optional($raports->first())->status == '1')
                                            <div class="card-header d-flex justify-content-between align-items-center">
                                                <h4>Raport</h4>
                                                <a href="{{ route('edit-raport', ['id' => $data->id]) }}"
                                                    class="btn btn-primary ms-auto">
                                                    <i class="fas fa-edit"></i> Perbarui data raport
                                                </a>
                                            </div>
                                        @else
                                            <div class="card-header d-flex justify-content-between align-items-center">
                                                <h4>Raport</h4>
                                                <a href="{{ route('form-raport') }}" class="btn btn-primary ms-auto">
                                                    <i class="fa-solid fa-square-plus"></i> Tambah data raport
                                                </a>
                                            </div>
                                        @endif



                                        <div class="card-header" id="headingOne">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th rowspan="2" class="align-middle text-center">No</th>
                                                            <th rowspan="2" class="align-middle text-center">Mata
                                                                Pelajaran</th>
                                                            <th colspan="2" class="align-middle text-center">Rapor
                                                                Kelas 4</th>
                                                            <th colspan="2" class="align-middle text-center">Rapor
                                                                Kelas 5</th>
                                                            <th class="align-middle text-center">Rapor Kelas 6</th>

                                                        </tr>
                                                        <tr>
                                                            <th class="align-middle text-center">Semester 1</th>
                                                            <th class="align-middle text-center">Semester 2</th>
                                                            <th class="align-middle text-center">Semester 1</th>
                                                            <th class="align-middle text-center">Semester 2</th>
                                                            <th class="align-middle text-center">Semester 1</th>
                                                    </thead>
                                                    <tbody>
                                                        @php $no = 1; @endphp
                                                        @forelse ($raports as $raport)
                                                            <tr>
                                                                <td>{{ $no++ }}</td>
                                                                <td>
                                                                    {{ $raport->mapel->nama_matapelajaran }}
                                                                </td>
                                                                <td>
                                                                    {{ $raport->kelas4_1 }}
                                                                </td>
                                                                <td>
                                                                    {{ $raport->kelas4_2 }}
                                                                </td>
                                                                <td>
                                                                    {{ $raport->kelas5_1 }}
                                                                </td>
                                                                <td>
                                                                    {{ $raport->kelas5_2 }}
                                                                </td>
                                                                <td>
                                                                    {{ $raport->kelas6_1 }}
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="8" class="text-center">
                                                                    <p>Tidak ada data</p>
                                                                </td>
                                                            </tr>
                                                        @endforelse
                                                        @if (!$raports->isEmpty())
                                                            <tr>
                                                                <td colspan="2"><strong>Rata-rata Nilai</strong></td>
                                                                <td>{{ $raports->avg('rata_kelas4_sem1') }}</td>
                                                                <td>{{ $raports->avg('rata_kelas4_sem2') }}</td>
                                                                <td>{{ $raports->avg('rata_kelas5_sem1') }}</td>
                                                                <td>{{ $raports->avg('rata_kelas5_sem2') }}</td>
                                                                <td>{{ $raports->avg('rata_kelas6_sem1') }}</td>
                                                            </tr>
                                                        @endif

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
@endsection
