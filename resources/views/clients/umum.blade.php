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

                <form action="#" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nisn" class="form-label">NISN <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nisn" placeholder="1234567890">
                    </div>

                    <div class="mb-3">
                        <label for="npsn" class="form-label">NPSN <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="npsn" placeholder="12345678">
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span
                                class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="tanggal_lahir">
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-light">Kembali</button>
                        <button type="submit" class="btn btn-primary">Selanjutnya →</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
