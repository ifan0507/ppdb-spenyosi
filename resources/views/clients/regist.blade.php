@extends('layouts.portal.template')

@section('content')
    <div class="container text-center py-5">
        <h2>Registrasi Akun PPDB</h2>

        <div class="row justify-content-center mt-4">
            <!-- Box Siswa -->
            <div class="col-md-5">
                <a href="{{ route('register.umum') }}" class="text-decoration-none">
                    <div class="box-icon p-4 text-center">
                        <img src="{{ asset('assets/img/illustration.png') }}" alt="Siswa" class="img-fluid mb-3"
                            width="150">
                        <h4 class="fw-bold text-dark">Jalur Umum</h4>
                        <p class="text-muted">Jalur seleksi reguler bagi calon peserta didik berdasarkan peringkat nilai dan
                            daya tampung sekolah.</p>
                        <button class="btn btn-primary">Daftar Akun Umum</button>
                    </div>
                </a>
            </div>

            <!-- Box Sekolah -->
            <div class="col-md-5">
                <a href="{{ route('register.khusus') }}" class="text-decoration-none">
                    <div class="box-icon p-4 text-center disabled-box">
                        <img src="{{ asset('assets/img/illustration.png') }}" alt="Sekolah" class="img-fluid mb-3"
                            width="150">
                        <h4 class="fw-bold text-dark">Jalur Khusus</h4>
                        <p class="text-muted">Jalur pendaftaran dengan kriteria tertentu, meliputi: Afirmasi, Prestasi,
                            Tahfidz, Pindah Tugas Orang Tua.</p>
                        <button class="btn btn-primary">Daftar Akun Khusus</button>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
