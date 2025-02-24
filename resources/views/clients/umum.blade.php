@extends('layouts.portal.template')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="fw-bold">Registrasi Jalur Umum</h2>
                <p>Untuk mendapatkan akun Jalur Umum, masukkan kombinasi <strong>NISN</strong>, <strong>NPSN</strong>,
                    dan <strong>tanggal lahir</strong>.</p>
                <p>Untuk siswa <strong>Luar Negeri</strong> yang berasal dari <strong>sekolah non SRI (Sekolah Rakyat
                        Indonesia)</strong> dapat menggunakan NPSN 69999999.</p>

                <form action="{{ route('registerUmum') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama_lengkap" class="form-control" id="nama"
                            placeholder="1234567890">
                    </div>

                    <div class="mb-3">
                        <label for="nisn" class="form-label">NISN <span class="text-danger">*</span></label>
                        <input type="text" name="nisn" class="form-control" id="nisn" placeholder="12345678">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" id="email">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('regist') }}">
                            <button type="button" class="btn btn-light">Kembali</button>
                        </a>
                        <button type="submit" class="btn btn-primary">Selanjutnya →</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
