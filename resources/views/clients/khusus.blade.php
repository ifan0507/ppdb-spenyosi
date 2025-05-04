@extends('layouts.portal.template')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="fw-bold">Registrasi Jalur Khusus</h2>
                <p>Untuk mendapatkan akun Jalur Khusus, masukkan kombinasi <strong>Nama Lengkap</strong>,
                    <strong>NISN</strong>, <strong>Email</strong>, <strong>Password</strong>, dan pilih salah satu kategori
                    jalur khusus.
                </p>
                <div id="errorAlert" class="alert alert-danger d-none" role="alert"></div>
                <form id="formPendaftaran" action="{{ route('registerKhusus') }}" method="POST">
                    @csrf

                    <!-- Nama Lengkap -->
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama_lengkap" class="form-control" id="nama"
                            placeholder="Nama Lengkap" value="{{ old('nama_lengkap') }}">
                        <div id="validasiNama" class="invalid-feedback">Nama tidak boleh kosong!</div>
                    </div>

                    <!-- NISN -->
                    <div class="mb-3">
                        <label for="nisn" class="form-label">NISN <span class="text-danger">*</span></label>
                        <input type="text" name="nisn" class="form-control" id="nisn" placeholder="1234567898"
                            value="{{ old('nisn') }}">
                        <div id="validasiNisn" class="invalid-feedback">NISN harus terdiri dari 10 digit angka!</div>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" id="email"
                            placeholder="example@gmail.com" value="{{ old('email') }}">
                        <div id="validasiEmail" class="invalid-feedback">Email tidak boleh kosong!</div>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="new-password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" name="new-password" class="form-control" id="new-password"
                            placeholder="Password" value="{{ old('new-password') }}">
                        <div id="validasiNewPassword" class="invalid-feedback">Password tidak boleh kosong!</div>
                    </div>
                    {{-- Confirmasi password --}}
                    <div class="mb-3">
                        <label for="password" class="form-label">Confirmasi Password <span
                                class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password"
                            value="{{ old('password') }}">
                        <div id="validasiPassword" class="invalid-feedback">Confirmasi Password tidak boleh kosong!</div>
                    </div>

                    <!-- Jalur Khusus -->
                    <div class="mb-3">
                        <label for="jalur_ppdb" class="form-label">Pilih Jalur Khusus <span
                                class="text-danger">*</span></label>
                        <select name="jalur_ppdb" id="jalur_ppdb" class="form-control">
                            <option value="" selected disabled>-- Pilih Jalur --</option>
                            @foreach ($jalurs as $jalur)
                                @if ($jalur->nama_jalur !== 'Umum')
                                    <option value="{{ $jalur->id }}">{{ $jalur->nama_jalur }}</option>
                                @endif
                            @endforeach
                        </select>
                        <div id="validasiJalur" class="invalid-feedback">Silakan pilih jalur khusus!</div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label mb-3" for="flexCheckDefault" style="color: red">
                            Saya telah memverifikasi data dan jalur yang saya pilih. Saya menyetujui bahwa data tidak dapat
                            diubah setelah ini.
                        </label>
                    </div>
                    <!-- Tombol Submit -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('regist') }}">
                            <button type="button" class="btn btn-light">Kembali</button>
                        </a>
                        <button type="submit" id="btnSubmit" class="btn btn-primary">
                            <span id="btnText">Selanjutnya →</span>
                            <span id="btnLoading" class="spinner-border spinner-border-sm d-none" role="status"
                                aria-hidden="true"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#nisn").on("input", function() {
                var nisn = $(this).val();
                var nisnRegex = /^[0-9]{10}$/;

                if (!nisnRegex.test(nisn)) {
                    $("#validasiNisn").text("NISN harus terdiri dari 10 digit angka!").show();
                    $(this).addClass("is-invalid");
                } else {
                    $("#validasiNisn").hide();
                    $(this).removeClass("is-invalid").addClass("is-valid");
                }
            });

            $("#email").on("input", function() {
                var email = $(this).val();
                var emailRegex = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;

                if (email.trim() === "") {
                    $("#email").addClass("is-invalid");
                    $("#validasiEmail").text("Email tidak boleh kosong!").show();
                } else if (!emailRegex.test(email)) {
                    $("#email").addClass("is-invalid");
                    $("#validasiEmail").text("Email harus menggunakan @gmail.com!").show();
                } else {
                    $("#email").removeClass("is-invalid").addClass("is-valid");
                    $("#validasiEmail").hide();
                }
            });

            $("#password").on("input", function() {
                var confirmPassword = $(this).val();
                var newPassword = $("#new-password").val();

                if (confirmPassword.trim() === "") {
                    $("#password").addClass("is-invalid").removeClass("is-valid");
                    $("#validasiPassword").text("Konfirmasi Password tidak boleh kosong!").show();
                } else if (confirmPassword !== newPassword) {
                    $("#password").addClass("is-invalid").removeClass("is-valid");
                    $("#validasiPassword").text("Konfirmasi Password tidak cocok!").show();
                } else {
                    $("#password").removeClass("is-invalid").addClass("is-valid");
                    $("#validasiPassword").hide();
                }
            });
            $("#new-password").on("input", function() {
                $("#password").trigger("input");
            });

            $("#nama, #new-password").on("input", function() {
                if ($(this).val().trim() === "") {
                    $(this).addClass("is-invalid");
                } else {
                    $(this).removeClass("is-invalid").addClass("is-valid");
                }
            });

            $("#jalur_ppdb").on("change", function() {
                if ($(this).val()) {
                    $(this).removeClass("is-invalid").addClass("is-valid");
                    $("#validasiJalur").hide();
                }
            });

            $("#btnSubmit").prop("disabled", true);

            $("#flexCheckDefault").on("change", function() {
                if ($(this).is(":checked")) {
                    $("#btnSubmit").prop("disabled", false);
                } else {
                    $("#btnSubmit").prop("disabled", true);
                }
            });

            $("#formPendaftaran").submit(function(e) {
                e.preventDefault();
                var isValid = true;

                if ($("#nama").val().trim() === "") {
                    $("#nama").addClass("is-invalid");
                    $("#validasiNama").text("Nama tidak boleh kosong!").show();
                    isValid = false;
                } else {
                    $("#nama").removeClass("is-invalid").addClass("is-valid");
                }

                var nisn = $("#nisn").val();
                if (nisn === "") {
                    $("#validasiNisn").text("NISN tidak boleh kosong!").show();
                    $("#nisn").addClass("is-invalid").removeClass("is-valid");
                    isValid = false;
                } else if (!/^[0-9]{10}$/.test(nisn)) {
                    $("#nisn").addClass("is-invalid");
                    $("#validasiNisn").text("NISN harus terdiri dari 10 digit angka!").show();
                    isValid = false;
                } else {
                    $("#validasiNisn").hide();
                    $(this).removeClass("is-invalid").addClass("is-valid");
                }

                var email = $("#email").val();
                var emailRegex = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;

                if (email.trim() === "") {
                    $("#email").addClass("is-invalid");
                    $("#validasiEmail").text("Email tidak boleh kosong!").show();
                    isValid = false;
                } else if (!emailRegex.test(email)) {
                    $("#email").addClass("is-invalid");
                    $("#validasiEmail").text("Email harus menggunakan @gmail.com!").show();
                    isValid = false;
                } else {
                    $("#email").removeClass("is-invalid").addClass("is-valid");
                    $("#validasiEmail").hide();
                }

                if ($("#new-password").val().trim() === "") {
                    $("#new-password").addClass("is-invalid");
                    $("#validasiNewPassword").text("Password tidak boleh kosong!").show();
                    isValid = false;
                } else {
                    $("#new-password").removeClass("is-invalid").addClass("is-valid");
                }

                if ($("#password").val().trim() === "") {
                    $("#password").addClass("is-invalid");
                    $("#validasiPassword").text("Confirmasi Password tidak boleh kosong!").show();
                    isValid = false;
                } else {
                    $("#password").removeClass("is-invalid").addClass("is-valid");
                }

                if ($("#jalur_ppdb").val() === null || $("#jalur_ppdb").val() === "") {
                    $("#jalur_ppdb").addClass("is-invalid").removeClass("is-valid");
                    $("#validasiJalur").text("Pilih jalur PPDB!").show();
                    isValid = false;
                } else {
                    $("#jalur_ppdb").removeClass("is-invalid").addClass("is-valid");
                    $("#validasiJalur").hide();
                }



                if (isValid) {
                    $("#btnSubmit").attr("disabled", true);
                    $("#btnLoading").removeClass("d-none");

                    $.ajax({
                        url: $("#formPendaftaran").attr(
                            "action"),
                        type: "POST",
                        data: $("#formPendaftaran").serialize(),
                        success: function(response) {
                            $("#btnSubmit").attr("disabled", false);
                            $("#btnLoading").addClass("d-none");

                            Swal.fire({
                                title: "Berhasil!",
                                text: "periksa kode otp diemail anda",
                                icon: "success",
                                confirmButtonText: "OK",
                                confirmButtonColor: "#18a342",
                            }).then(() => {
                                window.location.href = response
                                    .redirect;
                            });
                        },

                        error: function(xhr) {
                            $("#btnSubmit").attr("disabled", false);
                            $("#btnLoading").addClass("d-none");
                            $("#flexCheckDefault").prop("checked", false);
                            $("#btnSubmit").prop("disabled", true);

                            let errorMessages = "";
                            if (xhr.responseJSON && xhr.responseJSON.errors) {
                                $.each(xhr.responseJSON.errors, function(key, value) {
                                    errorMessages += value[0] + "\n";
                                    console.log(errorMessages);

                                });
                            } else {
                                errorMessages =
                                    "Terjadi kesalahan, silakan coba lagi.";
                            }
                            $("#errorAlert").html(errorMessages).removeClass("d-none");
                        }
                    });
                }
            });
        });
    </script>
@endsection
