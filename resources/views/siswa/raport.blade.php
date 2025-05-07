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

                                        @if (!$raports->isEmpty() && optional($raports->first())->status == '1')
                                            <div class="card-header d-flex justify-content-between align-items-center">
                                                <h4>Raport</h4>
                                                <a href="{{ route('edit-raport', ['id' => $data->id]) }}"
                                                    class="btn btn-primary ms-auto">
                                                    <i class="fas fa-edit"></i> Perbarui data rapor
                                                </a>
                                            </div>
                                        @else
                                            <div class="card-header d-flex justify-content-between align-items-center">
                                                <h4>Raport</h4>
                                                <a href="{{ route('form-raport') }}" class="btn btn-primary ms-auto">
                                                    <i class="fa-solid fa-square-plus"></i> Tambah data rapor
                                                </a>
                                            </div>
                                        @endif

                                        <div class="card-body">
                                            <div class="alert " style="background-color: #d4eefa; color: #1c759e">
                                                <p class="mb-0">
                                                    <i class="fas fa-info-circle"></i> Harap lengkapi data rapor terlebih
                                                    dahulu, kemudian unduh hasil input untuk dicetak dan ditandatangani oleh
                                                    Kepala Sekolah SD. Setelah ditandatangani, dokumen tersebut wajib
                                                    diunggah kembali ke sistem.
                                                </p>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-8 col-lg-4">

                                                    <div class="border m-3 py-1 px-2 text-center" id="photo-box">
                                                        <label for="pribadi_blob" class="form-label">
                                                            Document Raport <span style="color:#e3342f">*</span><br />
                                                            <b>(format: JPG/JPEG maks. 1MB)</b>
                                                        </label>

                                                        <img id="img-raport_blob"
                                                            src="{{ $data->rata_rata_raport?->image ? asset('storage/' . $data->rata_rata_raport?->image) : asset('assets/img/default_document.png') }}"
                                                            class="img-fluid rounded border mb-2" style="max-width: 100%;">

                                                        <label for="raport_blob" class="btn btn-primary w-100">
                                                            <i class="fas fa-folder-open"></i>
                                                            @if ($data->rata_rata_raport?->image === null)
                                                                Pilih Foto Dokumen
                                                            @else
                                                                Perbarui Foto Dokumen
                                                            @endif
                                                        </label>
                                                        <input type="file" id="raport_blob" name="image" class="d-none"
                                                            accept="image/jpeg">
                                                        <div id="info-raport_blob" class="text-muted mt-2"
                                                            style="display:none;"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-rapor">
                                                            <thead>
                                                                <tr>
                                                                    <th rowspan="2" class="align-middle text-center">No
                                                                    </th>
                                                                    <th rowspan="2" class="align-middle text-center">Mata
                                                                        Pelajaran</th>
                                                                    <th colspan="2" class="align-middle text-center">
                                                                        Rapor
                                                                        Kelas 4</th>
                                                                    <th colspan="2" class="align-middle text-center">
                                                                        Rapor
                                                                        Kelas 5</th>
                                                                    <th class="align-middle text-center">Rapor Kelas 6</th>

                                                                </tr>
                                                                <tr>
                                                                    <th class="align-middle text-center">Semester 1</th>
                                                                    <th class="align-middle text-center">Semester 2</th>
                                                                    <th class="align-middle text-center">Semester 1</th>
                                                                    <th class="align-middle text-center">Semester 2</th>
                                                                    <th class="align-middle text-center">Semester 1</th>
                                                            </thead>

                                                            @if ($raports->isNotEmpty())
                                                                <tbody>
                                                                    @php
                                                                        $indexA = 1;
                                                                        $indexB = 7;
                                                                    @endphp
                                                                    <tr>
                                                                        <td colspan="8" class="kelompok-header">
                                                                            <strong>Kelompok A</strong>
                                                                        </td>
                                                                    </tr>
                                                                    @foreach ($raports as $raport)
                                                                        @if (in_array($raport->mapel->nama_matapelajaran, [
                                                                                'Pendidikan Agama',
                                                                                'Pendidikan Pancasila & Kewarganegaraan',
                                                                                'Bahasa Indonesia',
                                                                                'Matematika',
                                                                                'Ilmu Pengetahuan Alam (IPA)',
                                                                                'Ilmu Pengetahuan Sosial (IPS)',
                                                                            ]))
                                                                            <tr>
                                                                                <td>{{ $indexA++ }}.</td>
                                                                                <td>{{ $raport->mapel->nama_matapelajaran }}
                                                                                </td>
                                                                                <td>{{ $raport->kelas4_1 }}</td>
                                                                                <td>{{ $raport->kelas4_2 }}</td>
                                                                                <td>{{ $raport->kelas5_1 }}</td>
                                                                                <td>{{ $raport->kelas5_2 }}</td>
                                                                                <td>{{ $raport->kelas6_1 }}</td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach

                                                                    <tr>
                                                                        <td colspan="8" class="kelompok-header">
                                                                            <strong>Kelompok B</strong>
                                                                        </td>
                                                                    </tr>
                                                                    @foreach ($raports as $raport)
                                                                        @if (in_array($raport->mapel->nama_matapelajaran, ['Seni Budaya dan Prakarya', 'Pend. Jasmani, Olahraga dan Kesehatan']))
                                                                            <tr>
                                                                                <td>{{ $indexB++ }}.</td>
                                                                                <td>{{ $raport->mapel->nama_matapelajaran }}
                                                                                </td>
                                                                                <td>{{ $raport->kelas4_1 }}</td>
                                                                                <td>{{ $raport->kelas4_2 }}</td>
                                                                                <td>{{ $raport->kelas5_1 }}</td>
                                                                                <td>{{ $raport->kelas5_2 }}</td>
                                                                                <td>{{ $raport->kelas6_1 }}</td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach

                                                                    @php
                                                                        $bahasaJawa = $raports->firstWhere(
                                                                            'mapel.nama_matapelajaran',
                                                                            'Bahasa Jawa',
                                                                        );
                                                                    @endphp
                                                                    @if ($bahasaJawa)
                                                                        <tr>
                                                                            <td rowspan="2">{{ $indexB++ }}.</td>
                                                                            <td colspan="7" class="text-left"><b>Muatan
                                                                                    Lokal</b></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>{{ $bahasaJawa->mapel->nama_matapelajaran }}
                                                                            </td>
                                                                            <td>{{ $bahasaJawa->kelas4_1 }}</td>
                                                                            <td>{{ $bahasaJawa->kelas4_2 }}</td>
                                                                            <td>{{ $bahasaJawa->kelas5_1 }}</td>
                                                                            <td>{{ $bahasaJawa->kelas5_2 }}</td>
                                                                            <td>{{ $bahasaJawa->kelas6_1 }}</td>
                                                                        </tr>
                                                                    @endif
                                                                    @if (!$raports->isEmpty())
                                                                        <tr>
                                                                            <td colspan="2"><strong>Rata-rata
                                                                                    Nilai</strong>
                                                                            </td>
                                                                            <td>{{ $raports->avg('rata_kelas4_sem1') }}
                                                                            </td>
                                                                            <td>{{ $raports->avg('rata_kelas4_sem2') }}
                                                                            </td>
                                                                            <td>{{ $raports->avg('rata_kelas5_sem1') }}
                                                                            </td>
                                                                            <td>{{ $raports->avg('rata_kelas5_sem2') }}
                                                                            </td>
                                                                            <td>{{ $raports->avg('rata_kelas6_sem1') }}
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                </tbody>
                                                            @else
                                                                <tbody>
                                                                    <tr>
                                                                        <td colspan="8">Tidak ada data</td>
                                                                    </tr>
                                                                </tbody>
                                                            @endif
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($raports->isNotEmpty())
                                                <div class="row justify-content-end">
                                                    <div class="col-sm-8 col-lg-8">
                                                        <a href="{{ route('exportPdf') }}"
                                                            class="btn btn-primary btn-block"><i
                                                                class="fa-solid fa-file-arrow-down"></i>
                                                            Download Raport
                                                        </a>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#raport_blob').on('change', function() {
                const file = this.files[0];

                if (!file) return;

                if (file.type !== 'image/jpeg' && file.type !== 'image/jpg') {
                    Swal.fire('Error!', 'File harus berformat JPG/JPEG.', 'error');
                    return;
                }

                if (file.size > 1024 * 1024) {
                    Swal.fire('Error!', 'Ukuran file maksimal 1MB.', 'error');
                    return;
                }

                const formData = new FormData();
                formData.append('image', file);
                formData.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    url: '/raport/upload-document',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        Swal.fire({
                            title: 'Mengupload...',
                            text: 'Silakan tunggu',
                            didOpen: () => {
                                Swal.showLoading();
                            },
                            allowOutsideClick: false
                        });
                    },
                    success: function(res) {
                        Swal.fire('Sukses!', 'Dokumen berhasil diupload.', 'success');
                        $('#img-raport_blob').attr('src', res.preview_url);
                    },
                    error: function(xhr) {
                        const msg = xhr.responseJSON?.message ||
                            'Terjadi kesalahan saat upload.';
                        Swal.fire('Gagal!', msg, 'error');
                    }
                });
            });
        });
    </script>
@endsection
