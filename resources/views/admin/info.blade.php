@extends('layouts.admin.template')

@section('content')
    @include('layouts.admin.breadcrumb')

    <section class="section">
        <div class="card">
            <div class="card-body pt-3">
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#infoModal">Tambah
                    Info</button>

                <div class="table-responsive">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>File/Image</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($infos as $info)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $info->judul }}</td>
                                    <td>{{ $info->deskripsi }}</td>
                                    <td>
                                        @php
                                            $ext = pathinfo($info->file, PATHINFO_EXTENSION);
                                            $url = Storage::url($info->file);
                                        @endphp
                                        @if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                            <img src="{{ $url }}" class="img-fluid" alt="Preview Info">
                                        @elseif ($ext === 'pdf')
                                            <iframe src="{{ $url }}" width="70%" height="400px"
                                                frameborder="0"></iframe>
                                        @endif
                                    </td>

                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#infoModal" onclick="openModal({{ $info }})">
                                            <i class="bi bi-pencil"></i>
                                        </button>

                                        <form action="{{ route('info.delete', $info->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin hapus berita ini?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Modal --}}
                <div class="modal fade" id="infoModal" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form id="formBerita" method="POST" enctype="multipart/form-data"
                                action="{{ route('info.post') }}">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTitle">Tambah Berita</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <input type="hidden" name="_method" id="formMethod" value="POST">
                                    <input type="hidden" name="id" id="beritaId">

                                    <div class="mb-3">
                                        <label for="judul" class="form-label">Judul</label>
                                        <textarea name="judul" id="judul" cols="30" rows="4" class="form-control"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Deskripsi</label>
                                        <div class="quill-editor-full" id="quill-deskripsi"></div>
                                        <input type="hidden" name="deskripsi" id="deskripsi-input">
                                    </div>

                                    <div class="mb-3">
                                        <label for="gambar" class="form-label">Gambar / Dokumen</label>
                                        <input type="file" class="form-control" name="file" id="gambar"
                                            accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                                        <div class="invalid-feedback" id="gambarError">File tidak valid</div>
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!-- End Modal -->
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            const quill = new Quill('#quill-deskripsi', {
                theme: 'snow'
            });

            const $hidden = $('#deskripsi-input');

            quill.on('text-change', function() {
                let plain = quill.getText();
                plain = plain.replace(/\n$/, '');

                $hidden.val(plain);
            });

            // Validasi sebelum submit
            $('#formBerita').on('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                if ($("#judul").val() == "") {
                    Swal.fire({
                        icon: "error",
                        text: "Judul Wajib Diisi",
                        title: "Opps.."
                    })
                    return;
                }

                $.ajax({
                    url: $('#formBerita').attr('action'),
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        Swal.fire({
                            icon: "success",
                            text: "ditambahkan",
                            title: "Berhasil"
                        }).then(() => {
                            window.location.href = response.redirect
                        })
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: "error",
                            title: "Gagal",
                            text: xhr.responseJSON?.message || 'Terjadi kesalahan!'
                        });
                    }
                })
            });
        });
    </script>
@endsection
