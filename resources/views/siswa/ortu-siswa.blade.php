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
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h4>Data Orang Tua</h4>
                                            <a href="{{ route('ortu.edit', ['id' => $data->siswa->id]) }}"
                                                class="btn btn-primary ms-auto">
                                                <i class="fa-solid fa-square-plus"></i> Perbarui data orang tua
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered">
                                                    <tbody class="table-light">
                                                        <tr>
                                                            <th>Nama Ayah / Wali</th>
                                                            <td>{{ $data->siswa->ortu->ayah ?? '_' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Status Ayah / Wali</th>
                                                            <td>{{ $data->siswa->ortu->status_ayah ?? '_' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Pendidikan Ayah / Wali</th>
                                                            <td>{{ $data->siswa->ortu->pendidikan_ayah ?? '_' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Pekerjaan Ayah / Wali</th>
                                                            <td>{{ $data->siswa->ortu->pekerjaan_ayah ?? '_' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Nama Ibu</th>
                                                            <td>{{ $data->siswa->ortu->ibu ?? '_' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Status Ibu</th>
                                                            <td>{{ $data->siswa->ortu->status_ibu ?? '_' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Pendidikan Ibu</th>
                                                            <td>{{ $data->siswa->ortu->pendidikan_ibu ?? '_' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Pekerjaan Ibu</th>
                                                            <td>{{ $data->siswa->ortu->pekerjaan_ibu ?? '_' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Nomor Telepon Orang Tua</th>
                                                            <td>{{ $data->siswa->ortu->no_hp ?? '_' }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
