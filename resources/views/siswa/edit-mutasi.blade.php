@extends('layouts.siswa.template')

@section('content')
    <div class="misc-content pt-4">
        @include('layouts.siswa.breadcrumb', [
            'breadcrumb' => [
                'Documen Pindah Tugas' => route('siswa.mutasi'),
                'Perbarui Dokumen Pindah Tugas' => '',
            ],
        ])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <div class="d-flex">
                                    <h5 class="m-0">Tambahkan Dokumen Pindah Tugas</h5>
                                </div>
                            </div>
                            <div class="card-body">
                                <form method="POST" enctype="multipart/form-data"
                                    action="{{ route('mutasi.update', ['id' => $data->mutasi->id]) }}" id="main-form">
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-8 col-lg-6">
                                            <div class="form-group required">
                                                <label class="title">Asal Tugas</label>
                                                <input type="text" placeholder="Surabaya - Lumajang"
                                                    class="form-control " name="asal_tugas" id="asal_tugas" value=""
                                                    required="">
                                            </div>

                                            <div class="form-group required">
                                                <label class="title">Tahun Pindah</label>
                                                <select class="form-control" id="thn_pindah" required=""
                                                    name="thn_pindah">
                                                    <option value="" disabled selected>-- Pilih Tahun Pindah Tugas
                                                        --</option>
                                                    <option value="2020"
                                                        {{ $data->mutasi->thn_pindah == '2020' ? 'selected' : '' }}>2020
                                                    </option>
                                                    <option value="2021"
                                                        {{ $data->mutasi->thn_pindah == '2021' ? 'selected' : '' }}>2021
                                                    </option>
                                                    <option value="2022"
                                                        {{ $data->mutasi->thn_pindah == '2022' ? 'selected' : '' }}>2022
                                                    </option>
                                                    <option value="2023"
                                                        {{ $data->mutasi->thn_pindah == '2023' ? 'selected' : '' }}>2023
                                                    </option>
                                                    <option value="2024"
                                                        {{ $data->mutasi->thn_pindah == '2024' ? 'selected' : '' }}>2024
                                                    </option>
                                                    <option value="2025"
                                                        {{ $data->mutasi->thn_pindah == '2025' ? 'selected' : '' }}>2025
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-8 col-lg-4">
                                            <div class="border m-3 py-1 px-2 text-center" id="photo-box">
                                                <label for="mutasi_blob" class="form-label">
                                                    Documen Pendukung <span style="color:#e3342f">*</span><br />
                                                    <b>(format: JPG/JPEG maks. 1MB)</b>
                                                </label>

                                                <img id="img-mutasi_blob"
                                                    src="{{ asset('storage/' . $data->mutasi->image) }}"
                                                    class="img-fluid rounded border mb-2" style="max-width: 100%;">
                                                <label for="mutasi_blob" class="btn btn-primary w-100">
                                                    <i class="fas fa-folder-open"></i> Pilih Foto
                                                </label>
                                                <input type="file" id="mutasi_blob" name="image" class="d-none"
                                                    accept="image/jpeg">
                                                <div id="info-mutasi_blob" class="text-muted mt-2" style="display:none;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-sm-8 col-lg-6">
                                            <button type="submit" class="btn btn-primary btn-block" id="btnKirim"><i
                                                    class="fas fa-save" id="icon_kirim"></i>
                                                <span id="textBtn"> Perbarui Dokumen Pindah Tugas</span>
                                                <span id="loadingBtn" class="spinner-border spinner-border-sm d-none"
                                                    role="status" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script></script>
@endsection
