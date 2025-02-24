@extends('layouts.portal.template')

@section('content')
    <div class="container">
        <h3>Verifikasi Email Anda</h3>
        <p>Kami telah mengirimkan email verifikasi ke {{ Auth::user()->email }}.</p>
        <p>Silakan periksa inbox atau spam folder Anda.</p>

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit">Kirim Ulang Email Verifikasi</button>
        </form>

        @if (session('message'))
            <p style="color: green;">{{ session('message') }}</p>
        @endif
    </div>
@endsection
