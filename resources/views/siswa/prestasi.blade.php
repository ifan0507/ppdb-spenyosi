@extends('layouts.siswa.template')

@section('content')
    <div class="misc-content pt-4">
        <div class="container">
            <div class="alert alert-primary">
                <i class="fas fa-check"></i>
                Jalur PPDB {{ $data->jalur->id == 4 ? 'Akademik' : ($data->jalur->id == 5 ? 'Non Akademik' : 'Lainnya') }}
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
                                            @if ($data->jalur->id == 4)
                                                @if ($data->akademik->count() <= 4)
                                                    <a href="{{ route('akademik.create') }}"
                                                        class="btn btn-primary ms-auto">
                                                        <i class="fas fa-edit"></i> Tambah Prestasi
                                                    </a>
                                                @endif
                                            @else
                                                @if ($data->nonAkademik->count() <= 4)
                                                    <a href="{{ route('non-akademik.create') }}"
                                                        class="btn btn-primary ms-auto">
                                                        <i class="fas fa-edit"></i> Tambah Prestasi
                                                    </a>
                                                @endif
                                            @endif
                                        </div>
                                        <!-- Bagian atas halaman prestasi -->
                                        <div class="card-body">
                                            <!-- Tampilkan info tentang kuota prestasi -->
                                            <div class="alert " style="background-color: #d4eefa; color: #1c759e">
                                                <p class="mb-0">
                                                    <i class="fas fa-info-circle"></i> Anda dapat menambahkan maksimal 5
                                                    prestasi
                                                </p>
                                            </div>

                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Prestasi</th>
                                                        <th>Tingkat</th>
                                                        <th>Tahun</th>
                                                        <th>Perolehan</th>
                                                        <th>Dokumen</th>
                                                        <th>Aksi</th> {{-- Kolom tambahan --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($data->jalur->id == 4)
                                                        @forelse ($data->akademik?? [] as $item)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $item->nama_prestasi }}</td>
                                                                <td>{{ $item->tingkat_prestasi }}</td>
                                                                <td>{{ $item->thn_perolehan }}</td>
                                                                <td>{{ $item->perolehan }}</td>
                                                                <td>
                                                                    <a href="{{ asset('storage/' . $item->image) }}"
                                                                        target="_blank">Lihat Dokumen</a>
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('akademik.edit', $item->id) }}"
                                                                        class="btn btn-sm btn-warning">
                                                                        Edit
                                                                    </a>
                                                                    <form
                                                                        action="{{ route('akademik.delete', $item->id) }}"
                                                                        method="POST" style="display: inline-block;"
                                                                        class="form-delete">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="btn btn-sm btn-danger btn-delete">
                                                                            Hapus
                                                                        </button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="7" class="text-center">Belum ada data
                                                                    prestasi akademik</td>
                                                            </tr>
                                                        @endforelse
                                                    @endif

                                                    @if ($data->jalur->id == 5)
                                                        @forelse ($data->nonAkademik?? [] as $item)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $item->nama_prestasi }}</td>
                                                                <td>{{ $item->tingkat_prestasi }}</td>
                                                                <td>{{ $item->thn_perolehan }}</td>
                                                                <td>{{ $item->perolehan }}</td>
                                                                <td>
                                                                    <a href="{{ asset('storage/' . $item->image) }}"
                                                                        target="_blank">Lihat Dokumen</a>
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('non-akademik.edit', $item->id) }}"
                                                                        class="btn btn-sm btn-warning">
                                                                        Edit
                                                                    </a>
                                                                    <form
                                                                        action="{{ route('non-akademik.delete', $item->id) }}"
                                                                        method="POST" style="display: inline-block;"
                                                                        class="form-delete">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="btn btn-sm btn-danger btn-delete">
                                                                            Hapus
                                                                        </button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="7" class="text-center align-middle">Belum
                                                                    ada data
                                                                    prestasi non-akademik</td>
                                                            </tr>
                                                        @endforelse
                                                    @endif
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $(".btn-delete").on("click", function(e) {
                e.preventDefault();
                Swal.fire({
                    title: "Apakah anda yakin?",
                    text: "data dihapus",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#18a342",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Hapus Data!",
                    reverseButtons: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).closest(".form-delete").submit();
                    }
                });
            });

            $(".form-delete").on("submit", function(e) {
                e.preventDefault();
                const form = $(this);
                $.ajax({
                    type: "POST",
                    url: form.attr('action'),
                    data: form.serialize(),
                    success: function(response) {
                        Swal.fire({
                            confirmButtonColor: "#18a342",
                            icon: "success",
                            title: "Berhasil!",
                            text: "Data berhasil dihapus!",
                            confirmButtonText: "OK",
                        }).then((result) => {
                            window.location.href = response.redirect
                        });
                    },
                    error: function(xhr) {
                        const mesg = xhr.responseJSON?.message ||
                            'Terjadi kesalahan, coba lagi!';
                        Swal.fire('Gagal', mesg, 'error')
                    }
                });



            });
        });
    </script>
@endsection
