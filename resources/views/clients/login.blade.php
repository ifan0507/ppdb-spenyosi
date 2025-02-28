<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title', 'Portal | SPENYOSI')</title>
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
    <link href="{{ asset('OnePage/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('OnePage/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('OnePage/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('OnePage/assets/css/main.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    {{-- custom js --}}
    <script src="{{ asset('assets/js/jquery-3.7.1.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/js/all.min.js') }}"></script>

    {{-- @yield('custom-css') <!-- Tambahkan jika ada CSS tambahan --> --}}
    <style>
        /* login */
        body {
            background-color: #f8f9fa;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-card {
            display: flex;
            width: 750px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .left-panel {
            width: 50%;
            padding: 40px;
            text-align: center;
        }

        .right-panel {
            width: 50%;
            background: linear-gradient(135deg, #5bb8ff, #3383ff);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            flex-direction: column;
            padding: 40px;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .social-icons a {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            border: 1px solid #ddd;
            color: #555;
            text-decoration: none;
        }

        .social-icons a:hover {
            background-color: #eee;
        }

        .form-control {
            margin-bottom: 15px;
        }

        .btn-primary {
            width: 100%;
            background-color: #3383ff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #1d6ce5;
        }

        .btn-outline-light {
            border-color: white;
            color: white;
        }

        .btn-outline-light:hover {
            background-color: white;
            color: #3383ff;
        }

        .logo {
            width: 40px;
            height: 40px;
            margin-left: 50px;
        }

        .bg-primary {
            background-color: #3498db !important;
            /* Warna biru muda */
        }

        .text-white p {
            font-size: 14px;
            opacity: 0.9;
        }
    </style>
</head>

<body class="portal-page">


    <div class="login-container">
        <div class="login-card">
            <div class="left-panel">
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo SPENYOSI" class="logo">
                    <h3 class="fw-bold ms-2">Sign In</h3>
                </div>
                <p>Masukkan alamat email dan kata sandi Akun Anda yang terdaftar.</p>
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <center>
                            <span class="font-medium">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                            </span>
                        </center>
                    </div>
                @endif
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>

                    <a href="#" class="d-block text-muted mb-3">Lupa kata sandi Anda?</a>

                    <button type="submit" class="btn btn-primary">SIGN IN</button>
                </form>
            </div>

            <!-- Panel Kanan (Info) -->
            <div class="right-panel">
                <h2 class="fw-bold">Halo, Teman!</h2>
                <p>Belum punya akun? daftarkan diri anda segera!</p>
                <a href="{{ route('regist') }}" class="btn btn-outline-light">SIGN UP</a>
            </div>
        </div>
    </div>



    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    <!-- Preloader -->
    <div class="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('OnePage/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('OnePage/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('OnePage/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('OnePage/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('OnePage/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('OnePage/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('OnePage/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('OnePage/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('OnePage/assets/js/main.js') }}"></script>

    {{-- @yield('custom-js') <!-- Tambahkan jika ada script tambahan --> --}}

</body>

</html>
