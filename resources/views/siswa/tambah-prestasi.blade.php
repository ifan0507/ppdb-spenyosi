@extends('layouts.siswa.template')

@section('content')
    <div class="misc-content pt-4">
        @include('layouts.siswa.breadcrumb')
        <div class="container-fluid">
            @include('layouts.siswa.header-update')
            <div class="row justify-content-center">
                <div class="card card-primary card-outline card-outline-tabs col-md-12">
                    <div class="card-body">
                        <form method="POST"
                            @if ($data->jalur->id == 4) action="{{ route('akademik.store') }}"
                            @else
                              action="{{ route('non-akademik.store') }}" @endif
                            enctype="multipart/form-data" id="main-form">
                            @csrf
                            <div class="row">
                                <div class="col-sm-8 col-lg-6">
                                    <div class="form-group required">
                                        <label class="title">Nama Kegiatan</label>
                                        <input type="text"
                                            @if ($data->jalur->id == 4) placeholder="Misal: Lomba Olimpiade Sains"
                                            @else
                                            placeholder="Misal: Lomba Olimpiade Olahraga, Seni, Hafidz Qur'an, Pramuka Garuda" @endif
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
                                        <select id="thn_perolehan" class="form-control" name="thn_perolehan">
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
                                            <option value="Peringakt 1">Peringkat 1
                                            </option>
                                            <option value="Peringkat 2">Peringkat 2
                                            </option>
                                            <option value="Peringkat 3">Peringkat 3
                                            </option>
                                            <option value="Lainnya">Lainnya
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
                            "{{ asset('assets/img/default_document.png') }}"
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
                formData.append("_method", "POST");
                let checkedTingkat = $("input[name='tingkat_prestasi']:checked").length > 0;

                if ($("#nama_kegiatan").val() === "") {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Nama kegiatan harus diisi!"
                    })
                    $("#nama_kegiatan").addClass("is-invalid").removeClass("is-valid");

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
                    $("#thn_perolehan").addClass("is-invalid").removeClass("is-valid");
                } else if ($("#perolehan").val() == null) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Pencapain harus dipilih!"
                    })
                    $("#perolehan").addClass("is-invalid").removeClass("is-valid");
                } else if ($("#prestasi_blob").val() === "") {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Document harus diupload!"
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
        });
    </script>
@endsection
