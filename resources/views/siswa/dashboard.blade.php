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
                                                        <table
                                                            class="table table-striped table-hover table-bordered align-middle">
                                                            <tbody class="table-light">
                                                                <tr>
                                                                    <th width="30%">NISN</th>
                                                                    <td>{{ $data->siswa->nisn }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Nama Lengkap</th>
                                                                    <td>{{ $data->siswa->nama }}</td>
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
                                                                        <td>{{ $data->siswa->tempat_lahir }}</td>
                                                                    @else
                                                                        <td>{{ $data->siswa->tempat_lahir }},
                                                                            {{ $data->siswa->tanggal_lahir }}</td>
                                                                    @endif
                                                                </tr>
                                                                <tr>
                                                                    <th>Asal sekolah</th>
                                                                    <td>{{ $data->siswa->asal_sekolah }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Kabupaten</th>
                                                                    <td>{{ $data->siswa->kabupaten }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Kecamatan</th>
                                                                    <td>{{ $data->siswa->kecamatan }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Desa</th>
                                                                    <td>{{ $data->siswa->desa }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Alamat</th>
                                                                    <td>
                                                                        {{ $data->siswa->alamat }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>No. HP</th>
                                                                    <td>{{ $data->siswa->no_hp }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Email</th>
                                                                    <td>{{ $data->siswa->email }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Titik Koordinat</th>
                                                                    <td>{{ $data->siswa->lokasi }}</td>
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
                                                                @if ($data->jalur->id == '2' || $data->jalur->id == '3' || $data->jalur->id == '4')
                                                                    <tr>
                                                                        <th>
                                                                            @if ($data->jalur->id == '2')
                                                                                KIP/KIS/PIP/PKH/SKTM
                                                                            @elseif ($data->jalur->id == '3')
                                                                                Surat Pindah Tugas
                                                                            @elseif ($data->jalur->id == '4')
                                                                                Piagam Prestasi
                                                                            @endif
                                                                        </th>
                                                                        <td><img src="{{ asset('storage/' . $data->document->document) }}"
                                                                                alt=""
                                                                                style="width: 130px; height: 130px;">
                                                                        </td>
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
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
