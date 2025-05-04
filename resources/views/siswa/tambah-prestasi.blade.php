@extends('layouts.siswa.template')

@section('content')
    <div class="misc-content pt-4">
        @include('layouts.siswa.breadcrumb', [
            'breadcrumb' => [
                'Documen Prestasi' => route('siswa.prestasi'),
                'Tambah Dokumen Prestasi' => '',
            ],
        ])
        <div class="container-fluid">
            @include('layouts.siswa.header-update')
            <div class="row justify-content-center">
                <div class="card card-primary card-outline card-outline-tabs col-md-12">
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('prestasi.store') }}"
                            id="main-form">
                            @csrf
                            <div class="row">
                                <div class="col-sm-8 col-lg-6">
                                    <div class="form-group required">
                                        <label class="title">Nama Kegiatan</label>
                                        <input type="text" placeholder="Misal: Lomba Thafidz tingkat Provinsi"
                                            class="form-control" name="nama_prestasi" id="nama_kegiatan"
                                            value="{{ old('nama_prestasi') }}">
                                    </div>

                                    <div class="form-group required">
                                        <label class="title">Kategori Lomba</label>
                                        <select class="form-control" id="kategori" name="kategori">
                                            <option value="" disabled selected>-- Pilih Kategori --</option>
                                            <option value="Akademik" {{ old('kategori') == 'Akademik' ? 'selected' : '' }}>
                                                Akademik</option>
                                            <option value="Non-akademik"
                                                {{ old('kategori') == 'Non-akademik' ? 'selected' : '' }}>
                                                Non-akademik</option>
                                        </select>
                                    </div>

                                    <div class="form-group required">
                                        <label class="title" for="tingkat">Tingkat</label>
                                        <div class="d-block">
                                            @foreach (['Kabupaten/Kota', 'Provinsi', 'Nasional', 'Internasional'] as $tingkat)
                                                <div class="custom-control custom-radio d-inline-block mr-2">
                                                    <input type="radio" class="custom-control-input"
                                                        id="tingkat_{{ $loop->index }}" name="tingkat_prestasi"
                                                        value="{{ $tingkat }}"
                                                        {{ old('tingkat_prestasi') == $tingkat ? 'checked' : '' }}>
                                                    <label class="custom-control-label"
                                                        for="tingkat_{{ $loop->index }}">{{ $tingkat }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="form-group required">
                                        <label class="title">Tahun Perolehan</label>
                                        <select class="form-control" id="thn_perolehan" name="thn_perolehan">
                                            <option value="" disabled selected>-- Pilih Tahun Perolehan Prestasi --
                                            </option>
                                            @foreach (range(2020, now()->year + 1) as $year)
                                                <option value="{{ $year }}"
                                                    {{ old('thn_perolehan') == $year ? 'selected' : '' }}>
                                                    {{ $year }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group required">
                                        <label class="title">Pencapaian</label><br>
                                        <select class="form-control" id="perolehan" name="perolehan">
                                            <option value="" disabled selected>-- Pilih Pencapaian --</option>
                                            @foreach (['Juara 1', 'Juara 2', 'Juara 3', 'Finalis', 'Lainnya'] as $juara)
                                                <option value="{{ $juara }}"
                                                    {{ old('perolehan') == $juara ? 'selected' : '' }}>
                                                    {{ $juara }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-8 col-lg-4">
                                    <div class="border m-3 py-1 px-2 text-center" id="photo-box">
                                        <label for="prestasi_blob" class="form-label">
                                            Dokumen Pendukung <span style="color:#e3342f">*</span><br />
                                            <b>(format: JPG/JPEG maks. 1MB)</b>
                                        </label>

                                        <img id="img-prestasi_blob" src="{{ asset('storage/siswa/default_document.png') }}"
                                            class="img-fluid rounded border mb-2" style="max-width: 100%;">
                                        <label for="prestasi_blob" class="btn btn-primary w-100">
                                            <i class="fas fa-folder-open"></i> Pilih Foto
                                        </label>
                                        <input type="file" id="prestasi_blob" name="image" class="d-none"
                                            accept="image/jpeg">
                                        <div id="info-prestasi_blob" class="text-muted mt-2" style="display:none;"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-sm-8 col-lg-6">
                                    <button type="submit" class="btn btn-primary btn-block" id="btnKirim">
                                        <i class="fas fa-save" id="icon_kirim"></i>
                                        <span id="textBtn"> Simpan Prestasi</span>
                                        <span id="loadingBtn" class="spinner-border spinner-border-sm d-none" role="status"
                                            aria-hidden="true"></span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
