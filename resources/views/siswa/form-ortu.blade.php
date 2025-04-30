@extends('layouts.siswa.template')
@section('content')
    <div class="misc-content pt-4">
        @include('layouts.siswa.breadcrumb', [
            'breadcrumb' => [
                'Data orang tua' => route('ortu'),
                'Perbarui data orang tua' => '',
            ],
        ])
        <div class="container-fluid">
            @include('layouts.siswa.header-update')
            <div class="row justify-content-center">
                <div class="card card-primary card-outline card-outline-tabs col-md-12">
                    <div class="card-body">
                        <form action="{{ route('ortu.update', ['id' => $data->id]) }}" method="POST" id="form-ortu">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-sm-12 col-lg-6">
                                    <div class="card card-default card-outline">
                                        <div class="card-header">
                                            <div class="d-flex">
                                                <h5 class="m-0">Informasi Ayah</h5>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group required">
                                                <label class="form-label">Nama Ayah</label>
                                                <input type="text" class="form-control " name="ayah" id="nama_ayah"
                                                    value="{{ old('ayah', $data->ayah) }}" placeholder="Nama lengkap ayah">
                                            </div>
                                            <div class="form-group required">
                                                <label class="form-label">Status Ayah</label><br>
                                                <div class="d-block">
                                                    <div class="form-check mr-2">
                                                        <input class="form-check-input status_ayah" type="radio"
                                                            name="status_ayah" id="status_ayah_1" value="Hidup"
                                                            {{ $data->status_ayah == 'Hidup' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="status_ayah_1">Hidup</label>
                                                    </div>
                                                    <div class="form-check mr-2">
                                                        <input class="form-check-input status_ayah" type="radio"
                                                            name="status_ayah" id="status_ayah_2" value="Wafat"
                                                            {{ $data->status_ayah == 'Wafat' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="status_ayah_2">Wafat</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group required">
                                                <label class="form-label">Pendidikan Ayah</label>
                                                <select class="form-control" name="pendidikan_ayah" id="pendidikanAyah">
                                                    <option value="" disabled selected>-- Pilih Pendidikan --</option>
                                                    <option value="Tidak Sekolah"
                                                        {{ old('pendidikan_ayah', $data->pendidikan_ayah) == 'Tidak Sekolah' ? 'selected' : '' }}>
                                                        Tidak Sekolah</option>
                                                    <option value="SD/MI / Sederajat"
                                                        {{ old('pendidikan_ayah', $data->pendidikan_ayah) == 'SD/MI / Sederajat' ? 'selected' : '' }}>
                                                        SD/MI / Sederajat</option>
                                                    <option value="SMP/MTs / Sederajat"
                                                        {{ old('pendidikan_ayah', $data->pendidikan_ayah) == 'SMP/MTs / Sederajat' ? 'selected' : '' }}>
                                                        SMP/MTs / Sederajat</option>
                                                    <option value="SMA/MA / Sederajat"
                                                        {{ old('pendidikan_ayah', $data->pendidikan_ayah) == 'SMA/MA / Sederajat' ? 'selected' : '' }}>
                                                        SMA/MA / Sederajat</option>
                                                    <option value="D1 / Sederajat"
                                                        {{ old('pendidikan_ayah', $data->pendidikan_ayah) == 'D1 / Sederajat' ? 'selected' : '' }}>
                                                        D1 / Sederajat</option>
                                                    <option value="D2 / Sederajat"
                                                        {{ old('pendidikan_ayah', $data->pendidikan_ayah) == 'D2 / Sederajat' ? 'selected' : '' }}>
                                                        D2 / Sederajat</option>
                                                    <option value="D3 / Sederajat"
                                                        {{ old('pendidikan_ayah', $data->pendidikan_ayah) == 'D3 / Sederajat' ? 'selected' : '' }}>
                                                        D3 / Sederajat</option>
                                                    <option value="D4/S1 / Sederajat"
                                                        {{ old('pendidikan_ayah', $data->pendidikan_ayah) == 'D4/S1 / Sederajat' ? 'selected' : '' }}>
                                                        D4/S1 / Sederajat</option>
                                                    <option value="S2/Sp1 / Sederajat"
                                                        {{ old('pendidikan_ayah', $data->pendidikan_ayah) == 'S2/Sp1 / Sederajat' ? 'selected' : '' }}>
                                                        S2/Sp1 / Sederajat</option>
                                                    <option value="S3/Sp1 / Sederajat"
                                                        {{ old('pendidikan_ayah', $data->pendidikan_ayah) == 'S3/Sp1 / Sederajat' ? 'selected' : '' }}>
                                                        S3/Sp2 / Sederajat</option>
                                                </select>
                                                <div class="invalid-feedback" id="validasiPendidikanAyah">
                                                    Harap pilih pendidikan ayah!
                                                </div>
                                            </div>
                                            <div class="form-group required">
                                                <label class="form-label">Pekerjaan Ayah</label>
                                                <select class="form-control" name="pekerjaan_ayah" id="pekerjaanAyah">
                                                    <option value="" disabled selected>-- Pilih Pekerjaan --</option>
                                                    <option value="PNS"
                                                        {{ old('pekerjaan_ayah', $data->pekerjaan_ayah) == 'PNS' ? 'selected' : '' }}>
                                                        PNS</option>
                                                    <option value="Peg. Swasta"
                                                        {{ old('pekerjaan_ayah', $data->pekerjaan_ayah) == 'Peg. Swasta' ? 'selected' : '' }}>
                                                        Peg. Swasta</option>
                                                    <option value="Wirausaha"
                                                        {{ old('pekerjaan_ayah', $data->pekerjaan_ayah) == 'Wirausaha' ? 'selected' : '' }}>
                                                        Wirausaha</option>
                                                    <option value="TNI / POLRI"
                                                        {{ old('pekerjaan_ayah', $data->pekerjaan_ayah) == 'TNI / POLRI' ? 'selected' : '' }}>
                                                        TNI / POLRI</option>
                                                    <option value="Petani"
                                                        {{ old('pekerjaan_ayah', $data->pekerjaan_ayah) == 'Petani' ? 'selected' : '' }}>
                                                        Petani</option>
                                                    <option value="Nelayan"
                                                        {{ old('pekerjaan_ayah', $data->pekerjaan_ayah) == 'Nelayan' ? 'selected' : '' }}>
                                                        Nelayan</option>
                                                    <option value="Lainnya"
                                                        {{ old('pekerjaan_ayah', $data->pekerjaan_ayah) == 'Lainnya' ? 'selected' : '' }}>
                                                        Lainnya</option>
                                                    <option value="Tidak Bekerja"
                                                        {{ old('pekerjaan_ayah', $data->pekerjaan_ayah) == 'Tidak Bekerja' ? 'selected' : '' }}>
                                                        TIDAK BEKERJA</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Harap pilih pekerjaan ayah!
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-6">
                                    <div class="card card-default card-outline">
                                        <div class="card-header">
                                            <div class="d-flex">
                                                <h5 class="m-0">Informasi Ibu</h5>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group required">
                                                <label class="form-label">Nama Ibu</label>
                                                <input type="text" class="form-control " name="ibu" id="nama_ibu"
                                                    value="{{ old('ibu', $data->ibu) }}" placeholder="Nama lengkap ibu">
                                            </div>
                                            <div class="form-group required">
                                                <label class="form-label">Status Ibu</label><br>
                                                <div class="d-block">
                                                    <div class="form-check mr-2">
                                                        <input class="form-check-input status_ibu" type="radio"
                                                            name="status_ibu" id="status_ibu_1" value="Hidup"
                                                            {{ $data->status_ibu == 'Hidup' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="status_ibu_1">Hidup</label>
                                                    </div>
                                                    <div class="form-check mr-2">
                                                        <input class="form-check-input status_ibu" type="radio"
                                                            name="status_ibu" id="status_ibu_2" value="Wafat"
                                                            {{ $data->status_ibu == 'Wafat' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="status_ibu_2">Wafat</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group required">
                                                <label class="title">Pendidikan Ibu</label>
                                                <select class="form-control" name="pendidikan_ibu" id="pendidikanIbu">
                                                    <option value="" disabled selected>-- Pilih Pendidikan --
                                                    </option>
                                                    <option value="Tidak Sekolah"
                                                        {{ old('pendidikan_ibu', $data->pendidikan_ibu) == 'Tidak Sekolah' ? 'selected' : '' }}>
                                                        Tidak Sekolah</option>
                                                    <option value="SD/MI / Sederajat"
                                                        {{ old('pendidikan_ibu', $data->pendidikan_ibu) == 'SD/MI / Sederajat' ? 'selected' : '' }}>
                                                        SD/MI / Sederajat</option>
                                                    <option value="SMP/MTs / Sederajat"
                                                        {{ old('pendidikan_ibu', $data->pendidikan_ibu) == 'SMP/MTs / Sederajat' ? 'selected' : '' }}>
                                                        SMP/MTs / Sederajat</option>
                                                    <option value="SMA/MA / Sederajat"
                                                        {{ old('pendidikan_ibu', $data->pendidikan_ibu) == 'SMA/MA / Sederajat' ? 'selected' : '' }}>
                                                        SMA/MA / Sederajat</option>
                                                    <option value="D1 / Sederajat"
                                                        {{ old('pendidikan_ibu', $data->pendidikan_ibu) == 'D1 / Sederajat' ? 'selected' : '' }}>
                                                        D1 / Sederajat</option>
                                                    <option value="D2 / Sederajat"
                                                        {{ old('pendidikan_ibu', $data->pendidikan_ibu) == 'D2 / Sederajat' ? 'selected' : '' }}>
                                                        D2 / Sederajat</option>
                                                    <option value="D3 / Sederajat"
                                                        {{ old('pendidikan_ibu', $data->pendidikan_ibu) == 'D3 / Sederajat' ? 'selected' : '' }}>
                                                        D3 / Sederajat</option>
                                                    <option value="D4/S1 / Sederajat"
                                                        {{ old('pendidikan_ibu', $data->pendidikan_ibu) == 'D4/S1 / Sederajat' ? 'selected' : '' }}>
                                                        D4/S1 / Sederajat</option>
                                                    <option value="S2/Sp1 / Sederajat"
                                                        {{ old('pendidikan_ibu', $data->pendidikan_ibu) == 'S2/Sp1 / Sederajat' ? 'selected' : '' }}>
                                                        S2/Sp1 / Sederajat</option>
                                                    <option value="S3/Sp1 / Sederajat"
                                                        {{ old('pendidikan_ibu', $data->pendidikan_ibu) == 'S3/Sp1 / Sederajat' ? 'selected' : '' }}>
                                                        S3/Sp2 / Sederajat</option>
                                                </select>
                                                <div class="invalid-feedback" id="validasiPendidikanIbu">
                                                    Harap pilih pendidikan Ibu!
                                                </div>
                                            </div>
                                            <div class="form-group required">
                                                <label class="title">Pekerjaan Ibu</label>
                                                <select class="form-control" name="pekerjaan_ibu" id="pekerjaanIbu">
                                                    <option value="" disabled selected>-- Pilih Pekerjaan --</option>
                                                    <option value="PNS"
                                                        {{ old('pekerjaan_ibu', $data->pekerjaan_ibu) == 'PNS' ? 'selected' : '' }}>
                                                        PNS</option>
                                                    <option value="Peg. Swasta"
                                                        {{ old('pekerjaan_ibu', $data->pekerjaan_ibu) == 'Peg. Swasta' ? 'selected' : '' }}>
                                                        Peg. Swasta</option>
                                                    <option value="Wirausaha"
                                                        {{ old('pekerjaan_ibu', $data->pekerjaan_ibu) == 'Wirausaha' ? 'selected' : '' }}>
                                                        Wirausaha</option>
                                                    <option value="TNI / POLRI"
                                                        {{ old('pekerjaan_ibu', $data->pekerjaan_ibu) == 'TNI / POLRI' ? 'selected' : '' }}>
                                                        TNI / POLRI</option>
                                                    <option value="Petani"
                                                        {{ old('pekerjaan_ibu', $data->pekerjaan_ibu) == 'Petani' ? 'selected' : '' }}>
                                                        Petani</option>
                                                    <option value="Nelayan"
                                                        {{ old('pekerjaan_ibu', $data->pekerjaan_ibu) == 'Nelayan' ? 'selected' : '' }}>
                                                        Nelayan</option>
                                                    <option value="Lainnya"
                                                        {{ old('pekerjaan_ibu', $data->pekerjaan_ibu) == 'Lainnya' ? 'selected' : '' }}>
                                                        Lainnya</option>
                                                    <option value="Tidak Bekerja"
                                                        {{ old('pekerjaan_ibu', $data->pekerjaan_ibu) == 'Tidak Bekerja' ? 'selected' : '' }}>
                                                        TIDAK BEKERJA</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Harap pilih pekerjaan Ibu!
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-6">
                                    <div class="card card-default card-outline">
                                        <div class="card-header">
                                            <div class="d-flex">
                                                <h5 class="m-0">Informasi Tambahan</h5>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group required">
                                                <label class="form-label">No HP</label>
                                                <input type="text" class="form-control" name="no_hp" id="no_hp"
                                                    value="{{ old('no_hp', $data->no_hp) }}" placeholder="No yang aktif">
                                                <div id="validasiNoHp" class="invalid-feedback"></div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-sm-8 col-lg-6">
                                    <button type="submit" class="btn btn-primary btn-block" id="btnSave"><i
                                            class="fas fa-save" id="fa_save"></i> <span id="textBtn"> Perbarui
                                            Data</span>
                                        <span id="loadingBtn" class="spinner-border spinner-border-sm d-none"
                                            role="status" aria-hidden="true"></span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $("#nama_ayah, #nama_ibu").on("input", function() {
                let value = $(this).val().trim();

                if (value === "") {
                    $(this).addClass("is-invalid").removeClass("is-valid");
                } else {
                    $(this).addClass("is-valid").removeClass("is-invalid");
                }
            });

            $("[name='no_hp']").on("input", function() {
                let no = $(this).val();
                let noRegex = /^[0-9]{12}$/;

                if (!noRegex.test(no)) {
                    $("#validasiNoHp").text("Nomor HP harus terdiri dari 12 digit angka!").show();
                    $(this).addClass("is-invalid").removeClass("is-valid");
                } else {
                    $("#validasiNoHp").hide();
                    $(this).addClass("is-valid").removeClass("is-invalid");
                }
            });

            $("#pendidikanAyah, #pendidikanIbu, #pekerjaanAyah, #pekerjaanIbu").on("change", function() {
                if ($(this).val() !== "") {
                    $(this).addClass("is-valid").removeClass("is-invalid");
                    $(this).next(".invalid-feedback").hide();
                }
            });

            $("#form-ortu").on("submit", function(e) {
                e.preventDefault();
                let isValid = true;
                let noHp = $("[name='no_hp']").val();
                let checkedStatusAyah = $("input[name='status_ayah']:checked").length > 0;
                let checkedStatusIbu = $("input[name='status_ibu']:checked").length > 0;

                if ($("#nama_ayah").val() == "") {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Nama ayah harus diisi!"
                    })
                    $("#nama_ayah").addClass("is-invalid").removeClass("is-valid");
                    isValid = false;
                } else if ($("#nama_ibu").val() == "") {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Nama ibu harus diisi!"
                    })
                    $("#nama_ibu").addClass("is-invalid").removeClass("is-valid");
                    isValid = false;
                } else if ($("#pendidikanAyah").val() === "") {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Pendidikan ayah harus diisi!"
                    })
                    $("#pendidikanAyah").addClass("is-invalid").removeClass("is-valid");
                    $("#validasiPendidikanAyah").text("Pilih Pendidikan Ayah").show();
                    isValid = false;
                } else if ($("#pendidikanIbu").val() === "") {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Pendidikan ibu harus diisi!"
                    })
                    $("#pendidikanIbu").addClass("is-invalid").removeClass("is-valid");
                    $("#validasiPendidikanIbu").text("Pilih Pendidikan Ibu").show();
                    isValid = false;
                } else if ($("#pekerjaanAyah").val() === "") {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Pekerjaan ayah harus diisi!"
                    })
                    $("#pekerjaanAyah").addClass("is-invalid").removeClass("is-valid");
                    $("#validasiPekerjaanAyah").text("Pilih Pekerjaan Ayah").show();
                    isValid = false;
                } else if ($("#pekerjaanIbu").val() === "") {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Pekerjaan ibu harus diisi!"
                    })
                    $("#pekerjaanIbu").addClass("is-invalid").removeClass("is-valid");
                    $("#validasiPekerjaanIbu").text("Pilih Pekerjaan Ibu").show();
                    isValid = false;
                } else if (!checkedStatusAyah) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Jenis status ayah wajib dipilih!",
                    });
                    return false;
                } else if (!checkedStatusIbu) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Jenis status ibu wajib dipilih!",
                    });
                    return false;
                } else if (!/^[0-9]{12}$/.test(noHp) || noHp === "") {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "No hp harus diisi!"
                    })
                    $("[name='no_hp']").addClass("is-invalid").removeClass("is-valid");
                    isValid = false;
                }
                if (isValid) {
                    $("#btnSave").attr("disabled", true);
                    $("#fa_save").addClass("d-none");
                    $("#textBtn").addClass("d-none");
                    $("#loadingBtn").removeClass("d-none");
                    $.ajax({
                        url: $(this).attr("action"),
                        type: "POST",
                        data: $(this).serialize(),
                        success: function(response) {
                            $("#btnSave").attr("disabled", true);
                            $("#fa_save").removeClass("d-none");
                            $("#textBtn").removeClass("d-none");
                            $("#loadingBtn").addClass("d-none");
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
                            var errorString = "";
                            $("#btnSave").attr("disabled", true);
                            $("#fa_save").removeClass("d-none");
                            $("#textBtn").removeClass("d-none");
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
            });
        });
    </script>
@endsection
