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
                                    <td>{!! Str::limit($info->deskripsi, 100) !!}</td>
                                    <td>
                                        @php
                                            $ext = pathinfo($info->file, PATHINFO_EXTENSION);
                                            $url = asset('storage/' . $info->file);
                                        @endphp
                                        @if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                            <img src="{{ $url }}" class="img-thumbnail preview-image"
                                                style="max-width: 100px; height: auto; cursor: pointer;"
                                                data-bs-toggle="modal" data-bs-target="#imagePreviewModal"
                                                data-src="{{ $url }}">
                                        @elseif ($ext === 'pdf')
                                            <a href="{{ $url }}" target="_blank" class="btn btn-sm btn-primary">
                                                <i class="bi bi-file-earmark-pdf"></i> View PDF
                                            </a>
                                        @else
                                            <a href="{{ $url }}" download class="btn btn-sm btn-secondary">
                                                <i class="bi bi-download"></i> Download
                                            </a>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="d-inline-flex gap-1">
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#infoModal" onclick="openModal({{ $info }})"
                                                title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </button>

                                            <form action="{{ route('info.delete', $info->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin hapus berita ini?')" title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

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
                                        <label for="judul" class="form-label">Judul <span
                                                class="text-danger">*</span></label>
                                        <textarea name="judul" id="judul" cols="30" rows="2" class="form-control" required></textarea>
                                        <div class="invalid-feedback">Judul wajib diisi</div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                                        <div id="quill-deskripsi" style="height: 200px;"></div>
                                        <input type="hidden" name="deskripsi" id="deskripsi-input" required>
                                        <div class="invalid-feedback">Deskripsi wajib diisi</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="file" class="form-label">Gambar / Dokumen <span
                                                class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="file" id="file"
                                            accept=".jpg,.jpeg,.png,.pdf,.doc,.docx" required>
                                        <small class="text-muted">Format yang diterima: JPG, PNG, PDF, DOC (Max 1MB)</small>
                                        <div class="invalid-feedback" id="fileError">File wajib diisi dan harus sesuai
                                            format</div>

                                        <!-- Preview Container -->
                                        <div class="mt-2" id="filePreviewContainer" style="display: none;">
                                            <h6>Preview:</h6>
                                            <div class="border p-2">
                                                <img id="imagePreview" class="img-fluid d-none" style="max-height: 200px;">
                                                <div id="docPreview" class="d-none">
                                                    <i class="bi bi-file-earmark-text fs-1"></i>
                                                    <p id="fileNamePreview" class="mb-0"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary" id="btnSubmit"><span id="textBtn">
                                            Simpan</span>
                                        <span id="loadingBtn" class="spinner-border spinner-border-sm d-none"
                                            role="status" aria-hidden="true"></span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!-- End Modal -->

                <!-- Image Preview Modal -->
                <div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Preview Gambar</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <img id="modalPreviewImage" src="" class="img-fluid" style="max-height: 70vh;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            const quill = new Quill('#quill-deskripsi', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline', 'strike'],
                        ['blockquote', 'code-block'],
                        [{
                            'header': 1
                        }, {
                            'header': 2
                        }],
                        [{
                            'list': 'ordered'
                        }, {
                            'list': 'bullet'
                        }],
                        [{
                            'script': 'sub'
                        }, {
                            'script': 'super'
                        }],
                        [{
                            'indent': '-1'
                        }, {
                            'indent': '+1'
                        }],
                        [{
                            'direction': 'rtl'
                        }],
                        [{
                            'size': ['small', false, 'large', 'huge']
                        }],
                        [{
                            'header': [1, 2, 3, 4, 5, 6, false]
                        }],
                        [{
                            'color': []
                        }, {
                            'background': []
                        }],
                        [{
                            'font': []
                        }],
                        [{
                            'align': []
                        }],
                        ['clean'],
                        ['link', 'image']
                    ]
                },
                placeholder: 'Tulis deskripsi disini...'
            });

            // Initialize modal for new entry
            $('#infoModal').on('show.bs.modal', function(e) {
                if (!e.relatedTarget) {
                    resetModal();
                    $('#modalTitle').text('Tambah Info');
                    $('#formMethod').val('POST');
                    $('#formBerita').attr('action', "{{ route('info.post') }}");
                }
            });

            // File input change handler
            $('#file').change(function() {
                const file = this.files[0];
                const previewContainer = $('#filePreviewContainer');
                const imagePreview = $('#imagePreview');
                const docPreview = $('#docPreview');
                const fileNamePreview = $('#fileNamePreview');

                if (file) {
                    previewContainer.show();

                    if (file.type.match('image.*')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            imagePreview.attr('src', e.target.result).removeClass('d-none');
                            docPreview.addClass('d-none');
                        }
                        reader.readAsDataURL(file);
                    } else {
                        imagePreview.addClass('d-none');
                        docPreview.removeClass('d-none');
                        fileNamePreview.text(file.name);
                    }
                } else {
                    previewContainer.hide();
                }
            });

            // Image preview modal
            $('#imagePreviewModal').on('show.bs.modal', function(event) {
                const button = $(event.relatedTarget);
                const imageUrl = button.data('src');
                $(this).find('#modalPreviewImage').attr('src', imageUrl);
            });

            // Reset modal when closed
            $('#infoModal').on('hidden.bs.modal', function() {
                resetModal();
            });

            // Open modal for editing
            window.openModal = function(info) {
                resetModal();

                $('#modalTitle').text('Edit Info');
                $('#formMethod').val('PUT');
                $('#beritaId').val(info.slug);
                $('#judul').val(info.judul);
                quill.root.innerHTML = info.deskripsi;
                $('#deskripsi-input').val(info.deskripsi);
                $('#formBerita').attr('action', '/admin/info/' + info.slug + '/update');

                // File handling for edit
                $('#file').removeAttr('required');
                const previewContainer = $('#filePreviewContainer');
                const ext = info.file.split('.').pop().toLowerCase();

                if (['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(ext)) {
                    previewContainer.show();
                    $('#imagePreview').attr('src', "{{ asset('storage') }}/" + info.file).removeClass(
                        'd-none');
                    $('#docPreview').addClass('d-none');
                } else if (info.file) {
                    previewContainer.show();
                    $('#imagePreview').addClass('d-none');
                    $('#docPreview').removeClass('d-none');
                    $('#fileNamePreview').text(info.file.split('/').pop());
                }
            }



            // Form submission
            $('#formBerita').on('submit', function(e) {
                e.preventDefault();

                // Validate form
                if (!validateForm()) return;

                // Update hidden input with Quill content
                $('#deskripsi-input').val(quill.root.innerHTML);

                const formData = new FormData(this);
                const isUpdate = $('#formMethod').val() === 'PUT';
                const url = isUpdate ?
                    '/admin/info/' + $('#beritaId').val() + '/update' :
                    "{{ route('info.post') }}";

                // Add CSRF token
                formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

                // For update, we need to explicitly append all fields
                if (isUpdate) {
                    formData.append('_method', 'PUT');
                    formData.append('judul', $('#judul').val());
                    formData.append('deskripsi', quill.root.innerHTML);
                    if ($('#file')[0].files[0]) {
                        formData.append('file', $('#file')[0].files[0]);
                    }
                }
                $("#btnSubmit").attr("disabled", true);
                $("#textBtn").addClass("d-none");
                $("#loadingBtn").removeClass("d-none");

                $.ajax({
                    url: url,
                    type: 'POST', // Always use POST for FormData with method spoofing
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $("#btnSubmit").attr("disabled", false);
                        $("#textBtn").removeClass("d-none");
                        $("#loadingBtn").addClass("d-none");
                        Swal.fire({
                            icon: "success",
                            text: "Data berhasil " + (isUpdate ? "diperbarui" :
                                "ditambahkan"),
                            title: "Berhasil"
                        }).then(() => {
                            window.location.href = response.redirect || window.location
                                .href;
                        });
                    },
                    error: function(xhr) {
                        $("#btnSubmit").attr("disabled", false);
                        $("#textBtn").removeClass("d-none");
                        $("#loadingBtn").addClass("d-none");
                        let errorMessage = xhr.responseJSON?.message || 'Terjadi kesalahan!';
                        if (xhr.responseJSON?.errors) {
                            errorMessage = Object.values(xhr.responseJSON.errors).join('<br>');
                        }
                        Swal.fire({
                            icon: "error",
                            title: "Gagal",
                            html: errorMessage
                        });
                    }
                });
            });

            // Helper function to reset modal
            function resetModal() {
                quill.root.innerHTML = '';
                $('#formBerita')[0].reset();
                $('#filePreviewContainer').hide();
                $('.is-invalid').removeClass('is-invalid');
                $('#file').attr('required', 'required');
                $('#formMethod').val('POST');
                $('#formBerita').attr('action', "{{ route('info.post') }}");
            }

            // Helper function for form validation
            function validateForm() {
                let isValid = true;

                // Validate title
                if (!$('#judul').val().trim()) {
                    $('#judul').addClass('is-invalid');
                    isValid = false;
                } else {
                    $('#judul').removeClass('is-invalid');
                }

                // Validate description
                if (quill.getText().trim()) {
                    $('#quill-deskripsi').addClass('is-invalid');
                    isValid = false;
                } else {
                    $('#quill-deskripsi').removeClass('is-invalid');
                }

                // Validate file (only for new entries)
                if ($('#formMethod').val() === 'POST' && !$('#file')[0].files[0]) {
                    $('#file').addClass('is-invalid');
                    $('#fileError').text('File wajib diisi');
                    isValid = false;
                } else if ($('#file')[0].files[0]) {
                    const file = $('#file')[0].files[0];
                    const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp',
                        'application/pdf',
                        'application/msword',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                    ];
                    const maxSize = 1 * 1024 * 1024; // 1MB

                    if (!validTypes.includes(file.type)) {
                        $('#file').addClass('is-invalid');
                        $('#fileError').text('Format file tidak didukung');
                        isValid = false;
                    } else if (file.size > maxSize) {
                        $('#file').addClass('is-invalid');
                        $('#fileError').text('Ukuran file maksimal 1MB');
                        isValid = false;
                    } else {
                        $('#file').removeClass('is-invalid');
                    }
                }

                if (!isValid) {
                    Swal.fire({
                        icon: "error",
                        title: "Error Validasi",
                        text: "Harap periksa kembali form Anda"
                    });
                    return false;
                }

                return true;
            }
        });
    </script>
@endsection
