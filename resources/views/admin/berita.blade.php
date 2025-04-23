@extends('layouts.admin.template')

@section('content')
    @include('layouts.admin.breadcrumb')

    <section class="section">
        <div class="card">
            <div class="card-body pt-3">
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#infoModal"
                    onclick="openModal()">Tambah Berita</button>

                <div class="table-responsive">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Tanggal</th>
                                <th>Thumbnail</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($infos as $info) --}}
                            <tr>
                                <td></td>
                                {{-- {{ $loop->iteration }} --}}
                                <td></td>
                                {{-- {{ $info->judul }} --}}
                                <td></td>
                                {{-- {{ $info->created_at->format('d M Y') }} --}}
                                <td>
                                    {{-- @if ($info->gambar) --}}
                                    <img src="" width="80" {{-- {{ asset('storage/info/' . $info->gambar) }} --}} alt="thumb">
                                    {{-- @else --}}
                                    <span class="text-muted">Tidak ada</span>
                                    {{-- @endif --}}
                                </td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#infoModal" onclick="#">
                                        {{-- openModal({{ $info }}) --}}
                                        <i class="bi bi-pencil"></i>
                                    </button>

                                    <form action="#" method="POST" {{-- {{ route('admin.info.destroy', $info->id) }} --}} class="d-inline">
                                        {{-- @csrf @method('DELETE') --}}
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin hapus berita ini?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            {{-- @endforeach --}}
                        </tbody>
                    </table>
                </div>

                {{-- Modal --}}
                <div class="modal fade" id="infoModal" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form id="formBerita" method="POST" enctype="multipart/form-data">
                                {{-- @csrf --}}
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
                                        <input type="text" class="form-control" name="judul" id="judul" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Deskripsi</label>
                                        <div class="quill-editor-full"></div>
                                        <input type="hidden" name="deskripsi" id="deskripsi">
                                    </div>

                                    <div class="mb-3">
                                        <label for="gambar" class="form-label">Gambar / Dokumen</label>
                                        <input type="file" class="form-control" name="gambar" id="gambar"
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

    {{-- <script>
        $(document).ready(function() {
            // Validasi sebelum submit
            $('#formBerita').on('submit', function(e) {
                let judul = $('#judul').val().trim();
                let deskripsi = quill.root.innerHTML.trim();
                $('#deskripsi').val(deskripsi);

                if (judul === '' || deskripsi === '<p><br></p>') {
                    e.preventDefault();
                    alert('Judul dan Deskripsi wajib diisi!');
                }
            });
        });

        function openModal(info = null) {
            const $form = $('#formBerita');
            const $modal = $('#modalBerita');
            const $modalTitle = $('#modalTitle');
            const $methodField = $('#formMethod');

            $form.trigger("reset");
            quill.setContents([]);

            if (info) {
                $modalTitle.text('Edit Berita');
                $form.attr('action', `/admin/info/${info.id}`);
                $methodField.val('PUT');

                $('#beritaId').val(info.id);
                $('#judul').val(info.judul);
                quill.root.innerHTML = info.deskripsi;
            } else {
                $modalTitle.text('Tambah Berita');
                $form.attr('action', '{{ route('admin.info.store') }}');
                $methodField.val('POST');
            }

            $modal.modal('show');
        }
    </script> --}}
@endsection
