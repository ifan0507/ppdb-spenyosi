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
                                @include('layouts.siswa.status_berkas')
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
                                            <h4>Dokumen Afirmasi</h4>
                                            <a href="{{ route('afirmasi.edit', ['id' => $data->id]) }}"
                                                class="btn btn-primary ms-auto">
                                                <i class="fa-solid fa-square-plus"></i> Perbarui Dokumen Afirmasi
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3 text-center">
                                                    <img src="{{ asset('storage/' . $data->afirmasi->image) }}"
                                                        alt="Foto Prestasi" class="img-fluid img-thumbnail mb-3">
                                                </div>

                                                <div class="col-md-9">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered align-middle">
                                                            <tbody class="table-light">
                                                                <tr>
                                                                    <th width="30%">Jenis Afirmasi</th>
                                                                    <td>{{ $data->afirmasi->jenis_afirmasi }}</td>
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
