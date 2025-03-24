@extends('layouts.siswa.template')
@section('content')
    <div class="misc-content pt-4">
        <div class="container">
            @include('layouts.siswa.header-update')
            <div class="row justify-content-center">
                <div class="card card-primary card-outline card-outline-tabs col-md-12">
                    <div class="card-body">
                        <form action="#" method="POST" id="form-ortu">
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
                                                    value="{{ old('ayah', $data->siswa->ortu) }}">
                                            </div>
                                            <div class="form-group required">
                                                <label class="form-label">Status Ayah</label><br>
                                                <div class="d-block">
                                                    <div class="form-check mr-2">
                                                        <input class="form-check-input status_ayah" type="radio"
                                                            name="status_ayah" id="status_ayah_1" value="Hidup"
                                                            {{ $data->siswa->ortu == 'Hidup' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="status_ayah_1">Hidup</label>
                                                    </div>
                                                    <div class="form-check mr-2">
                                                        <input class="form-check-input status_ayah" type="radio"
                                                            name="status_ayah" id="status_ayah_2" value="Wafat"
                                                            {{ $data->siswa->ortu == 'Wafat' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="status_ayah_2">Wafat</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group required">
                                                <label class="form-label">Pendidikan Ayah</label>
                                                <select class="form-control" name="pendidikan_ayah" id="pendidikanAyah">
                                                    <option value="">-- Pilih Pendidikan --</option>
                                                    <option value="Tidak Sekolah">Tidak Sekolah</option>
                                                    <option value="SD/MI / Sederajat">SD/MI / Sederajat</option>
                                                    <option value="SMP/MTs / Sederajat">SMP/MTs / Sederajat</option>
                                                    <option value="SMA/MA / Sederajat">SMA/MA / Sederajat</option>
                                                    <option value="D1 / Sederajat">D1 / Sederajat</option>
                                                    <option value="D2 / Sederajat">D2 / Sederajat</option>
                                                    <option value="D3 / Sederajat">D3 / Sederajat</option>
                                                    <option value="D4/S1 / Sederajat">D4/S1 / Sederajat</option>
                                                    <option value="S2/Sp1 / Sederajat">S2/Sp1 / Sederajat</option>
                                                    <option value="S3/Sp1 / Sederajat">S3/Sp2 / Sederajat</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Harap pilih pendidikan ayah!
                                                </div>
                                            </div>
                                            <div class="form-group required">
                                                <label class="form-label">Pekerjaan Ayah</label>
                                                <select class="form-control" name="pekerjaan_ayah" id="pekerjaanAyah">
                                                    <option value="">-- Pilih Pekerjaan --</option>
                                                    <option value="PNS">PNS</option>
                                                    <option value="Peg. Swasta">Peg. Swasta</option>
                                                    <option value="Wirausaha">Wirausaha</option>
                                                    <option value="TNI / POLRI">TNI / POLRI</option>
                                                    <option value="Petani">Petani</option>
                                                    <option value="Nelayan">Nelayan</option>
                                                    <option value="Lainnya">Lainnya</option>
                                                    <option value="Tidak Bekerja">TIDAK BEKERJA</option>
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
                                                    value="{{ old('ibu', $data->siswa->ortu) }}">
                                            </div>
                                            <div class="form-group required">
                                                <label class="form-label">Status Ibu</label><br>
                                                <div class="d-block">
                                                    <div class="form-check mr-2">
                                                        <input class="form-check-input status_ibu" type="radio"
                                                            name="status_ibu" id="status_ibu_1" value="Hidup"
                                                            {{ $data->siswa->ortu == 'Hidup' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="status_ibu_1">Hidup</label>
                                                    </div>
                                                    <div class="form-check mr-2">
                                                        <input class="form-check-input status_ibu" type="radio"
                                                            name="status_ibu" id="status_ibu_2" value="Wafat"
                                                            {{ $data->siswa->ortu == 'Wafat' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="status_ibu_2">Wafat</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group required">
                                                <label class="title">Pendidikan Ibu</label>
                                                <select class="form-control" name="pendidikan_ibu" id="pendidikanIbu">
                                                    <option value="">-- Pilih Pendidikan --</option>
                                                    <option value="Tidak Sekolah">Tidak Sekolah</option>
                                                    <option value="SD/MI / Sederajat">SD/MI / Sederajat</option>
                                                    <option value="SMP/MTs / Sederajat">SMP/MTs / Sederajat</option>
                                                    <option value="SMA/MA / Sederajat">SMA/MA / Sederajat</option>
                                                    <option value="D1 / Sederajat">D1 / Sederajat</option>
                                                    <option value="D2 / Sederajat">D2 / Sederajat</option>
                                                    <option value="D3 / Sederajat">D3 / Sederajat</option>
                                                    <option value="D4/S1 / Sederajat">D4/S1 / Sederajat</option>
                                                    <option value="S2/Sp1 / Sederajat">S2/Sp1 / Sederajat</option>
                                                    <option value="S3/Sp1 / Sederajat">S3/Sp2 / Sederajat</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Harap pilih pendidikan Ibu!
                                                </div>
                                            </div>
                                            <div class="form-group required">
                                                <label class="title">Pekerjaan Ibu</label>
                                                <select class="form-control" name="pekerjaan_ibu" id="pekerjaanIbu">
                                                    <option value="">-- Pilih Pekerjaan --</option>
                                                    <option value="PNS">PNS</option>
                                                    <option value="Peg. Swasta">Peg. Swasta</option>
                                                    <option value="Wirausaha">Wirausaha</option>
                                                    <option value="TNI / POLRI">TNI / POLRI</option>
                                                    <option value="Petani">Petani</option>
                                                    <option value="Nelayan">Nelayan</option>
                                                    <option value="Lainnya">Lainnya</option>
                                                    <option value="Tidak Bekerja">TIDAK BEKERJA</option>
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
                                                    value="{{ old('no_hp', $data->siswa->no_hp) }}">
                                                <div id="validasiNoHp" class="invalid-feedback"></div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan
                                    Data</button>
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
            $("[name='no_hp']").on("input", function() {
                var no = $(this).val();
                var noRegex = /^[0-9]{12}$/;

                if (!noRegex.test(no)) {
                    $("#validasiNoHp").text("Nomor HP harus terdiri dari 12 digit angka!").show();
                    $(this).addClass("is-invalid");
                } else {
                    $("#validasiNoHp").hide();
                    $(this).removeClass("is-invalid").addClass("is-valid");
                }
            });
            $("#form_ortu").on("submit", function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                formData.append("_method", "PUT");
                let isChecked = $("input[name='jenis_kelamin']:checked").length > 0;
                if ($("#nama_ayah").val() == "" || $("#nama_ayah").val() === "_") {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Nama ayah wajib di isi!",
                    })
                } else if (!isChecked) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Jenis kelamin wajib dipilih!",
                    })
                } else if ($("#tempat_lahir").val() == "" || $("#tempat_lahir").val() === "_") {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Tempat lahir wajib diisi!",
                    })
                } else if ($("#tanggal_lahir").val() == "" || $("#tanggal_lahir").val() === "_") {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Tanggal lahir wajib diisi!",
                    })
                } else if ($("#kab_name").val() == "") {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Kabupaten wajib dipilih!",
                    })
                } else if ($("#kec_name").val() == "") {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Kecamatan wajib dipilih!",
                    })
                } else if ($("#desa_name").val() == "") {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Desa wajib dipilih!",
                    })
                } else if ($("#alamat").val() == "" || $("#alamat").val() === "_") {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Alamat wajib diisi!",
                    })
                } else if ($("#no_hp").val() == "" || $("#no_hp").val() === "_") {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "No HP wajib diisi!",
                    })
                } else if ($("#coordinates").val() == "" || $("#coordinates").val() === "_") {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Koordinate rumah wajib diisi!",
                    })
                } else {
                    $("#btnSubmit").attr("disabled", true);
                    $("#btnText").addClass("d-none");
                    $("#icon_save").addClass("d-none");
                    $("#btnLoading").removeClass("d-none");
                    $.ajax({
                        url: $(this).attr("action"),
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(res) {
                            $("#btnSubmit").attr("disabled", false);
                            $("#btnLoading").addClass("d-none");
                            $("#btnText").removeClass("d-none");
                            $("#icon_save").removeClass("d-none");
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
                            $("#btnSubmit").attr("disabled", false);
                            $("#btnLoading").addClass("d-none");
                            $("#btnText").removeClass("d-none");
                            $("#icon_save").removeClass("d-none");
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
