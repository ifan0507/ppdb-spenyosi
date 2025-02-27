@extends('layouts.portal.template')

@section('content')
    <div class="container">

        <h5>Masukan kode otp anda</h5>

        <form action="{{ url('/verify') }}" method="POST">
            @csrf
            <label>Email:</label>
            <input type="email" name="email" value="{{ $email }}" readonly>

            <label>Kode OTP:</label>
            <input type="text" name="otp" required>

            <button type="submit">Verifikasi</button>
        </form>

    </div>
@endsection
