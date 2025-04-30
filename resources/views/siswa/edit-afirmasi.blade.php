@extends('layouts.siswa.template')

@section('content')
    <div class="misc-content pt-4">
        @include('layouts.siswa.breadcrumb', [
            'breadcrumb' => [
                'Dokumen Afirmasi' => route('siswa.afirmasi'),
                'Perbarui Dokumen Afirmasi' => '',
            ],
        ])
        <div class="container">
            @include('layouts.siswa.header-update')
            <div class="row justify-content-center">
                <div class="card card-primary card-outline card-outline-tabs col-md-12">
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data"
                            action="{{ route('afirmasi.update', ['id' => $data->afirmasi->id]) }}" id="main-form">
                            @method('put')
                            @csrf
                            <div class="row">
                                <div class="col-sm-8 col-lg-6">
                                    <div class="form-group required">
                                        <label class="title">Jenis Afirmasi</label>
                                        <select class="form-control" id="jenis_afirmasi" name="jenis_afirmasi">
                                            <option value="" disabled selected>-- Pilih Jenis Afirmasi
                                                --</option>
                                            <option value="KIP"
                                                {{ $data->afirmasi->jenis_afirmasi == 'KIP' ? 'selected' : '' }}>KIP
                                            </option>
                                            <option value="KKS"
                                                {{ $data->afirmasi->jenis_afirmasi == 'KKS' ? 'selected' : '' }}>KKS
                                            </option>
                                            <option value="PKH"
                                                {{ $data->afirmasi->jenis_afirmasi == 'PKH' ? 'selected' : '' }}>PKH
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-8 col-lg-4">
                                    <div class="border m-3 py-1 px-2 text-center" id="photo-box">
                                        <label for="afirmasi_blob" class="form-label">
                                            Documen Pendukung <span style="color:#e3342f">*</span><br />
                                            <b>(format: JPG/JPEG maks. 1MB)</b>
                                        </label>

                                        <img id="img-afirmasi_blob" src="{{ asset('storage/' . $data->afirmasi->image) }}"
                                            class="img-fluid rounded border mb-2" style="max-width: 100%;">
                                        <label for="afirmasi_blob" class="btn btn-primary w-100">
                                            <i class="fas fa-folder-open"></i> Pilih Foto
                                        </label>
                                        <input type="file" id="afirmasi_blob" name="image" class="d-none"
                                            accept="image/jpeg">
                                        <div id="info-afirmasi_blob" class="text-muted mt-2" style="display:none;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-sm-8 col-lg-6">
                                    <button type="submit" class="btn btn-primary btn-block" id="btnKirim"><i
                                            class="fas fa-save" id="icon_kirim"></i>
                                        <span id="textBtn"> Perbarui Dokumen Afirmasi</span>
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
            $("#afirmasi_blob").on("change", function() {
                const input = this;
                const imgPreview = $("#img-afirmasi_blob");
                const infoBox = $("#info-afirmasi_blob");

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
                            "{{ asset('storage/' . $data->afirmasi->image) }}"
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

            $("#jenis_afirmasi").on("change", function() {
                if ($(this).val() !== "") {
                    $(this).addClass("is-valid").removeClass("is-invalid");
                }
            })

            $("#main-form").on("submit", function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                formData.append("_method", "PUT");

                if ($("#jenis_afirmasi").val() == null) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Jenis Afirmasi Harus Dipilih!"
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
