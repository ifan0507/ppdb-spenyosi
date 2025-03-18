@extends('layouts.siswa.template')

@section('content')
    <div class="container py-3">
        <div class="card" style="border-top: 3px solid #007bff;">
            <div class="card-header py-2 d-flex justify-content-between align-items-center">
                <h4 class="card-title mt-3 mb-3"><b>Biodata Siswa</b></h4>
            </div>
            <div class="card-body">
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-sm-8 col-lg-4">
                            <div class="border m-3 py-1 px-2 text-center" id="photo-box">
                                <label for="pribadi_blob" class="form-label">
                                    Foto Pribadi <span style="color:#e3342f">*</span><br />
                                    <b>(format: JPG/JPEG maks. 300KB)</b>
                                </label>

                                <img id="img-pribadi_blob" src="{{ asset('images/' . $data->siswa->foto) }}"
                                    class="img-fluid rounded border mb-2" style="max-width: 100%;">
                                <label for="pribadi_blob" class="btn btn-primary w-100">
                                    <i class="fas fa-folder-open"></i> Pilih Foto
                                </label>
                                <input type="file" id="pribadi_blob" name="pribadi_blob" class="d-none"
                                    accept="image/jpeg">
                                <div id="info-pribadi_blob" class="text-muted mt-2" style="display:none;"></div>
                            </div>
                        </div>
                        <!-- Kolom Form -->
                        <div class="col-md-8">
                            <div class="form-group required mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama" value="{{ $data->siswa->nama }}"
                                    required>
                            </div>

                            <div class="form-group required mb-3">
                                <label class="form-label">NISN</label>
                                <input type="text" class="form-control" name="nisn" value="{{ $data->siswa->nisn }}"
                                    required>
                            </div>

                            <div class="form-group required mb-3">
                                <label class="form-label">NIK</label>
                                <input type="text" class="form-control" name="nik" value="{{ $data->siswa->nik }}"
                                    required>
                            </div>

                            <div class="form-group required mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <div class="d-flex gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk_laki"
                                            value="Laki-laki"
                                            {{ $data->siswa->jenis_kelamin == 'Laki-laki' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="jk_laki">Laki-laki</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin"
                                            id="jk_perempuan" value="Perempuan"
                                            {{ $data->siswa->jenis_kelamin == 'Perempuan' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="jk_perempuan">Perempuan</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group required mb-3">
                                <label class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" name="tempat_lahir"
                                    value="{{ $data->siswa->tempat_lahir }}" required>
                            </div>

                            <div class="form-group required mb-3">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tanggal_lahir"
                                    value="{{ $data->siswa->tanggal_lahir }}" required>
                            </div>

                            <div class="form-group required mb-3">
                                <label class="form-label">Alamat</label>
                                <textarea class="form-control" name="alamat" rows="3" required>{{ $data->siswa->alamat }}</textarea>
                            </div>


                            <div class="form-group required mb-3">
                                <label class="form-label">No HP</label>
                                <input type="text" class="form-control" name="no_hp" value="{{ $data->siswa->no_hp }}"
                                    required>
                            </div>

                            <div class="form-group required mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ $data->siswa->email }}"
                                    required>
                            </div>
                        </div>


                    </div>

                    <div class="row justify-content-end">
                        <div class="col-sm-8 col-lg-8">
                            <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-save"></i> Perbarui
                                Biodata</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
