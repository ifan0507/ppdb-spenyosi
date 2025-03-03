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
                                    id="biodata-tab" data-toggle="pill" href="{{ route('dashboard-siswa') }}"
                                    role="tab">Biodata</a>
                            </li>
                            @if ($data->jalur_ppdb == 'Prestasi')
                                <li class="nav-item">
                                    <a class="nav-link remove-tab-format font-bold {{ $active_tab == 'raport' ? 'active' : '' }}"
                                        id="keluarga-tab" data-toggle="pill" href="{{ route('raport') }}"
                                        role="tab">Raport</a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link remove-tab-format font-bold {{ $active_tab == 'pendaftaran' ? 'active' : '' }}"
                                    id="biodata-tab" data-toggle="pill" href="{{ route('pendaftaran') }}" role="tab"
                                    aria-controls="biodata" aria-selected="true">Konfirmasi pendaftaran</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">

                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
@endsection
