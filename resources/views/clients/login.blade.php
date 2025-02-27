@extends('layouts.portal.template')

@section('header')
@endsection
@section('footer')
@endsection

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <div class="login-container">
        <div class="login-card">
            <!-- Panel Kiri (Login Form) -->
            <div class="left-panel">
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo SPENYOSI" class="logo">
                    <h3 class="fw-bold ms-2">Sign In</h3>
                </div>

                {{-- <div class="social-icons">
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-google"></i></a>
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                </div> --}}

                <p>Masukkan alamat email dan kata sandi Akun Anda yang terdaftar.</p>

                <form action="#" method="POST">
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
@endsection
