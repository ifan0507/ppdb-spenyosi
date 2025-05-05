@extends('layouts.siswa.template')

@section('content')
    <div class="misc-content pt-4">
        @include('layouts.siswa.breadcrumb', [
            'breadcrumb' => [
                'Documen Prestasi' => route('siswa.akademik'),
                'Tambah Dokumen Prestasi' => '',
            ],
        ])
        <div class="container-fluid">
            @include('layouts.siswa.header-update')
            <div class="row justify-content-center">
                <div class="card card-primary card-outline card-outline-tabs col-md-12">
                    <div class="card-body">
                        <form method="POST" action="{{ route('akademik.store') }}" enctype="multipart/form-data"
                            id="prestasiForm">
                            @csrf
                            <div class="row">
                                <div class="col-sm-8 col-lg-6">
                                    <div class="form-group required">
                                        <label class="title">Nama Kegiatan</label>
                                        <input type="text" placeholder="Misal: Lomba Thafidz tingkat Provinsi"
                                            class="form-control " name="nama_prestasi" id="nama_kegiatan"
                                            value="{{ old('nama_prestasi') }}">
                                    </div>

                                    <div class="form-group required">
                                        <label class="title" for="tingkat">Tingkat</label>
                                        <div class="d-block">
                                            <div class="custom-control custom-radio d-inline-block mr-2">
                                                <input type="radio" class="custom-control-input" id="tingkat_kecamatan"
                                                    name="tingkat_prestasi" value="Kecamatan">
                                                <label class="custom-control-label"
                                                    for="tingkat_kecamatan">Kecamatan</label>
                                            </div>
                                            <div class="custom-control custom-radio d-inline-block mr-2">
                                                <input type="radio" class="custom-control-input" id="tingkat_kabkota"
                                                    name="tingkat_prestasi" value="Kabupaten/Kota">
                                                <label class="custom-control-label"
                                                    for="tingkat_kabkota">Kabupaten/Kota</label>
                                            </div>
                                            <div class="custom-control custom-radio d-inline-block mr-2">
                                                <input type="radio" class="custom-control-input" id="tingkat_provinsi"
                                                    name="tingkat_prestasi" value="Provinsi">
                                                <label class="custom-control-label" for="tingkat_provinsi">Provinsi</label>
                                            </div>
                                            <div class="custom-control custom-radio d-inline-block mr-2">
                                                <input type="radio" class="custom-control-input" id="tingkat_nasional"
                                                    name="tingkat_prestasi" value="Nasional">
                                                <label class="custom-control-label" for="tingkat_nasional">Nasional</label>
                                            </div>
                                            <div class="custom-control custom-radio d-inline-block">
                                                <input type="radio" class="custom-control-input"
                                                    id="tingkat_internasional" name="tingkat_prestasi"
                                                    value="Internasional">
                                                <label class="custom-control-label"
                                                    for="tingkat_internasional">Internasional</label>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="form-group required">
                                        <label class="title">Tahun Perolehan </label>
                                        <select id="thn_perolehan" class="form-control" name="thn_perolehan" required>
                                            <option value="" disabled selected>Pilih Tahun</option>
                                            @php
                                                $currentYear = date('Y');
                                                for ($i = $currentYear; $i >= $currentYear - 5; $i--) {
                                                    echo "<option value='" . $i . "'>" . $i . '</option>';
                                                }
                                            @endphp
                                        </select>
                                        <label id="tahun-error" class="error" for="tahun" style="display: none">This
                                            field is required.</label>
                                    </div>

                                    <div class="form-group required">
                                        <label class="title">Pencapaian</label><br>
                                        <select class="form-control" id="perolehan" name="perolehan">
                                            <option value="" disabled selected>-- Pilih Pencapaian --
                                            </option>
                                            <option value="Juara 1">Juara 1
                                            </option>
                                            <option value="Juara 2">Juara 2
                                            </option>
                                            <option value="Juara 3">Juara 3
                                            </option>
                                            <option value="Golden Ticket">Golden
                                                Ticket
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-8 col-lg-4">
                                    <div class="border m-3 py-1 px-2 text-center" id="photo-box">
                                        <label for="prestasu_blob" class="form-label">
                                            Dokumen Pendukung <span style="color:#e3342f">*</span><br />
                                            <b>(format: JPG/JPEG maks. 1MB)</b>
                                        </label>

                                        <img id="img-prestasi_blob" src="{{ asset('assets/img/default_document.png') }}"
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

                                <div class="row justify-content-center">
                                    <div class="col-sm-8 col-lg-6">
                                        <button type="submit" class="btn btn-primary btn-block" id="btnKirim">
                                            <i class="fas fa-save" id="icon_kirim"></i>
                                            <span id="textBtn"> Tambah Document Prestasi</span>
                                            <span id="loadingBtn" class="spinner-border spinner-border-sm d-none"
                                                role="status" aria-hidden="true"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>


                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#prestasiForm').submit(function(e) {
                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.redirect) {
                            window.location.href = response.redirect;
                        }
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('#' + key).addClass('is-invalid');
                            $('#' + key).after('<div class="invalid-feedback">' + value[
                                0] + '</div>');
                        });
                    }
                });
            });
        });
    </script>
@endsection
