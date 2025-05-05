@extends('layouts.siswa.template')

@section('content')
    <div class="misc-content pt-4">
        @include('layouts.siswa.breadcrumb')

        <div class="container-fluid">
            @include('layouts.siswa.header-update')
            <div class="row justify-conten-center">
                <div class="card card-primary card-outline card-outline-tabs col-md-12">
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data"
                            action="{{ route('mutasi.update', ['id' => $data->mutasi->id]) }}" id="mutasi-form">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-sm-8 col-lg-6">
                                    <div class="form-group required">
                                        <label class="title">Asal Tugas</label>
                                        <input type="text" placeholder="Surabaya - Lumajang" class="form-control "
                                            name="asal_tugas" id="asal_tugas" value="">
                                    </div>

                                    <div class="form-group required">
                                        <label class="title">Tahun Pindah</label>
                                        <select class="form-control" id="thn_pindah" name="thn_pindah">
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

                                        <img id="img-mutasi_blob" src="{{ asset('storage/' . $data->mutasi->image) }}"
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
                                        <span id="loadingBtn" class="spinner-border spinner-border-sm d-none" role="status"
                                            aria-hidden="true"></span>
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
            $("#asal_tugas").on("input", function() {
                if ($(this).val().trim() === "") {
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid').addClass('is-valid')
                }
            })

            $("#mutasi_blob").on("change", function() {
                const input = this;
                const imgPreview = $("#img-mutasi_blob");
                const infoBox = $("#info-mutasi_blob");

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
                            "{{ asset('storage/' . $data->mutasi->image) }}"
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

            $("#thn_pindah").on("change", function() {
                if ($(this).val() !== "" || $(this.val() !== "")) {
                    $(this).addClass("is-valid").removeClass("is-invalid");
                }
            })

            $("#mutasi-form").on("submit", function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                formData.append("_method", "PUT");

                if ($("#asal_tugas").val() === "") {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Asal tugas harus diisi!"
                    })
                    $("#asal_tugas").addClass("is-invalid");
                } else if ($("#thn_pindah").val() == null) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Pindah tugas harus diisi!"
                    })
                    $("#thn_pindah").addClass("is-invalid");
                } else {
                    $("#btnMutasi").attr("disabled", true);
                    $("#textMutasi").addClass("d-none");
                    $("#icon_mutasi").addClass("d-none");
                    $("#loadingMutasi").removeClass("d-none");
                    $.ajax({
                        type: "POST",
                        url: $(this).attr("action"),
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            $("#btnMutasi").attr("disabled", false);
                            $("#textMutasi").removeClass("d-none");
                            $("#icon_mutasi").removeClass("d-none");
                            $("#loadingMutasi").addClass("d-none");
                            Swal.fire({
                                title: "Berhasil",
                                icon: "success",
                                text: "diperbarui!",
                                confirmButtonText: "OK",
                                confirmButtonColor: "#18a342",
                            }).then(() => {
                                window.location.href = response.redirect;
                            })
                        },
                        error: function(xhr) {
                            $("#btnMutasi").attr("disabled", false);
                            $("#textMutasi").removeClass("d-none");
                            $("#icon_mutasi").removeClass("d-none");
                            $("#loadingMutasi").addClass("d-none");
                            var errorString = "";
                            if (xhr.responseJSON && xhr.responseJSON.errors) {
                                $.each(xhr.responseJSON.errors, function(key, messages) {
                                    errorString += messages[0] + "\n";
                                });
                            } else if (xhr.responseJSON && xhr.responseJSON.error) {
                                errorString += xhr.responseJSON.error;
                            } else {
                                errorString += "Terjadi kesalahan. silahkan coba lagi!";
                            }
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: errorString
                            })
                        }
                    });
                }
            })
        })
    </script>
@endsection
