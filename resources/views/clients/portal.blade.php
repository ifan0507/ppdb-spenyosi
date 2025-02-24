@extends('layouts.portal.template')
@section('content')
    <div class="container d-flex align-items-center justify-content-center mt-5">
        <div class="row">
            <div class="col-lg-6 d-flex flex-column align-items-start justify-content-center">
                <h1 class="fw-bold">Selamat Datang Di Portal PPDB SPENYOSI</h1>
                <p>Belum memiliki akun? Daftar segera di sini.</p>
                <a href="{{ route('regist') }}" class="btn btn-primary btn-sm px-4 py-2">Daftar</a>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/illustration.png') }}" alt="Illustration" class="img-fluid">
            </div>
        </div>
    </div>
@endsection
