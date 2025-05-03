@extends('layouts.siswa.template')

@section('content')
    <div class="misc-content pt-4">
        <div class="container">
            <div class="alert alert-primary">
                <i class="fas fa-check"></i>
                Jalur PPDB {{ $data->jalur->nama_jalur }}
            </div>
            <div class="row justify-content-center">
                <div class="card card-primary card-outline card-outline-tabs m-0 p-0 col-md-12">
                    <div class="card-header p-0 border-bottom-0">
                    </div>
                    <div class="card-body p-0">
                        <div class="accordion" id="accordionExample">
                            <div class="card card-primary card-outline">
                                @include('layouts.siswa.status_berkas')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="card card-primary card-outline card-outline-tabs col-md-12">
                    @include('layouts.siswa.tab-content')

                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="card-body p-0">
                                <div class="accordion" id="accordionExample">
                                    <div class="card card-primary card-outline">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h4>Prestasi</h4>
                                            <a href="{{ route('prestasi.edit') }}" class="btn btn-primary ms-auto">
                                                <i class="fas fa-edit"></i> Tambah Prestasi
                                            </a>
                                        </div>
                                        <!-- Bagian atas halaman prestasi -->
                                        <div class="card-body">
                                            <!-- Tampilkan info tentang kuota prestasi -->
                                            <div class="alert alert-info">
                                                <p class="mb-0">
                                                    <i class="fas fa-info-circle"></i> Anda dapat menambahkan maksimal 3
                                                    prestasi Akademik dan 3 prestasi Non-akademik.
                                                </p>
                                                <p class="mb-0">
                                                    <b>Prestasi Akademik:</b> {{ $jumlahAkademik ?? 0 }}/3 |
                                                    <b>Prestasi Non-akademik:</b> {{ $jumlahNonAkademik ?? 0 }}/3
                                                </p>
                                            </div>

                                            <!-- Tampilkan prestasi dalam tab kategori -->
                                            <ul class="nav nav-tabs" id="prestasiTab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="akademik-tab" data-toggle="tab"
                                                        href="#akademik" role="tab">
                                                        Prestasi Akademik
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="nonakademik-tab" data-toggle="tab"
                                                        href="#nonakademik" role="tab">
                                                        Prestasi Non-akademik
                                                    </a>
                                                </li>
                                            </ul>

                                            <div class="tab-content mt-3" id="prestasiTabContent">
                                                <!-- Tab Prestasi Akademik -->
                                                <div class="tab-pane fade show active" id="akademik" role="tabpanel">
                                                    @if (isset($prestasiAkademik) && $prestasiAkademik->count() > 0)
                                                        @foreach ($prestasiAkademik as $prestasi)
                                                            <div class="card mb-3">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-3 text-center">
                                                                            <img src="{{ asset('storage/' . $prestasi->image) }}"
                                                                                alt="Foto Prestasi"
                                                                                class="img-fluid img-thumbnail mb-3">

                                                                            <!-- Status prestasi -->
                                                                            <div class="mb-2">
                                                                                @if ($prestasi->status_berkas == '1')
                                                                                    <span
                                                                                        class="badge bg-warning text-white">Menunggu
                                                                                        Verifikasi</span>
                                                                                @elseif($prestasi->status_berkas == '2')
                                                                                    <span
                                                                                        class="badge bg-success text-white">Terverifikasi</span>
                                                                                @elseif($prestasi->status_berkas == '3')
                                                                                    <span
                                                                                        class="badge bg-danger text-white">Ditolak</span>
                                                                                @endif
                                                                            </div>

                                                                            <!-- Tombol aksi -->
                                                                            <div class="btn-group">
                                                                                <a href="{{ route('siswa.prestasi.edit', $prestasi->id) }}"
                                                                                    class="btn btn-sm btn-primary">
                                                                                    <i class="fas fa-edit"></i> Edit
                                                                                </a>
                                                                                <button type="button"
                                                                                    class="btn btn-sm btn-danger delete-prestasi"
                                                                                    data-toggle="modal"
                                                                                    data-target="#deleteModal"
                                                                                    data-id="{{ $prestasi->id }}"
                                                                                    data-nama="{{ $prestasi->nama_prestasi }}">
                                                                                    <i class="fas fa-trash"></i> Hapus
                                                                                </button>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-9">
                                                                            <div class="table-responsive">
                                                                                <table
                                                                                    class="table table-striped table-bordered align-middle">
                                                                                    <tbody class="table-light">
                                                                                        <tr>
                                                                                            <th width="30%">Nama
                                                                                                Prestasi</th>
                                                                                            <td>{{ $prestasi->nama_prestasi ?? '_' }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>Kategori</th>
                                                                                            <td>{{ $prestasi->kategori ?? '_' }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>Tingkat Prestasi</th>
                                                                                            <td>{{ $prestasi->tingkat_prestasi ?? '_' }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>Tahun Perolehan</th>
                                                                                            <td>{{ $prestasi->thn_perolehan ?? '_' }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>Perolehan</th>
                                                                                            <td>{{ $prestasi->perolehan ?? '_' }}
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="alert alert-light">
                                                            <p class="text-center mb-0">Belum ada data prestasi
                                                                akademik. Silakan tambahkan prestasi Anda.</p>
                                                        </div>
                                                    @endif
                                                </div>

                                                <!-- Tab Prestasi Non-akademik -->
                                                <div class="tab-pane fade" id="nonakademik" role="tabpanel">
                                                    @if (isset($prestasiNonAkademik) && $prestasiNonAkademik->count() > 0)
                                                        @foreach ($prestasiNonAkademik as $prestasi)
                                                            <div class="card mb-3">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-3 text-center">
                                                                            <img src="{{ asset('storage/' . $prestasi->image) }}"
                                                                                alt="Foto Prestasi"
                                                                                class="img-fluid img-thumbnail mb-3">

                                                                            <!-- Status prestasi -->
                                                                            <div class="mb-2">
                                                                                @if ($prestasi->status_berkas == '1')
                                                                                    <span
                                                                                        class="badge bg-warning text-white">Menunggu
                                                                                        Verifikasi</span>
                                                                                @elseif($prestasi->status_berkas == '2')
                                                                                    <span
                                                                                        class="badge bg-success text-white">Terverifikasi</span>
                                                                                @elseif($prestasi->status_berkas == '3')
                                                                                    <span
                                                                                        class="badge bg-danger text-white">Ditolak</span>
                                                                                @endif
                                                                            </div>

                                                                            <!-- Tombol aksi -->
                                                                            <div class="btn-group">
                                                                                <a href="{{ route('siswa.prestasi.edit', $prestasi->id) }}"
                                                                                    class="btn btn-sm btn-primary">
                                                                                    <i class="fas fa-edit"></i> Edit
                                                                                </a>
                                                                                <button type="button"
                                                                                    class="btn btn-sm btn-danger delete-prestasi"
                                                                                    data-toggle="modal"
                                                                                    data-target="#deleteModal"
                                                                                    data-id="{{ $prestasi->id }}"
                                                                                    data-nama="{{ $prestasi->nama_prestasi }}">
                                                                                    <i class="fas fa-trash"></i> Hapus
                                                                                </button>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-9">
                                                                            <div class="table-responsive">
                                                                                <table
                                                                                    class="table table-striped table-bordered align-middle">
                                                                                    <tbody class="table-light">
                                                                                        <tr>
                                                                                            <th width="30%">Nama
                                                                                                Prestasi</th>
                                                                                            <td>{{ $prestasi->nama_prestasi ?? '_' }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>Kategori</th>
                                                                                            <td>{{ $prestasi->kategori ?? '_' }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>Tingkat Prestasi</th>
                                                                                            <td>{{ $prestasi->tingkat_prestasi ?? '_' }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>Tahun Perolehan</th>
                                                                                            <td>{{ $prestasi->thn_perolehan ?? '_' }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>Perolehan</th>
                                                                                            <td>{{ $prestasi->perolehan ?? '_' }}
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="alert alert-light">
                                                            <p class="text-center mb-0">Belum ada data prestasi
                                                                non-akademik. Silakan tambahkan prestasi Anda.</p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        

                                        <!-- Modal Konfirmasi Delete -->
                                        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                                            aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah Anda yakin ingin menghapus prestasi <strong
                                                                id="prestasi-name"></strong>?</p>
                                                        <p class="text-danger">Tindakan ini tidak dapat dibatalkan!</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Batal</button>
                                                        <form id="delete-form" action="" method="POST"
                                                            style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Script untuk modal delete -->
                                        <script>
                                            $(document).ready(function() {
                                                // Setup event untuk tombol delete
                                                $('.delete-prestasi').click(function() {
                                                    const id = $(this).data('id');
                                                    const nama = $(this).data('nama');

                                                    // Set nilai di modal
                                                    $('#prestasi-name').text(nama);
                                                    $('#delete-form').attr('action', '/siswa/prestasi/delete/' + id);
                                                });
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
