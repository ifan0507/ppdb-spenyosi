<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SMPENYOSI</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}">
    <!-- CSS untuk Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Choices.js -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    {{-- box icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard-siswa.css') }}">


    <!-- Script JS yang dibutuhkan (di bagian head sebaiknya hanya untuk library eksternal yang tidak menghalangi rendering) -->
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script src="{{ asset('assets/js/jquery-3.7.1.js') }}"></script> <!-- Hanya jika kamu memang membutuhkan jQuery -->
    <script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script> <!-- SweetAlert2 -->
    <style>
        table {
            width: 100%;
            /* Pastikan tabel penuh dalam card */
            border-collapse: collapse;
            /* Hilangkan jarak antar sel */
        }

        th,
        td {
            padding: 10px 15px;
            /* Kurangi padding agar lebih rapat */
            border-bottom: 1px solid #dee2e6;
            /* Tambahkan garis pemisah */
        }

        th {
            font-weight: 600;
            /* Tidak terlalu tebal */
            color: #333;
            /* Warna sedikit lebih lembut dari hitam */
            background-color: #f8f9fa;
            /* Warna latar belakang abu-abu sangat terang */
            text-align: left;
            /* Pastikan teks rata kiri */
            width: 30%;
            /* Atur agar th tidak terlalu panjang */
        }

        td {
            color: #555;
            background-color: #f8f9fa;
            /* Sama dengan th agar selaras */
            width: 70%;
            /* Pastikan td tidak terlalu melebar */
        }

        #map {
            height: 500px;
        }

        .choices__inner {
            min-height: 30px;
            font-size: 14px;
            padding: 4px 8px;
        }

        .choices__list--dropdown {
            max-height: 200px;
            overflow-y: auto;
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
    <script>
        // document.addEventListener("contextmenu", function(event) {
        //     event.preventDefault();
        //     alert("Klik kanan dinonaktifkan!");
        // });

        document.addEventListener("keydown", function(event) {
            if (event.ctrlKey && (event.key === "u" || event.key === "s" || event.key === "i" || event.key ===
                    "j")) {
                event.preventDefault();

            }
            // if (event.keyCode === 123) { // F12
            //     event.preventDefault();

            // }
        });
    </script>

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
