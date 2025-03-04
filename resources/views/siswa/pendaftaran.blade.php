@extends('layouts.siswa.template')
@section('content')
    <div class="misc-content pt-4">
        <div class="container">
            <div class="alert alert-primary">
                <i class="fas fa-check"></i>
                Jalur PPDB {{ $data->jalur_ppdb }}
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
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="formulir-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link remove-tab-format font-bold {{ $active_tab == 'biodata' ? 'active' : '' }}"
                                    id="biodata-tab" data-toggle="pill" href="{{ route('dashboard-siswa') }}" role="tab"
                                    aria-controls="biodata" aria-selected="true">Biodata</a>
                            </li>
                            @if ($data->jalur_ppdb == 'Prestasi')
                                <li class="nav-item">
                                    <a class="nav-link remove-tab-format font-bold {{ $active_tab == 'raport' ? 'active' : '' }}"
                                        id="keluarga-tab" data-toggle="pill" href="{{ route('raport') }}" role="tab"
                                        aria-controls="keluarga" aria-selected="false">Raport</a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link remove-tab-format font-bold {{ $active_tab == 'pendaftaran' ? 'active' : '' }}"
                                    id="biodata-tab" data-toggle="pill" href="{{ route('pendaftaran') }}" role="tab"
                                    aria-controls="biodata" aria-selected="true">Kirim data pendaftaran</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="card-body p-0">
                                <div class="accordion" id="accordionExample">
                                    <div class="card card-primary card-outline">
                                        <div class="card-header" id="headingOne">
                                            <h5 class="mb-0">Konfirmasi Pendaftaran</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault"
                                                            style="color: red;">
                                                            Saya menyatakan bahwa seluruh data dan persyaratan pendaftaran
                                                            jalur
                                                            <strong>{{ $data->jalur_ppdb }}</strong> yang saya isi adalah
                                                            benar dan sesuai.
                                                            Saya bertanggung jawab atas keabsahan data yang dikirimkan.
                                                        </label>
                                                    </div>
                                                    <br>
                                                    <button type="submit" class="btn btn-primary" id="btnSubmit" disabled>
                                                        <i class="fas fa-save"></i>
                                                        <span id="btnText">Kirim Data Pendaftaran</span>
                                                        <span id="btnLoading"
                                                            class="spinner-border spinner-border-sm d-none" role="status"
                                                            aria-hidden="true"></span>
                                                    </button>
                                                </div>
                                            </div>
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
@endsection
