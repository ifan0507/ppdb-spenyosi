@extends('layouts.siswa.template')

@section('content')
    <div class="misc-content pt-4">
        @include('layouts.siswa.breadcrumb', [
            'breadcrumb' => [
                'Documen Prestasi' => route('siswa.prestasi'),
                'Perbarui Documen Prestasi' => '',
            ],
        ])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <div class="d-flex">
                                    <h5 class="m-0">Tambahkan Prestasi</h5>
                                </div>
                            </div>
                            <div class="card-body">

                                <form method="POST" enctype="multipart/form-data" action="" id="main-form">
                                    <input type="hidden" name="_token" value="" autocomplete="off">
                                    <div class="row">
                                        <div class="col-sm-8 col-lg-6">
                                            <div class="form-group required">
                                                <label class="title">Nama Kegiatan</label>
                                                <input type="hidden" name="nama_prestasi" id="nama_prestasi"
                                                    value="">
                                                <input type="text" placeholder="Misal: Lomba Thafidz tingkat Provinsi"
                                                    class="form-control " name="nama_kegiatan" id="nama_kegiatan"
                                                    value="" required="">
                                            </div>
                                            <div class="form-group required">
                                                <label class="title" for="jenis">Jenis Kegiatan</label>
                                                <div class="d-block">
                                                    <div class="custom-control custom-radio d-inline-block mr-2">
                                                        <input type="radio" class="custom-control-input"
                                                            id="jenis_individual" name="jenis" value="Individual" checked>
                                                        <label class="custom-control-label"
                                                            for="jenis_individual">Individual</label>
                                                    </div>
                                                    <div class="custom-control custom-radio d-inline-block">
                                                        <input type="radio" class="custom-control-input" id="jenis_grup"
                                                            name="jenis" value="Kelompok/Tim">
                                                        <label class="custom-control-label"
                                                            for="jenis_grup">Kelompok/Tim</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group required">
                                                <label class="title" for="tingkat">Tingkat</label>
                                                <div class="d-block">
                                                    <div class="custom-control custom-radio d-inline-block mr-2">
                                                        <input type="radio" class="custom-control-input"
                                                            id="tingkat_kabkota" name="tingkat" value="Kabupaten/Kota"
                                                            checked>
                                                        <label class="custom-control-label"
                                                            for="tingkat_kabkota">Kabupaten/Kota</label>
                                                    </div>
                                                    <div class="custom-control custom-radio d-inline-block">
                                                        <input type="radio" class="custom-control-input"
                                                            id="tingkat_provinsi" name="tingkat" value="Provinsi">
                                                        <label class="custom-control-label"
                                                            for="tingkat_provinsi">Provinsi</label>
                                                    </div>
                                                    <div class="custom-control custom-radio d-inline-block">
                                                        <input type="radio" class="custom-control-input"
                                                            id="tingkat_nasional" name="tingkat" value="Nasional">
                                                        <label class="custom-control-label"
                                                            for="tingkat_nasional">Nasional</label>
                                                    </div>
                                                    <div class="custom-control custom-radio d-inline-block">
                                                        <input type="radio" class="custom-control-input"
                                                            id="tingkat_internasional" name="tingkat" value="Internasional">
                                                        <label class="custom-control-label"
                                                            for="tingkat_internasional">Internasional</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group required">
                                                <label class="title">Tahun Perolehan</label>
                                                <select class="form-control" id="tahun" required="" name="tahun">
                                                    <option value="" selected="selected">-- Pilih Tahun Perolehan
                                                        Prestasi
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
                                            <div class="form-group required">
                                                <label class="title">Pencapaian</label><br>
                                                <select class="form-control" id="pencapaian" required=""
                                                    name="pencapaian">
                                                    <option value="" selected="selected">-- Pilih Pencapaian --
                                                    </option>
                                                    <option value="Juara 1">Juara 1</option>
                                                    <option value="Juara 2">Juara 2</option>
                                                    <option value="Juara 3">Juara 3</option>
                                                    <option value="Finalis">Finalis</option>
                                                    <option value="Honorable Mention">Honorable Mention</option>
                                                    <option value="Lainnya">Lainnya</option>
                                                </select>
                                                <input type="text" class="form-control " name="pencapaian_lain"
                                                    placeholder="Sebutkan pencapaian yang diraih" id="pencapaian_lain"
                                                    value="" style="display: none">
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
                                                <div id="info-prestasi_blob" class="text-muted mt-2"
                                                    style="display:none;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-sm-8 col-lg-6">
                                            <button type="submit" class="btn btn-block btn-primary">
                                                <i class="fas fa-plus-circle"></i>
                                                Tambahkan Prestasi
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
