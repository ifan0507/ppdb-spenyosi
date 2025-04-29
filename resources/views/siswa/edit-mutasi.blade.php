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
                                    action="{{ route('mutasi.update', ['id' => $data->id]) }}" id="main-form">
                                    <input type="hidden" name="_token" value="" autocomplete="off">
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
                                                <select class="form-control" id="tahun" required=""
                                                    name="thn_pindah">
                                                    <option value="" selected="selected">-- Pilih Tahun Pindah Tugas
                                                        --</option>
                                                    <option value="2020">2020</option>
                                                    <option value="2021">2021</option>
                                                    <option value="2022">2022</option>
                                                    <option value="2023">2023</option>
                                                    <option value="2024">2024</option>
                                                    <option value="2025">2025</option>
                                                </select>
                                                <label id="tahun-error" class="error" for="tahun"
                                                    style="display: none">This field is required.</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-8 col-lg-4">
                                            <div class="border m-3 py-1 px-2 text-center" id="photo-box">
                                                <label for="prestasu_blob" class="form-label">
                                                    Documen Pendukung <span style="color:#e3342f">*</span><br />
                                                    <b>(format: JPG/JPEG maks. 1MB)</b>
                                                </label>

                                                <img id="img-prestasi_blob"
                                                    src="{{ asset('storage/' . $data->siswa->image) }}"
                                                    class="img-fluid rounded border mb-2" style="max-width: 100%;">
                                                <label for="prestasi_blob" class="btn btn-primary w-100">
                                                    <i class="fas fa-folder-open"></i> Pilih Foto
                                                </label>
                                                <input type="file" id="prestasi_blob" name="image" class="d-none"
                                                    accept="image/jpeg">
                                                <div id="info-prestasi_blob" class="text-muted mt-2" style="display:none;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-sm-8 col-lg-6">
                                            <button type="submit" class="btn btn-block btn-primary">
                                                <i class="fas fa-plus-circle"></i>
                                                Tambahkan Dokumen
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
@endsection
