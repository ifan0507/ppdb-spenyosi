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
                                            <a href="{{ route('ortu.edit') }}" class="btn btn-primary ms-auto">
                                                <i class="fa-solid fa-square-plus"></i> Perbarui data orang tua
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <span class="info-label">Nama:</span>
                                                    <span
                                                        class="d-block">{{ $ortu?->nama_ortu ?? 'Data tidak tersedia' }}</span>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <span class="info-label">Tempat Lahir:</span>
                                                    <span
                                                        class="d-block">{{ $ortu?->tempat_lahir ?? 'Data tidak tersedia' }}</span>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <span class="info-label">Tanggal Lahir:</span>
                                                    <span
                                                        class="d-block">{{ $ortu?->tanggal_lahir ?? 'Data tidak tersedia' }}</span>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <span class="info-label">Kabupaten:</span>
                                                    <span
                                                        class="d-block">{{ $ortu?->kabupaten ?? 'Data tidak tersedia' }}</span>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <span class="info-label">Kecamatan:</span>
                                                    <span
                                                        class="d-block">{{ $ortu?->Kecamatan ?? 'Data tidak tersedia' }}</span>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <span class="info-label">Desa:</span>
                                                    <span class="d-block">{{ $ortu?->Desa ?? 'Data tidak tersedia' }}</span>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <span class="info-label">Alamat:</span>
                                                    <span
                                                        class="d-block">{{ $ortu?->Alamat ?? 'Data tidak tersedia' }}</span>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <span class="info-label">Pekerjaan:</span>
                                                    <span
                                                        class="d-block">{{ $ortu?->pekerjaan ?? 'Data tidak tersedia' }}</span>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <span class="info-label">No. HP:</span>
                                                    <span
                                                        class="d-block">{{ $ortu?->no_hp ?? 'Data tidak tersedia' }}</span>
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
