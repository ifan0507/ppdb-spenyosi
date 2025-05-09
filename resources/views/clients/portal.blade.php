@extends('layouts.portal.template')
@section('content')
    <div class="container d-flex align-items-center justify-content-center py-5 mt-3 mb-5">
        <div class="row d-flex align-items-center">
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold my-3" style="color: black">Selamat Datang di Portal SPMB Spenyosi</h1>
                <div class="row gap-3 gap-lg-0">
                    <div class="col-lg-12">
                        <p class="lead">Belum memiliki akun SPMB? Daftar segera di sini.</p>
                        <a class="btn btn-primary px-4" href="{{ route('regist') }}">Daftar</a>
                    </div>
                    <div class="col-12 mt-2 d-lg-none">
                        <hr class="my-0">
                    </div>
                    <div class="col-lg-12 d-lg-none">
                        <p class="lead">Sudah memiliki akun SPMB?</p>
                        <a class="btn btn-outline-primary px-4" href="{{ route('siswa-login') }}">Masuk</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-center d-none d-lg-inline-flex justify-content-center">
                <img src="{{ asset('assets/img/illustration.png') }}" alt="landing-img" width="350" class="img-fluid">
            </div>
        </div>
    </div>
@endsection
