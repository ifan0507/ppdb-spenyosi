@extends('layouts.siswa.template')

@section('content')
    <div class="misc-content pt-4">
        @include('layouts.siswa.breadcrumb', [
            'breadcrumb' => [
                'Documen Prestasi' => route('siswa.akademik'),
                'Tambah Dokumen Prestasi' => '',
            ],
        ])
        <div class="container-fluid">
            @include('layouts.siswa.header-update')
            <div class="row justify-content-center">
                <div class="card card-primary card-outline card-outline-tabs col-md-12">
                    <div class="card-body">
                        <form method="POST" action="{{ route('akademik.store') }}" enctype="multipart/form-data"
                            id="prestasiForm">
                            @csrf
                            <div class="form-group row mb-3">
                                <label for="nama_prestasi" class="col-md-4 col-form-label text-md-right">Nama
                                    Prestasi</label>
                                <div class="col-md-6">
                                    <input id="nama_prestasi" type="text"
                                        class="form-control @error('nama_prestasi') is-invalid @enderror"
                                        name="nama_prestasi" value="{{ old('nama_prestasi') }}" required
                                        autocomplete="nama_prestasi">
                                    @error('nama_prestasi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="tingkat_prestasi" class="col-md-4 col-form-label text-md-right">Tingkat
                                    Prestasi</label>
                                <div class="col-md-6">
                                    <select id="tingkat_prestasi"
                                        class="form-control @error('tingkat_prestasi') is-invalid @enderror"
                                        name="tingkat_prestasi" required>
                                        <option value="">Pilih Tingkat Prestasi</option>
                                        <option value="Kabupaten/Kota">Kabupaten/Kota</option>
                                        <option value="Provinsi">Provinsi</option>
                                        <option value="Nasional">Nasional</option>
                                        <option value="Internasional">Internasional</option>
                                    </select>
                                    @error('tingkat_prestasi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="thn_perolehan" class="col-md-4 col-form-label text-md-right">Tahun
                                    Perolehan</label>
                                <div class="col-md-6">
                                    <select id="thn_perolehan"
                                        class="form-control @error('thn_perolehan') is-invalid @enderror"
                                        name="thn_perolehan" required>
                                        <option value="">Pilih Tahun</option>
                                        @php
                                            $currentYear = date('Y');
                                            for ($i = $currentYear; $i >= $currentYear - 5; $i--) {
                                                echo "<option value='" . $i . "'>" . $i . '</option>';
                                            }
                                        @endphp
                                    </select>
                                    @error('thn_perolehan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="perolehan" class="col-md-4 col-form-label text-md-right">Perolehan</label>
                                <div class="col-md-6">
                                    <select id="perolehan" class="form-control @error('perolehan') is-invalid @enderror"
                                        name="perolehan" required>
                                        <option value="">Pilih Perolehan</option>
                                        <option value="Juara 1">Juara 1</option>
                                        <option value="Juara 2">Juara 2</option>
                                        <option value="Juara 3">Juara 3</option>
                                        <option value="Golden Ticket">Golden Ticket</option>
                                    </select>
                                    @error('perolehan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="image" class="col-md-4 col-form-label text-md-right">Dokumen</label>
                                <div class="col-md-6">
                                    <input id="image" type="file"
                                        class="form-control @error('image') is-invalid @enderror" name="image" required>
                                    <small class="form-text text-muted">Upload file sertifikat/dokumen prestasi (format:
                                        jpg, jpeg, png)</small>
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Simpan
                                    </button>
                                    <a href="{{ route('akademik') }}" class="btn btn-secondary">
                                        Kembali
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#prestasiForm').submit(function(e) {
                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.redirect) {
                            window.location.href = response.redirect;
                        }
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('#' + key).addClass('is-invalid');
                            $('#' + key).after('<div class="invalid-feedback">' + value[
                                0] + '</div>');
                        });
                    }
                });
            });
        });
    </script>
@endsection
