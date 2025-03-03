@extends('layouts.portal.template')

@section('header')
    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">
            <a href="#" class="logo d-flex align-items-center me-auto">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <img src="{{ asset('assets/img/logo.png') }}" alt="logo">
                <h1 class="sitename fw-bold">SPENYOSI</h1>
            </a>
        </div>
    </header>
@endsection

@section('content')
    <div class="d-flex flex-column min-vh-100">
        <div class="container text-center mt-5 mb-5 flex-grow-1 d-flex flex-column justify-content-center">
            <h5>Masukkan Kode OTP Anda</h5>

            <form id="formVerifikasi">
                @csrf
                <div class="d-flex justify-content-center mt-3">
                    @for ($i = 1; $i <= 6; $i++)
                        <input type="text" class="otp-input" id="otp{{ $i }}" maxlength="1">
                    @endfor
                </div>
                <input type="hidden" name="otp" id="otp" required>
            </form>
        </div>
    </div>
@endsection

@section('footer')
    <footer class="footer mt-auto py-3 bg-light border-top">
        <div class="container text-center">
            <p class="m-0 text-muted">
                &copy; 2025 SPENYOSI <em>v1.0</em>.
            </p>
        </div>
    </footer>

    <style>
        /* Agar footer selalu di bawah */
        html,
        body {
            height: 100%;
        }

        /* Input OTP */
        .otp-input {
            width: 45px;
            height: 50px;
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            margin: 0 7px;
            border: 2px solid #ccc;
            border-radius: 8px;
            transition: 0.3s;
        }

        .otp-input:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0px 0px 5px rgba(0, 123, 255, 0.5);
        }
    </style>

    <script>
        $(document).ready(function() {
            const inputs = $(".otp-input");
            const hiddenInput = $("#otp");

            inputs.each(function(index) {
                $(this).on("input", function() {
                    if (this.value.length === 1 && index < inputs.length - 1) {
                        inputs.eq(index + 1).focus();
                    }
                    updateOtpValue();
                });

                $(this).on("keydown", function(e) {
                    if (e.key === "Backspace" && this.value === "" && index > 0) {
                        inputs.eq(index - 1).focus();
                    }
                });
            });

            function updateOtpValue() {
                let otpValue = "";
                inputs.each(function() {
                    otpValue += $(this).val();
                });

                hiddenInput.val(otpValue);

                if (otpValue.length === 6) {
                    submitOtp(otpValue);
                }
            }

            function submitOtp(otp) {
                $.ajax({
                    url: "/verify",
                    type: "POST",
                    data: $("#formVerifikasi").serialize(),
                    beforeSend: function() {
                        inputs.prop("disabled", true);
                    },
                    success: function(response) {
                        Swal.fire({
                            title: "Berhasil!",
                            text: "Verifikasi berhasil",
                            icon: "success",
                            confirmButtonColor: "#18a342",
                            confirmButtonText: "OK",
                        }).then(() => {
                            window.location.href = response.redirect;
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: "Gagal!",
                            text: xhr.responseJSON.message || "Terjadi kesalahan, coba lagi.",
                            icon: "error",
                        });

                        inputs.prop("disabled", false);
                        inputs.val("");
                        inputs.first().focus();
                    }
                });
            }
        });
    </script>
@endsection
