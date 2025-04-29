@extends('layouts.siswa.template')

@section('content')
    <div class="misc-content pt-4">
        @include('layouts.siswa.breadcrumb', [
            'breadcrumb' => [
                'Documen Prestasi' => route('siswa.prestasi'),
                'Perbarui Documen Prestasi' => '',
            ],
        ])

        <div class="container-fluid">
            @include('layouts.siswa.header-update')
            <div class="row justify-content-center">
                <div class="card card-primary card-outline card-outline-tabs col-md-12">
                    <div class="card-body">

                        <form method="POST" enctype="multipart/form-data"
                            action="{{ route('prestasi.update', ['id' => $data->lomba->id]) }}" id="main-form">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-sm-8 col-lg-6">
                                    <div class="form-group required">
                                        <label class="title">Nama Kegiatan</label>
                                        <input type="text" placeholder="Misal: Lomba Thafidz tingkat Provinsi"
                                            class="form-control " name="nama_prestasi" id="nama_kegiatan"
                                            value="{{ old('nama_prestasi', $data->lomba->nama_prestasi) }}">
                                    </div>
                                    <div class="form-group required">
                                        <label class="title" for="jenis">Jenis Kegiatan</label>
                                        <div class="d-block">
                                            <div class="custom-control custom-radio d-inline-block mr-2">
                                                <input type="radio" class="custom-control-input" id="jenis_individual"
                                                    name="jenis_prestasi" value="Individual"
                                                    {{ $data->lomba->jenis_prestasi == 'Individual' ? 'checked' : '' }}>
                                                <label class="custom-control-label"
                                                    for="jenis_individual">Individual</label>
                                            </div>
                                            <div class="custom-control custom-radio d-inline-block">
                                                <input type="radio" class="custom-control-input" id="jenis_grup"
                                                    name="jenis_prestasi" value="Kelompok/Tim"
                                                    {{ $data->lomba->jenis_prestasi == 'Kelompok/Tim' ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="jenis_grup">Kelompok/Tim</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group required">
                                        <label class="title" for="tingkat">Tingkat</label>
                                        <div class="d-block">
                                            <div class="custom-control custom-radio d-inline-block mr-2">
                                                <input type="radio" class="custom-control-input" id="tingkat_kabkota"
                                                    name="tingkat_prestasi" value="Kabupaten/Kota"
                                                    {{ $data->lomba->tingkat_prestasi == 'Individual' ? 'checked' : '' }}>
                                                <label class="custom-control-label"
                                                    for="tingkat_kabkota">Kabupaten/Kota</label>
                                            </div>
                                            <div class="custom-control custom-radio d-inline-block mr-2">
                                                <input type="radio" class="custom-control-input" id="tingkat_provinsi"
                                                    name="tingkat_prestasi" value="Provinsi"
                                                    {{ $data->lomba->tingkat_prestasi == 'Provinsi' ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="tingkat_provinsi">Provinsi</label>
                                            </div>
                                            <div class="custom-control custom-radio d-inline-block mr-2">
                                                <input type="radio" class="custom-control-input" id="tingkat_nasional"
                                                    name="tingkat_prestasi" value="Nasional"
                                                    {{ $data->lomba->tingkat_prestasi == 'Nasional' ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="tingkat_nasional">Nasional</label>
                                            </div>
                                            <div class="custom-control custom-radio d-inline-block">
                                                <input type="radio" class="custom-control-input"
                                                    id="tingkat_internasional" name="tingkat_prestasi" value="Internasional"
                                                    {{ $data->lomba->tingkat_prestasi == 'Internasional' ? 'checked' : '' }}>>
                                                <label class="custom-control-label"
                                                    for="tingkat_internasional">Internasional</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group required">
                                        <label class="title">Tahun Perolehan</label>
                                        <select class="form-control" id="thn_perolehan" name="thn_perolehan">
                                            <option value="" disabled selected>-- Pilih Tahun Perolehan
                                                Prestasi
                                                --</option>
                                            <option value="2020"
                                                {{ $data->lomba->thn_perolehan == '2020' ? 'selected' : '' }}>2020</option>
                                            <option value="2021"
                                                {{ $data->lomba->thn_perolehan == '2021' ? 'selected' : '' }}>2021</option>
                                            <option value="2022"
                                                {{ $data->lomba->thn_perolehan == '2022' ? 'selected' : '' }}>2022</option>
                                            <option value="2023"
                                                {{ $data->lomba->thn_perolehan == '2023' ? 'selected' : '' }}>2023</option>
                                            <option value="2024"
                                                {{ $data->lomba->thn_perolehan == '2024' ? 'selected' : '' }}>2024</option>
                                            <option value="2025"
                                                {{ $data->lomba->thn_perolehan == '2025' ? 'selected' : '' }}>2025</option>
                                        </select>
                                        <label id="tahun-error" class="error" for="tahun" style="display: none">This
                                            field is required.</label>
                                    </div>
                                    <div class="form-group required">
                                        <label class="title">Pencapaian</label><br>
                                        <select class="form-control" id="perolehan" name="perolehan">
                                            <option value="" disabled selected>-- Pilih Pencapaian --
                                            </option>
                                            <option value="Juara 1"
                                                {{ $data->lomba->perolehan == 'Juara 1' ? 'selected' : '' }}>Juara 1
                                            </option>
                                            <option value="Juara 2"
                                                {{ $data->lomba->perolehan == 'Juara 2' ? 'selected' : '' }}>Juara 2
                                            </option>
                                            <option value="Juara 3"
                                                {{ $data->lomba->perolehan == 'Juara 3' ? 'selected' : '' }}>Juara 3
                                            </option>
                                            <option value="Finalis"
                                                {{ $data->lomba->perolehan == 'Finalis' ? 'selected' : '' }}>Finalis
                                            </option>
                                            <option value="Lainnya"
                                                {{ $data->lomba->perolehan == 'Lainnya' ? 'selected' : '' }}>Lainnya
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-8 col-lg-4">
                                    <div class="border m-3 py-1 px-2 text-center" id="photo-box">
                                        <label for="prestasu_blob" class="form-label">
                                            Documen Pendukung <span style="color:#e3342f">*</span><br />
                                            <b>(format: JPG/JPEG maks. 1MB)</b>
                                        </label>

                                        <img id="img-prestasi_blob" src="{{ asset('storage/' . $data->lomba->image) }}"
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
                                    <button type="submit" class="btn btn-primary btn-block" id="btnKirim"><i
                                            class="fas fa-save" id="icon_kirim"></i>
                                        <span id="textBtn"> Perbarui Biodata</span>
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

    <script>
        $(document).ready(function() {
            $("#prestasi_blob").on("change", function() {
                const input = this;
                const imgPreview = $("#img-prestasi_blob");
                const infoBox = $("#info-prestasi_blob");

                if (input.files && input.files[0]) {
                    const file = input.files[0];
                    if (file.size > 1 * 1024 * 1024) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Ukuran file terlalu besar! Maksimal 1MB.!",
                        })
                        $(this).val("");
                        imgPreview.attr("src",
                            "{{ asset('storage/' . $data->lomba->image) }}"
                        );
                        infoBox.hide();
                        return;
                    }

                    infoBox.text(`File: ${file.name} (${(file.size / 1024).toFixed(2)} KB)`).show();

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imgPreview.attr("src", e.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            });

            $("#nama_kegiatan").on("input", function() {
                if ($(this).val().trim() === "") {
                    $(this).addClass("is-invalid");
                } else {
                    $(this).removeClass("is-invalid").addClass("is-valid");
                }
            })

            $("#thn_perolehan ,#perolehan").on("change", function() {
                if ($(this).val() !== "") {
                    $(this).addClass("is-valid").removeClass("is-invalid");
                }
            })

            $("#main-form").on("submit", function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                formData.append("_method", "PUT");
                let checkedJenisKegiatan = $("input[name='jenis_prestasi']:checked").length > 0;
                let checkedTingkat = $("input[name='tingkat_prestasi']:checked").length > 0;

                if ($("#nama_kegiatan").val() === "") {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Nama kegiatan harus diisi!"
                    })
                } else if (!checkedJenisKegiatan) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Jenis kegiatan harus dipilih!"
                    })
                } else if (!checkedTingkat) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Tingkat kegiatan harus dipilih!"
                    })
                } else if ($("#thn_perolehan").val() == null) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Tahun perolehan harus dipilih!"
                    })
                } else if ($("#perolehan").val() == null) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Pencapain harus dipilih!"
                    })
                } else {
                    $("#btnKirim").attr("disabled", true);
                    $("#textBtn").addClass("d-none");
                    $("#icon_kirim").addClass("d-none");
                    $("#loadingBtn").removeClass("d-none");
                    $.ajax({
                        url: $(this).attr("action"),
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(res) {
                            $("#btnKirim").attr("disabled", false);
                            $("#textBtn").removeClass("d-none");
                            $("#icon_kirim").removeClass("d-none");
                            $("#loadingBtn").addClass("d-none");
                            Swal.fire({
                                title: "Berhasil",
                                icon: "success",
                                text: "diperbarui!",
                                confirmButtonText: "OK",
                                confirmButtonColor: "#18a342",
                            }).then(() => {
                                window.location.href = res.redirect;
                            });
                        },
                        error: function(xhr) {
                            var errorString = "";
                            $("#btnKirim").attr("disabled", false);
                            $("#textBtn").removeClass("d-none");
                            $("#icon_kirim").removeClass("d-none");
                            $("#loadingBtn").addClass("d-none");
                            if (xhr.responseJSON && xhr.responseJSON.errors) {
                                $.each(xhr.responseJSON.errors, function(key, messages) {
                                    errorString += messages[0] + "\n";
                                });
                            } else if (xhr.responseJSON && xhr.responseJSON.error) {
                                errorString += xhr.responseJSON.error;
                            } else {
                                errorString += "Kesalahan tidak diketahui.";
                            }

                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: errorString,
                            });
                        }
                    })
                }
            })
        })
    </script>
@endsection
