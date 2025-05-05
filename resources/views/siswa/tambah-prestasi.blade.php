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
                        <form method="POST"
                            @if ($data->jalur->id == 4) action="{{ route('akademik.store') }}"
                            @else
                              action="{{ route('non-akademik.store') }}" @endif
                            enctype="multipart/form-data" id="main-form">
                            @csrf
                            <div class="form-group row mb-3">
                                <label for="nama_prestasi" class="col-md-4 col-form-label text-md-right">Nama
                                    Prestasi</label>
                                <div class="col-md-6">
                                    <input id="nama_prestasi" type="text"
                                        class="form-control @error('nama_prestasi') is-invalid @enderror"
                                        name="nama_prestasi" value="{{ old('nama_prestasi') }}" required
                                        autocomplete="nama_prestasi">
                                    @error('nama_prestasi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="tingkat_prestasi" class="col-md-4 col-form-label text-md-right">Tingkat
                                    Prestasi</label>
                                <div class="col-md-6">
                                    <select id="tingkat_prestasi"
                                        class="form-control @error('tingkat_prestasi') is-invalid @enderror"
                                        name="tingkat_prestasi" required>
                                        <option value="">Pilih Tingkat Prestasi</option>
                                        <option value="Kabupaten/Kota">Kabupaten/Kota</option>
                                        <option value="Provinsi">Provinsi</option>
                                        <option value="Nasional">Nasional</option>
                                        <option value="Internasional">Internasional</option>
                                    </select>
                                    @error('tingkat_prestasi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="thn_perolehan" class="col-md-4 col-form-label text-md-right">Tahun
                                    Perolehan</label>
                                <div class="col-md-6">
                                    <select id="thn_perolehan"
                                        class="form-control @error('thn_perolehan') is-invalid @enderror"
                                        name="thn_perolehan" required>
                                        <option value="">Pilih Tahun</option>
                                        @php
                                            $currentYear = date('Y');
                                            for ($i = $currentYear; $i >= $currentYear - 5; $i--) {
                                                echo "<option value='" . $i . "'>" . $i . '</option>';
                                            }
                                        @endphp
                                    </select>
                                    @error('thn_perolehan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="perolehan" class="col-md-4 col-form-label text-md-right">Perolehan</label>
                                <div class="col-md-6">
                                    <select id="perolehan" class="form-control @error('perolehan') is-invalid @enderror"
                                        name="perolehan" required>
                                        <option value="">Pilih Perolehan</option>
                                        <option value="Juara 1">Juara 1</option>
                                        <option value="Juara 2">Juara 2</option>
                                        <option value="Juara 3">Juara 3</option>
                                        <option value="Golden Ticket">Golden Ticket</option>
                                    </select>
                                    @error('perolehan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-8 col-lg-4">
                                <div class="border m-3 py-1 px-2 text-center" id="photo-box">
                                    <label for="prestasi_blob" class="form-label">
                                        Dokumen Pendukung <span style="color:#e3342f">*</span><br />
                                        <b>(format: JPG/JPEG maks. 1MB)</b>
                                    </label>

                                    <img id="img-prestasi_blob" src="{{ asset('storage/' . $akademiks->image) }}"
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

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Simpan
                                    </button>
                                    <a href="{{ route('akademik') }}" class="btn btn-secondary">
                                        Kembali
                                    </a>
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
                            "{{ asset('storage/' . $akademiks->image) }}"
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
                let checkedTingkat = $("input[name='tingkat_prestasi']:checked").length > 0;

                if ($("#nama_kegiatan").val() === "") {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Nama kegiatan harus diisi!"
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
        });
    </script>
@endsection
