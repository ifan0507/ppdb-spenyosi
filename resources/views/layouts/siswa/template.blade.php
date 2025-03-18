<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SMPENYOSI</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}">
    <!-- CSS untuk Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard-siswa.css') }}">


    <!-- Script JS yang dibutuhkan (di bagian head sebaiknya hanya untuk library eksternal yang tidak menghalangi rendering) -->
    <script src="{{ asset('assets/js/jquery-3.7.1.js') }}"></script> <!-- Hanya jika kamu memang membutuhkan jQuery -->
    <script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script> <!-- SweetAlert2 -->
    <style>
        #map {
            height: 500px;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

        {{-- Navbar --}}
        @include('layouts.siswa.header')
        {{-- /.Navbar --}}

        <!-- Main Sidebar Container -->
        @include('layouts.siswa.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->

        @include('layouts.siswa.footer')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- Memindahkan Skrip JavaScript ke bawah (sebelum penutupan </body>) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> <!-- Bootstrap JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <!-- Skrip lainnya -->
    <script src="{{ asset('assets/js/all.min.js') }}"></script> <!-- Skrip kustom tambahan -->
    {{-- <script src="{{ asset('assets/js/myscript.js') }}"></script> <!-- Skrip kustom yang kamu buat --> --}}
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script> <!-- AdminLTE JS -->
    {{-- <script src="{{ asset('adminlte/dist/js/demo.js') }}"></script> <!-- AdminLTE Demo JS --> --}}

</body>

</html>
