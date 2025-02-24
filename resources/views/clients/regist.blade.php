@extends('layouts.portal.template')

@section('content')
    <div class="container text-center mt-5">
    <h2>Registrasi Akun SNPMB</h2>
    <div class="row justify-content-center mt-4">
        <!-- Box Siswa -->
        <div class="col-md-5">
            <div class="card shadow">
                <img src="{{ asset('') }}" class="img-fluid" alt="Siswa">
                <h4 class="mt-3">Siswa</h4>
                <p>Saya adalah siswa yang memiliki NISN</p>
                <a href="{{ route('') }}" class="btn btn-primary">Daftar Akun Siswa</a>
            </div>
        </div>
        <!-- Box Sekolah -->
        <div class="col-md-5">
            <div class="card shadow disabled-card">
                <img src="{{ asset('') }}" class="img-fluid" alt="Sekolah">
                <h4 class="mt-3">Sekolah</h4>
                <p>Saya adalah wakil sekolah yang memiliki NPSN dan kode registrasi Dapodik</p>
                <div class="alert alert-danger p-2" role="alert">
                    <i class="bi bi-info-circle"></i> Pendaftaran akun sekolah <strong>sudah ditutup!</strong>
                </div>
                <button class="btn btn-secondary" disabled>Daftar Akun Sekolah</button>
            </div>
        </div>
    </div>
</div>
@endsection