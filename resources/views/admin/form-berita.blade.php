@extends('layouts.admin.template')
@section('content')
    @include('layouts.admin.breadcrumb')
    <div class="pagetitle">
        <h1>Form Info</h1>
        {{-- {{ isset($info) ? 'Edit Berita' : 'Tambah Berita' }} --}}
    </div>

    <section class="section">
        <div class="card">
            <div class="card-body pt-3">
                <form action="#" method="POST" enctype="multipart/form-data">
                    {{-- {{ isset($info) ? route('info.update', $info->id) : route('info.store') }} --}}
                    {{-- @csrf
                    @if (isset($info))
                        @method('PUT')
                    @endif --}}

                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Berita</label>
                        <input type="text" name="judul" class="form-control" value="#" required>
                        {{-- {{ old('judul', $info->judul ?? '') }} --}}
                    </div>

                    <div class="mb-3">
                        <label for="thumbnail" class="form-label">Thumbnail</label>
                        <input type="file" name="thumbnail" class="form-control">
                        {{-- @if (isset($info) && $info->gambar)
                            <img src="{{ asset('storage/' . $berita->gambar) }}" class="mt-2" width="150">
                        @endif --}}
                    </div>

                    <div class="mb-3">
                        <label for="konten" class="form-label">Konten Berita</label>
                        <textarea name="konten" class="form-control" id="summernote" rows="10" required>#</textarea>
                        {{-- {{ old('deskripsi', $info->deskripsi ?? '') }} --}}
                    </div>

                    <button type="submit" class="btn btn-primary">#</button>
                    {{-- {{ isset($info) ? 'Update' : 'Simpan' }} --}}
                </form>
            </div>
        </div>
    </section>

    {{-- Tambahkan Summernote atau CKEditor --}}
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
        <script>
            $('#summernote').summernote({
                height: 250
            });
        </script>
    @endpush
@endsection
