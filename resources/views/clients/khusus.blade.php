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
                <form id="formPendaftaran" action="{{ route('registerKhusus') }}" method="POST">
                    @csrf

                    <!-- Nama Lengkap -->
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama_lengkap" class="form-control" id="nama"
                            placeholder="Nama Lengkap">
                        <div id="validasiNama" class="invalid-feedback">Nama tidak boleh kosong!</div>
                    </div>

                    <!-- NISN -->
                    <div class="mb-3">
                        <label for="nisn" class="form-label">NISN <span class="text-danger">*</span></label>
                        <input type="text" name="nisn" class="form-control" id="nisn" placeholder="1234567898">
                        <div id="validasiNisn" class="invalid-feedback">NISN harus terdiri dari 10 digit angka!</div>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" id="email"
                            placeholder="example@gmail.com">
                        <div id="validasiEmail" class="invalid-feedback">Email tidak boleh kosong!</div>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="password">
                        <div id="validasiPassword" class="invalid-feedback">Password tidak boleh kosong!</div>
                    </div>

                    <!-- Jalur Khusus -->
                    <div class="mb-3">
                        <label for="jalur_ppdb" class="form-label">Pilih Jalur Khusus <span
                                class="text-danger">*</span></label>
                        <select name="jalur_ppdb" id="jalur_ppdb" class="form-control">
                            <option value="" selected disabled>-- Pilih Jalur --</option>
                            <option value="afirmasi">Afirmasi (Siswa dari keluarga kurang mampu)</option>
                            <option value="pindah_tugas">Pindah Tugas (Orang tua/wali pindah kerja)</option>
                            <option value="tahfidz">Tahfidz (Memiliki hafalan Al-Qur'an)</option>
                            <option value="prestasi">Prestasi (Akademik atau non-akademik)</option>
                        </select>
                        <div id="validasiJalur" class="invalid-feedback">Silakan pilih jalur khusus!</div>
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
                var nisn = $(this).val().trim();
                var nisnRegex = /^[0-9]{10}$/; // Hanya angka, tepat 10 digit

                if (nisn === "") {
                    $("#validasiNisn").text("NISN tidak boleh kosong!").show();
                    $(this).addClass("is-invalid").removeClass("is-valid");
                } else if (!nisnRegex.test(nisn)) {
                    $("#validasiNisn").text("NISN harus terdiri dari 10 digit angka!").show();
                    $(this).addClass("is-invalid").removeClass("is-valid");
                } else {
                    $("#validasiNisn").hide();
                    $(this).removeClass("is-invalid").addClass("is-valid");
                }
            });

            $("#formPendaftaran").submit(function(e) {
                e.preventDefault();
                var isValid = true;

                // Validasi Nama
                if ($("#nama").val().trim() === "") {
                    $("#nama").addClass("is-invalid").removeClass("is-valid");
                    $("#validasiNama").text("Nama tidak boleh kosong!").show();
                    isValid = false;
                } else {
                    $("#nama").removeClass("is-invalid").addClass("is-valid");
                    $("#validasiNama").hide();
                }

                // Validasi NISN
                var nisn = $("#nisn").val().trim();
                if (nisn === "") {
                    $("#validasiNisn").text("NISN tidak boleh kosong!").show();
                    $("#nisn").addClass("is-invalid").removeClass("is-valid");
                    isValid = false;
                } else if (!/^[0-9]{10}$/.test(nisn)) {
                    $("#nisn").addClass("is-invalid").removeClass("is-valid");
                    $("#validasiNisn").text("NISN harus terdiri dari 10 digit angka!").show();
                    isValid = false;
                } else {
                    $("#validasiNisn").hide();
                    $("#nisn").removeClass("is-invalid").addClass("is-valid");
                }

                // Validasi Email
                if ($("#email").val().trim() === "") {
                    $("#email").addClass("is-invalid").removeClass("is-valid");
                    $("#validasiEmail").text("Email tidak boleh kosong!").show();
                    isValid = false;
                } else {
                    $("#email").removeClass("is-invalid").addClass("is-valid");
                    $("#validasiEmail").hide();
                }

                // Validasi Password
                if ($("#password").val().trim() === "") {
                    $("#password").addClass("is-invalid").removeClass("is-valid");
                    $("#validasiPassword").text("Password tidak boleh kosong!").show();
                    isValid = false;
                } else {
                    $("#password").removeClass("is-invalid").addClass("is-valid");
                    $("#validasiPassword").hide();
                }

                // Validasi Jalur Khusus
                if ($("#jalur_ppdb").val() === null) {
                    $("#jalur_ppdb").addClass("is-invalid").removeClass("is-valid");
                    $("#validasiJalur").text("Silakan pilih jalur khusus!").show();
                    isValid = false;
                } else {
                    $("#jalur_ppdb").removeClass("is-invalid").addClass("is-valid");
                    $("#validasiJalur").hide();
                }

                // Jika Semua Valid, Kirim Form
                if (isValid) {
                    $("#btnSubmit").attr("disabled", true);
                    $("#btnText").addClass("d-none");
                    $("#btnLoading").removeClass("d-none");

                    $.ajax({
                        url: $("#formPendaftaran").attr("action"),
                        type: "POST",
                        data: $("#formPendaftaran").serialize(),
                        success: function(response) {
                            Swal.fire({
                                title: "Berhasil!",
                                text: "Kami telah mengirimkan kode OTP ke email " + $(
                                    "#email").val() + ".",
                                icon: "success",
                                confirmButtonText: "OK",
                                confirmButtonColor: "#18a342",
                            }).then(() => {
                                window.location.href = response.redirect;
                            });
                        },
                        error: function(xhr) {
                            $("#btnSubmit").attr("disabled", false);
                            $("#btnText").removeClass("d-none");
                            $("#btnLoading").addClass("d-none");
                            Swal.fire({
                                title: "Gagal!",
                                text: "Gagal mengirim email verifikasi, silakan coba lagi!.",
                                icon: "error",
                                confirmButtonText: "OK",
                                confirmButtonColor: "#d33",
                            });
                        },
                    });
                }
            });
        });
    </script>
@endsection
