@extends('layouts.portal.template')
@section('content')
    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="row">
            <div class="col-lg-6 d-flex flex-column justify-content-center">
                <h1 class="fw-bold">Raih masa depanmu di Portal SNPMB</h1>
                <p>Belum memiliki akun SNPMB? Daftar segera di sini.</p>
                <a href="#" class="btn btn-primary w-auto">Daftar</a>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/illustration.png') }}" alt="Illustration" class="img-fluid">
            </div>
        </div>
    </div>
@endsection
