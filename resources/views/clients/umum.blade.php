@extends('layouts.portal.template')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="fw-bold">Registrasi Jalur Umum</h2>
                <p>Untuk mendapatkan akun Jalur Umum, masukkan kombinasi <strong>Nama Lengkap</strong>,
                    <strong>NISN</strong>, <strong>Email</strong>
                    dan <strong>Password</strong>.
                </p>
                <form action="{{ route('registerUmum') }}" method="POST" id="formPendaftaran">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama_lengkap" class="form-control" id="nama"
                            placeholder="Nama Lengkap">
                        <div id="validasiNama" class="invalid-feedback">
                            Nama Tidak Boleh Koseng!.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="nisn" class="form-label">NISN <span class="text-danger">*</span></label>
                        <input type="text" name="nisn" class="form-control" id="nisn" placeholder="12345678">
                        <div id="validasiNisn" class="invalid-feedback">

                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" id="email">
                        <div id="validasiEmail" class="invalid-feedback">
                            Nama Tidak Boleh Koseng!.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control" id="password">
                        <div id="validasiPassword" class="invalid-feedback">
                            Nama Tidak Boleh Koseng!.
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('regist') }}">
                            <button type="button" class="btn btn-light">Kembali</button>
                        </a>
                        <button type="submit" class="btn btn-primary" id="btnSubmit">
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
                var nisnRegex = /^[0-9]{10}$/; // Hanya angka, tepat 10 digit

                if (nisn === "") {
                    $("#validasiNisn").text("NISN tidak boleh kosong!").show();
                    $(this).addClass("is-invalid").removeClass("is-valid");
                } else if (!nisnRegex.test(nisn)) {
                    $("#validasiNisn").text("NISN harus terdiri dari 10 digit angka!").show();
                    $(this).addClass("is-invalid");
                } else {
                    $("#validasiNisn").hide();
                    $(this).removeClass("is-invalid").addClass("is-valid");
                }
            });

            $("#nama, #email, #password").on("input", function() {
                if ($(this).val().trim() === "") {
                    $(this).addClass("is-invalid");
                } else {
                    $(this).removeClass("is-invalid").addClass("is-valid");
                }
            });

            $("#formPendaftaran").submit(function(e) {
                e.preventDefault(); // Mencegah submit jika tidak valid
                var isValid = true;

                if ($("#nama").val().trim() === "") {
                    $("#nama").addClass("is-invalid");
                    $("#validasiNama").text("Nama tidak boleh kosong!").show();
                    isValid = false;
                } else {
                    $("#nama").removeClass("is-invalid").addClass("is-valid");
                }

                var nisn = $("#nisn").val();
                if (!/^[0-9]{10}$/.test(nisn)) {
                    $("#nisn").addClass("is-invalid");
                    $("#validasiNisn").text("NISN harus terdiri dari 10 digit angka!").show();
                    isValid = false;
                } else {
                    $("#nisn").removeClass("is-invalid").addClass("is-valid");
                }

                if ($("#email").val().trim() === "") {
                    $("#email").addClass("is-invalid");
                    $("#validasiEmail").text("Email tidak boleh kosong!").show();
                    isValid = false;
                } else {
                    $("#email").removeClass("is-invalid").addClass("is-valid");
                }

                if ($("#password").val().trim() === "") {
                    $("#password").addClass("is-invalid");
                    $("#validasiPassword").text("Password tidak boleh kosong!").show();
                    isValid = false;
                } else {
                    $("#password").removeClass("is-invalid").addClass("is-valid");
                }

                if (isValid) {
                    // Tampilkan animasi loading di tombol
                    $("#btnSubmit").attr("disabled", true); // Nonaktifkan tombol

                    $("#btnLoading").removeClass("d-none"); // Tampilkan spinner

                    // Simulasi proses verifikasi email (bisa diganti dengan AJAX request)
                    setTimeout(function() {
                        alert("Verifikasi email berhasil dikirim!");
                        $("#btnSubmit").attr("disabled", false); // Aktifkan kembali tombol
                        $("#btnText").text("Selanjutnya →");
                        $("#btnLoading").addClass("d-none"); // Sembunyikan spinner
                        $("#formPendaftaran")[0].submit(); // Submit form setelah loading selesai
                    }, 3000); // Simulasi delay 3 detik
                }
            });
        });
    </script>
@endsection
