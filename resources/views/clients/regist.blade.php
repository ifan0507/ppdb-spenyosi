@extends('layouts.portal.template')

@section('content')
    <div class="container text-center py-5">
        <h2>Registrasi Akun SPMB</h2>

        <div class="row justify-content-center mt-4">
            <!-- Box Tahap 1 -->
            <div class="col-md-5">
                <a href="{{ route('register.khusus') }}" class="text-decoration-none">
                    <div class="box-icon p-4 text-center disabled-box">
                        <img src="{{ asset('assets/img/illustration.png') }}" alt="Tahap 1" class="img-fluid mb-3"
                            width="150">
                        <h4 class="fw-bold text-dark">Tahap 1</h4>
                        <p class="text-muted" style="min-height: 80px;">Pendaftaran jalur khusus dengan kriteria: Afirmasi,
                            Pindah Tugas Orang Tua,
                            Prestasi Akademik, Prestasi Nonakademik, dan Prestasi Raport.</p>
                        <div class="button-container">
                            <button class="btn btn-primary">Daftar Akun Tahap 1</button>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Box Tahap 2 -->
            <div class="col-md-5">
                <a href="{{ route('register.umum') }}" class="text-decoration-none">
                    <div class="box-icon p-4 text-center">
                        <img src="{{ asset('assets/img/illustration.png') }}" alt="Tahap 2" class="img-fluid mb-3"
                            width="150">
                        <h4 class="fw-bold text-dark">Tahap 2</h4>
                        <p class="text-muted" style="min-height: 80px;">Pendaftaran jalur umum berdasarkan seleksi domisili
                            dan zonasi sesuai daya tampung sekolah.</p>
                        <div class="button-container">
                            <button class="btn btn-primary">Daftar Akun Tahap 2</button>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
