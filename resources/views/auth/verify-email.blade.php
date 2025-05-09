<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>PPDB | SPENYOSI</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/logo.png') }}" rel="icon">
    <link href="{{ asset('OnePage/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('OnePage/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('OnePage/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('OnePage/assets/vendor/aos/aos.css') }}"rel="stylesheet">
    <link href="{{ asset('OnePage/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('OnePage/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('OnePage/assets/css/main.css') }}" rel="stylesheet">
    {{-- custom css file --}}
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/info.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/paginate.css') }}">
    {{-- custom js --}}
    <script src="{{ asset('assets/js/jquery-3.7.1.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/js/all.min.js') }}"></script>

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


        <style>

        /* Page layout */
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .page-container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .header {
            flex-shrink: 0;
        }

        .content-wrapper {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px 0;
        }

        .footer {
            flex-shrink: 0;
        }

        /* OTP Input Styling */
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

        .otp-container {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
        }

        .otp-title {
            margin-bottom: 20px;
            color: #333;
        }

        .otp-message {
            margin-top: 20px;
            font-size: 14px;
            max-width: 450px;
        }
    </style>
</head>

<body>
    <div class="page-container">
        <!-- Header -->
        <header id="header" class="header d-flex align-items-center">
            <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
                <a href="#" class="logo d-flex align-items-center">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="logo">
                    <h1 class="sitename fw-bold">SPENYOSI</h1>
                </a>
            </div>
        </header>

        <!-- Main Content -->
        <div class="content-wrapper">
            <div class="container text-center">
                <div class="otp-container">
                    <h5 class="otp-title">Masukkan Kode OTP Anda</h5>

                    <form id="formVerifikasi">
                        @csrf
                        <div class="d-flex justify-content-center mt-3">
                            @for ($i = 1; $i <= 6; $i++)
                                <input type="text" class="otp-input" id="otp{{ $i }}" maxlength="1">
                            @endfor
                        </div>
                        <input type="hidden" name="otp" id="otp" required>
                    </form>

                    <p class="text-muted otp-message">
                        Jika Anda tidak menerima kode yang dikirim melalui email, silakan periksa folder
                        <strong>Spam</strong>
                        di Gmail Anda. Jika tidak ditemukan, silakan lakukan pendaftaran ulang.
                    </p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer id="footer" class="footer light-background">
            <div class="container footer-top">
                <div class="row gy-4">
                    <div class="col-lg-5 col-md-12 footer-about">
                        <a href="index.html" class="logo d-flex align-items-center">
                            <span class="sitename">SMPN 1 Yosowilangun</span>
                        </a>
                        <p>Jl. Raya Gg. Masjid No. 4, Yosowilangun, Lumajang 67382</p>
                        <div class="social-links d-flex mt-4">
                            <a href="#"><i class="bi bi-twitter-x"></i></a>
                            <a href="#"><i class="bi bi-facebook"></i></a>
                            <a href="#"><i class="bi bi-instagram"></i></a>
                            <a href="#"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>


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
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div class="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('OnePage/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('OnePage/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('OnePage/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('OnePage/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('OnePage/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('OnePage/assets/vendor/swiper/swiper-bundle.min.css') }}"></script>
    <script src="{{ asset('OnePage/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('OnePage/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('OnePage/assets/js/main.js') }}"></script>

</body>

</html>
