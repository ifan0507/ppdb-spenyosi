@extends('layouts.portal.template')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="fw-bold">Registrasi Jalur Khusus</h2>
                <p>Untuk mendapatkan akun Jalur Khusus, masukkan kombinasi <strong>Nama Lengkap</strong>,
                    <strong>NISN</strong>, <strong>Email</strong>, <strong>Password</strong>, dan pilih salah satu kategori
                    jalur khusus.
                </p>
                <form action="{{ route('registerKhusus') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama_lengkap" class="form-control" id="nama"
                            placeholder="Nama Lengkap">
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

                    <div class="mb-3">
                        <label for="jalur_ppdb" class="form-label">Pilih Jalur Khusus <span
                                class="text-danger">*</span></label>
                        <select name="jalur_ppdb" id="jalur_ppdb" class="form-control">
                            <option value="" selected disabled>-- Pilih Jalur --</option>
                            <option value="afirmasi">Afirmasi (Siswa dari keluarga kurang mampu)</option>
                            <option value="pindah_tugas">Pindah Tugas (Orang tua/wali pindah kerja)</option>
                            <option value="tahfidz">Tahfidz (Memiliki hafalan Al-Qur'an)</option>
                            <option value="prestasi">Prestasi (Akademik atau non-akademik)</option>
                        </select>
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
