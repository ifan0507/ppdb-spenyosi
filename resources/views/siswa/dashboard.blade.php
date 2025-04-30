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
                        <div class="card-body p-0">
                            <div class="accordion" id="accordionExample">
                                <div class="card card-primary card-outline">
                                    @include('layouts.siswa.status_berkas')

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
                                            <h4>Biodata {{ $data->siswa->nama }}</h4>
                                            <a href="{{ route('siswa.edit') }}" class="btn btn-primary ms-auto">
                                                <i class="fa-solid fa-square-plus"></i> Perbarui Biodata
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3 text-center">
                                                    <img src="{{ asset('storage/' . $data->siswa->foto_siswa) }}"
                                                        class="img-fluid img-thumbnail mb-3" alt="Foto Pribadi">
                                                </div>

                                                <div class="col-md-9">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered align-middle">
                                                            <tbody class="table-light">
                                                                <tr>
                                                                    <th width="30%">NISN</th>
                                                                    <td>{{ $data->siswa->nisn ?? '_' }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Nama Lengkap</th>
                                                                    <td>{{ $data->siswa->nama ?? '_' }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>NIK</th>
                                                                    <td>{{ $data->siswa->nik ?? '-' }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Jenis Kelamin</th>
                                                                    <td>{{ $data->siswa->jenis_kelamin ?? '_' }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Tempat, Tanggal Lahir</th>
                                                                    @if ($data->siswa->tanggal_lahir == '')
                                                                        <td>_</td>
                                                                    @else
                                                                        <td>{{ $data->siswa->tempat_lahir }},
                                                                            {{ $data->siswa->tanggal_lahir }}</td>
                                                                    @endif
                                                                </tr>
                                                                <tr>
                                                                    <th>Asal sekolah</th>
                                                                    <td>{{ $data->siswa->asal_sekolah ?? '_' }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Kabupaten</th>
                                                                    <td>{{ $data->siswa->kabupaten ?? '_' }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Kecamatan</th>
                                                                    <td>{{ $data->siswa->kecamatan ?? '_' }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Desa</th>
                                                                    <td>{{ $data->siswa->desa ?? '_' }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Alamat</th>
                                                                    <td>
                                                                        {{ $data->siswa->alamat ?? '_' }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>No. HP</th>
                                                                    <td>{{ $data->siswa->no_hp ?? '_' }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Email</th>
                                                                    <td>{{ $data->siswa->email ?? '_' }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Titik Koordinat</th>
                                                                    <td>{{ $data->siswa->lokasi ?? '_' }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Foto KK</th>
                                                                    <td><img src="{{ asset('storage/' . $data->siswa->foto_kk) }}"
                                                                            alt="Foto KK"
                                                                            style="width: 130px; height: 130px;"></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Foto Akte</th>
                                                                    <td><img src="{{ asset('storage/' . $data->siswa->foto_akte) }}"
                                                                            alt="Foto Akte"
                                                                            style="width: 130px; height: 130px;"></td>
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
        </div>
    </div>
@endsection
