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

    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard-siswa.css') }}">


    <!-- Script JS yang dibutuhkan (di bagian head sebaiknya hanya untuk library eksternal yang tidak menghalangi rendering) -->
    <script src="{{ asset('assets/js/jquery-3.7.1.js') }}"></script> <!-- Hanya jika kamu memang membutuhkan jQuery -->
    <script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script> <!-- SweetAlert2 -->
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
            <div class="misc-content pt-4">
                <div class="container">
                    <div class="alert alert-primary">
                        <i class="fas fa-check"></i>
                        Jalur PPDB Umum
                    </div>
                    <div class="row justify-content-center">
                        <div class="card card-primary card-outline card-outline-tabs m-0 p-0 col-md-12">
                            <div class="card-header p-0 border-bottom-0">
                            </div>
                            <div class="card-body p-0">
                                <div class="accordion" id="accordionExample">
                                    <div class="card card-primary card-outline">
                                        <div class="card-header" id="headingOne">
                                            <h5 class="row justify-content-between">
                                                <div class="col-8 pt-lg-2">
                                                    <h4 class="font-bold" style="display: inline-block";>
                                                        Status Kelengkapan Berkas
                                                    </h4>
                                                    <span class="badge badge-success p-2 ml-2"
                                                        style="border-radius: 0.5rem";>Lengkap</span>

                                                </div>

                                            </h5>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="card card-primary card-outline card-outline-tabs col-md-12">
                            <div class="card-header p-0 border-bottom-0">
                                <ul class="nav nav-tabs" id="formulir-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link remove-tab-format font-bold active" id="biodata-tab"
                                            data-toggle="pill" href="#biodata" role="tab" aria-controls="biodata"
                                            aria-selected="true">Biodata</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link remove-tab-format font-bold" id="keluarga-tab"
                                            data-toggle="pill" href="#keluarga" role="tab" aria-controls="keluarga"
                                            aria-selected="false">Raport</a>
                                    </li>

                                </ul>
                            </div>
                            <div class="card-body">
                                @yield('content')
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </div>
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

    <!-- Skrip lainnya -->
    <script src="{{ asset('assets/js/all.min.js') }}"></script> <!-- Skrip kustom tambahan -->
    {{-- <script src="{{ asset('assets/js/myscript.js') }}"></script> <!-- Skrip kustom yang kamu buat --> --}}
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script> <!-- AdminLTE JS -->
    {{-- <script src="{{ asset('adminlte/dist/js/demo.js') }}"></script> <!-- AdminLTE Demo JS --> --}}

</body>

</html>
