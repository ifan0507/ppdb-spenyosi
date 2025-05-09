@extends('layouts.portal.template')

@section('header')
@endsection

@section('footer')
@endsection

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">

    <div class="login-container">
        <div class="login-card">
            <!-- Panel Kiri (Form Login) -->
            <div class="left-panel d-flex align-items-center justify-content-center">
                <div class="d-inline-flex align-items-center login-title">
                    <div class="logo-container">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo Icon" class="login-icon floating-icon">
                    </div>
                    <h3 class="fw-bold sign-in-title ms-2 mb-0">Sign In</h3>
                </div>
                <p class="mt-3">Masukkan alamat email dan kata sandi akun Anda.</p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control mb-3"
                        placeholder="Email" required>
                    <input type="password" name="password" value="{{ old('password') }}" class="form-control"
                        placeholder="Password" required>

                    <a href="#" class="forgot-password">Lupa kata sandi?</a>

                    <button type="submit" class="btn-primary">SIGN IN</button>
                </form>
            </div>

            <!-- Panel Kanan (Info dan Logo) -->
            <div class="right-panel">
                <div class="logo-container">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="welcome-logo floating-logo">
                </div>
                <h2 class="fw-bold">Selamat Datang!</h2>
                <p>Silakan masuk untuk melanjutkan.</p>
            </div>
        </div>
    </div>

    <style>
        /* Animasi mengambang untuk logo */
        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .logo-container {
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .floating-icon {
            animation: float 3s ease-in-out infinite;
        }

        .floating-logo {
            animation: float 4s ease-in-out infinite;
        }

        /* Tambahkan bayangan (shadow) halus untuk efek melayang */
        .login-icon,
        .welcome-logo {
            filter: drop-shadow(0 5px 15px rgba(0, 0, 0, 0.1));
        }

        /* Efek transisi saat hover */
        .login-icon:hover,
        .welcome-logo:hover {
            animation-play-state: paused;
            transform: scale(1.05);
            transition: transform 0.3s ease;
        }
    </style>
@endsection
