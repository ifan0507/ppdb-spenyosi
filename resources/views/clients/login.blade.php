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
                    <h3 class="fw-bold sign-in-title">Sign In</h3>
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
                    <input type="email" name="email" class="form-control mb-3" placeholder="Example@gmail.com" required
                        value="{{ old('email') }}">
                    <input type="password" name="password" class="form-control" placeholder="Masukan Password" required
                        value="{{ old('password') }}">

                    <a href="#" class="d-block text-muted mb-3">Lupa kata sandi Anda?</a>

                    <button type="submit" class="btn btn-primary">SIGN IN</button>
                </form>
            </div>

            <!-- Panel Kanan (Info) -->
            <div class="right-panel">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="welcome-logo">
                <h2 class="fw-bold">Selamat Datang!</h2>
                <p>Silakan masuk untuk melanjutkan.</p>
                <div class="social-icons">
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-google"></i></a>
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
        </div>
    </div>
@endsection
