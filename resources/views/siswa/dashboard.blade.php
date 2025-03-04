@extends('layouts.siswa.template')

@section('content')
    <div class="container py-3">
        <div class="card" style="border-top: 3px solid #007bff;">
            <div class="card-header py-2 d-flex justify-content-between align-items-center">
                <h2 class="card-title mt-3 mb-3">Biodata {{ $data->siswa->nama }}</h2>
                <a href="#" class="btn btn-primary btn-sm ms-auto">
                    <i class="fas fa-edit"></i> Perbarui Biodata
                </a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 text-center">
                        <img src="{{ asset('images/' . $data->siswa->foto) }}" class="img-fluid img-thumbnail mb-3"
                            alt="Foto Pribadi">
                    </div>
                    <div class="col-md-9">
                        <table class="table table-striped table-hover table-bordered align-middle">
                            <tbody class="table-light">
                                <tr>
                                    <th width="30%">NISN</th>
                                    <td>{{ $data->siswa->nisn }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Lengkap</th>
                                    <td>{{ $data->siswa->nik }}</td>
                                </tr>
                                <tr>
                                    <th>NIK</th>
                                    <td>{{ $data->siswa->kip ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td>{{ $data->siswa->asal_sekolah }}</td>
                                </tr>
                                <tr>
                                    <th>Tempat, Tanggal Lahir</th>
                                    <td>{{ $data->siswa->tempat_lahir }}, {{ $data->siswa->tanggal_lahir }}</td>
                                </tr>
                                <tr>
                                    <th>Asal sekolah</th>
                                    <td>{{ $data->siswa->jenis_kelamin }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>{{ $data->siswa->agama }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $data->siswa->email }}</td>
                                </tr>
                                <tr>
                                    <th>No. HP</th>
                                    <td>{{ $data->siswa->provinsi }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
