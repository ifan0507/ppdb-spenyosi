@extends('layouts.siswa.template')

@section('content')
    <div class="misc-content pt-4">
        <div class="container">
            {{-- @include('layouts.siswa.header-update') --}}
            <div class="alert" style="background-color: #2487CE; color: white">
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

                    <div class="container py-3">
                        <div class="card" style="border-top: 3px solid #007bff;">
                            <div class="card-header py-2 d-flex justify-content-between align-items-center">
                                <h2 class="card-title mt-3 mb-3">Biodata {{ $data->siswa->nama }}</h2>
                                <a href="{{ route('siswa.edit') }}" class="btn btn-primary btn-sm ms-auto">
                                    <i class="fas fa-edit"></i> Perbarui Biodata
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 text-center">
                                        <img src="{{ asset('storage/' . $data->siswa->foto_siswa) }}"
                                            class="img-fluid img-thumbnail mb-3" alt="Foto Pribadi">
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
                                                    <td>{{ $data->siswa->nama }}</td>
                                                </tr>
                                                <tr>
                                                    <th>NIK</th>
                                                    <td>{{ $data->siswa->nik ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Jenis Kelamin</th>
                                                    <td>{{ $data->siswa->jenis_kelamin }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tempat, Tanggal Lahir</th>
                                                    <td>{{ $data->siswa->tempat_lahir }},
                                                        {{ $data->siswa->tanggal_lahir }}</td>
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
                                                        {{ $data->siswa->dusun }},
                                                        {{ $data->siswa->rt }},
                                                        {{ $data->siswa->rw }},
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
                                                            alt="Foto KK"></td>
                                                </tr>
                                                <tr>
                                                    <th>Foto Akte</th>
                                                    <td><img src="{{ asset('storage/' . $data->siswa->foto_akte) }}"
                                                            alt="Foto Akte"></td>
                                                </tr>
                                                <tr class="{{ $data->jalur->id !== '1' ? 'd-none' : '' }}">
                                                    <th>Document</th>
                                                    <td>{{ $data->siswa->documents }}</td>
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
        @endsection
