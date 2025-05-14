@extends('layouts.admin.template')

@section('content')
    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="{{ asset('storage/' . $pendaftarans->register->siswa->foto_siswa) }}" alt="Profile"
                            class="rounded-circle">
                        <h2>{{ $pendaftarans->register->siswa->nama }}</h2>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered d-flex  flex-nowrap"
                            style="white-space: nowrap; overflow-y: hidden;">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Bio
                                    Data</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">
                                    Orang Tua</button>
                            </li>
                            @if ($pendaftarans->register->jalur->id == '2')
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#afirmasi">Dokumen
                                        Afirmasi</button>
                                </li>
                            @endif
                            @if ($pendaftarans->register->jalur->id == '3')
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#mutasi">Dokumen Pindah
                                        Tugas</button>
                                </li>
                            @endif
                            @if ($pendaftarans->register->jalur->id == '4')
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#prestasiAkademik">Dokumen
                                        Prestasi Akademik</button>
                                </li>
                            @endif
                            @if ($pendaftarans->register->jalur->id == '5')
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#prestasiNonAkademik">Dokumen
                                        Prestasi Nonakademik</button>
                                </li>
                            @endif
                            @if ($pendaftarans->register->jalur->id == '6')
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#raport">Rapor</button>
                                </li>
                            @endif

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#document">Dokumen</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">Bio Data </h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Nomor Induk Siswa Nasional (NISN)</div>
                                    <div class="col-lg-9 col-md-8">{{ $pendaftarans->register->siswa->nisn }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Nomor Induk Kependudukan (NIK)</div>
                                    <div class="col-lg-9 col-md-8">{{ $pendaftarans->register->siswa->nik }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Nomor KK</div>
                                    <div class="col-lg-9 col-md-8">{{ $pendaftarans->register->siswa->nik }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Nama Lengkap</div>
                                    <div class="col-lg-9 col-md-8">{{ $pendaftarans->register->siswa->nama }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Jenis Kelamin</div>
                                    <div class="col-lg-9 col-md-8">{{ $pendaftarans->register->siswa->jenis_kelamin }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Tempat, Tanggal Lahir</div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $pendaftarans->register->siswa->tempat_lahir }},
                                        {{ \Carbon\Carbon::parse($pendaftarans->register->siswa->tanggal_lahir)->format('d-m-Y') }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Kabupaten</div>
                                    <div class="col-lg-9 col-md-8">{{ $pendaftarans->register->siswa->kabupaten }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Kecamatan</div>
                                    <div class="col-lg-9 col-md-8">{{ $pendaftarans->register->siswa->kecamatan }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Desa</div>
                                    <div class="col-lg-9 col-md-8">{{ $pendaftarans->register->siswa->desa }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">RT/RW</div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $pendaftarans->register->siswa->rt . '/' . $pendaftarans->register->siswa->rw }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Alamat</div>
                                    <div class="col-lg-9 col-md-8">{{ $pendaftarans->register->siswa->alamat }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">No. HP</div>
                                    <div class="col-lg-9 col-md-8">{{ $pendaftarans->register->siswa->no_hp }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">{{ $pendaftarans->register->siswa->email }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Asal Sekolah</div>
                                    <div class="col-lg-9 col-md-8">{{ $pendaftarans->register->siswa->asal_sekolah }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Titik Koordinat Rumah</div>
                                    <div class="col-lg-9 col-md-8"> <a style="text-decoration: underline"
                                            href="https://www.google.com/maps?q={{ $pendaftarans->register->siswa->lokasi }}"
                                            target="_blank">
                                            {{ $pendaftarans->register->siswa->lokasi }}
                                        </a>
                                    </div>
                                </div>

                            </div>


                            <div class="tab-pane fade ortu pt-3 ortu profile-edit" id="profile-edit">
                                <h5 class="card-title">Data Orang Tua</h5>

                                <div class="row mb-3">
                                    <label for="fullName" class="col-md-4 col-lg-3">Nama Ayah / Wali</label>
                                    <div class="col-lg-9 col-md-8">{{ $pendaftarans->register->siswa->ortu->ayah }}</div>
                                </div>
                                <div class="row mb-3">
                                    <label for="fullName" class="col-md-4 col-lg-3">Status Ayah / Wali</label>
                                    <div class="col-lg-9 col-md-8">{{ $pendaftarans->register->siswa->ortu->status_ayah }}
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="fullName" class="col-md-4 col-lg-3">Status Hubungan</label>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $pendaftarans->register->siswa->ortu->status_hubungan }}
                                    </div>
                                </div>
                                @if ($pendaftarans->register->siswa->ortu->status_hubungan === 'Wali')
                                    <div class="row mb-3">
                                        <label for="fullName" class="col-md-4 col-lg-3">Hubungan Wali</label>
                                        <div class="col-lg-9 col-md-8">
                                            {{ $pendaftarans->register->siswa->ortu->hubungan_wali }}
                                        </div>
                                    </div>
                                @endif
                                <div class="row mb-3">
                                    <label for="fullName" class="col-md-4 col-lg-3">Pendidikan Ayah / Wali</label>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $pendaftarans->register->siswa->ortu->pendidikan_ayah }}
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="fullName" class="col-md-4 col-lg-3">Pekerjaan Ayah / Wali</label>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $pendaftarans->register->siswa->ortu->pekerjaan_ayah }}
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="fullName" class="col-md-4 col-lg-3">Nama Ibu</label>
                                    <div class="col-lg-9 col-md-8">{{ $pendaftarans->register->siswa->ortu->ibu }}</div>
                                </div>
                                <div class="row mb-3">
                                    <label for="fullName" class="col-md-4 col-lg-3">Status Ibu</label>
                                    <div class="col-lg-9 col-md-8">{{ $pendaftarans->register->siswa->ortu->status_ibu }}
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="fullName" class="col-md-4 col-lg-3">Pendidikan Ibu</label>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $pendaftarans->register->siswa->ortu->pendidikan_ibu }}
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="fullName" class="col-md-4 col-lg-3">Pekerjaan Ibu</label>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $pendaftarans->register->siswa->ortu->pekerjaan_ibu }}
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="fullName" class="col-md-4 col-lg-3">Nomer Telp Orang Tua</label>
                                    <div class="col-lg-9 col-md-8">{{ $pendaftarans->register->siswa->ortu->no_hp }}
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade profile-overview" id="afirmasi">
                                <h5 class="card-title">Dokumen Afirmasi</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Jenis Afirmasi</div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $pendaftarans->register->afirmasi?->jenis_afirmasi }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Dokumen Afirmasi</div>
                                    <div class="col-lg-9 col-md-8">
                                        <img src="{{ asset('storage/' . $pendaftarans->register->afirmasi?->image) }}"
                                            alt="Dokumen Afirmasi" class="img-fluid"
                                            style="height: 200px; width: 200px;object-fit: cover;">
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade profile-overview" id="mutasi">
                                <h5 class="card-title">Dokumen Pindah Tugas</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Asal Tugas</div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $pendaftarans->register->mutasi?->asal_tugas }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Tahun Pindah</div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $pendaftarans->register->mutasi?->thn_pindah }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Dokumen Pindah Tugas</div>
                                    <div class="col-lg-9 col-md-8">
                                        <img src="{{ asset('storage/' . $pendaftarans->register->mutasi?->image) }}"
                                            alt="Dokumen Mutasi" class="img-fluid"
                                            style="height: 200px; width: 200px;object-fit: cover;">
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade pt-3 profile-overview" id="prestasiAkademik">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Name Kegiatan</th>
                                                <th scope="col">Tingkat</th>
                                                <th scope="col">Tahun Perolehan</th>
                                                <th scope="col">Pencapaian</th>
                                                <th scope="col">Dokumen Pendukung</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($pendaftarans->register->akademik->isNotEmpty())
                                                @forelse ($pendaftarans->register->akademik as $item)
                                                    <tr>
                                                        <th scope="row">{{ $loop->iteration }}</th>
                                                        <td>{{ $item->nama_prestasi }}</td>
                                                        <td>{{ $item->tingkat_prestasi }}</td>
                                                        <td>{{ $item->thn_perolehan }}</td>
                                                        <td>{{ $item->perolehan }}</td>
                                                        <td>
                                                            <a href="#" data-bs-toggle="modal"
                                                                data-bs-target="#previewImg"
                                                                data-img-url="{{ asset('storage/' . $item->image) }}"
                                                                data-judul="{{ $item->nama_prestasi }}">
                                                                Lihat dokumen
                                                            </a>
                                                        </td>

                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="7" class="text-center align-middle">Belum
                                                            ada data
                                                            prestasi akademik</td>
                                                    </tr>
                                                @endforelse
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade  profile-overview" id="prestasiNonAkademik">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Name Kegiatan</th>
                                                <th scope="col">Tingkat</th>
                                                <th scope="col">Tahun Perolehan</th>
                                                <th scope="col">Pencapaian</th>
                                                <th scope="col">Dokumen Pendukung</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($pendaftarans->register->nonAkademik->isNotEmpty())
                                                @forelse ($pendaftarans->register->nonAkademik as $item)
                                                    <tr>
                                                        <th scope="row">{{ $loop->iteration }}</th>
                                                        <td>{{ $item->nama_prestasi }}</td>
                                                        <td>{{ $item->tingkat_prestasi }}</td>
                                                        <td>{{ $item->thn_perolehan }}</td>
                                                        <td>{{ $item->perolehan }}</td>
                                                        <td> <a href="#" data-bs-toggle="modal"
                                                                data-bs-target="#previewImg"
                                                                data-img-url="{{ asset('storage/' . $item->image) }}"
                                                                data-judul="{{ $item->nama_prestasi }}">
                                                                Lihat dokumen
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="7" class="text-center align-middle">Belum
                                                            ada data
                                                            prestasi nonakademik</td>
                                                    </tr>
                                                @endforelse
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade pt-3" id="raport">
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
                                <div class="card mt-4 p-2 text-center justify-items-center">
                                    <h6 class="card-title">Dokumen Rapor</h6>
                                    <img id="img-raport_blob"
                                        src="{{ asset('storage/' . $pendaftarans->register->rata_rata_raport?->image) }}"
                                        class="img-fluid rounded border mb-2 mx-auto d-block"
                                        style="width: auto; height: 500px; object-fit: cover;">
                                </div>

                            </div>

                            <div class="tab-pane fade" id="document">
                                <div class="flash-data" data-flashdata="{{ session('status') }}"></div>
                                <div class="card mt-4 p-2 text-center">
                                    <h6 class="card-title">Dokumen Identitas Siswa</h6>
                                    <div class="row g-4">
                                        <div class="col-xxl-4 col-md-4">
                                            <div class="card info-card sales-card position-relative">
                                                <div class="position-absolute top-0 end-0 mt-2 me-3">
                                                    <div class="dropdown">
                                                        <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                                                class="bi bi-three-dots"></i></a>
                                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('downloadDocument', ['id' => $pendaftarans->id, 'tipe' => 'foto']) }}">Download
                                                                    File</a></li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="card-body  text-center" style="min-height: 250px;">
                                                    <h5 class="card-title">Foto Siswa</h5>
                                                    <div
                                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                        <a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#previewImg"
                                                            data-img-url="{{ asset('storage/' . $pendaftarans->register->siswa->foto_siswa) }}"
                                                            data-judul="{{ $pendaftarans->register->siswa->nama }}">
                                                            <img src="{{ asset('storage/' . $pendaftarans->register->siswa->foto_siswa) }}"
                                                                class="img-fluid rounded border mb-2"
                                                                style="width: auto; height: 150px; object-fit: cover;"></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xxl-4 col-md-4">
                                            <div class="card info-card sales-card position-relative">
                                                <!-- Filter button in top-right -->
                                                <div class="position-absolute top-0 end-0 mt-2 me-3">
                                                    <div class="dropdown">
                                                        <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                                                class="bi bi-three-dots"></i></a>
                                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('downloadDocument', ['id' => $pendaftarans->id, 'tipe' => 'kk']) }}">Download
                                                                    File</a></li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="card-body text-center" style="min-height: 250px;">
                                                    <h5 class="card-title">Kartu Keluarga</h5>
                                                    <div
                                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                        <a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#previewImg"
                                                            data-img-url="{{ asset('storage/' . $pendaftarans->register->siswa->foto_kk) }}"
                                                            data-judul="Dokumen Kartu Keluarga">
                                                            <img src="{{ asset('storage/' . $pendaftarans->register->siswa->foto_kk) }}"
                                                                class="img-fluid rounded border mb-2"
                                                                style="width: auto; height: 150px; object-fit: cover;"></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-md-4">
                                            <div class="card info-card sales-card position-relative">
                                                <!-- Filter button in top-right -->
                                                <div class="position-absolute top-0 end-0 mt-2 me-3">
                                                    <div class="dropdown">
                                                        <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                                                class="bi bi-three-dots"></i></a>
                                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('downloadDocument', ['id' => $pendaftarans->id, 'tipe' => 'akte']) }}">Download
                                                                    File</a></li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="card-body text-center" style="min-height: 250px;">
                                                    <h5 class="card-title">Akte Kelahiran</h5>
                                                    <div
                                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                        <a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#previewImg"
                                                            data-img-url="{{ asset('storage/' . $pendaftarans->register->siswa->foto_akte) }}"
                                                            data-judul="Dokumen Akte Kelahiran">
                                                            <img src="{{ asset('storage/' . $pendaftarans->register->siswa->foto_akte) }}"
                                                                class="img-fluid rounded border mb-2"
                                                                style="width: auto; height: 150px; object-fit: cover;"></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if ($pendaftarans->register->jalur->id != '1' && $pendaftarans->register->jalur->id != '3')
                                    <div class="card mt-4 p-2 text-center">
                                        <h6 class="card-title">Dokumen Penunjang Jalur
                                            {{ $pendaftarans->register->jalur->nama_jalur }}</h6>
                                        <div class="row g-4">
                                            @if ($pendaftarans->register->jalur->id == '2' || $pendaftarans->register->jalur->id == '6')
                                                <div class="col-xxl-4 col-md-4">
                                                    <div class="card info-card sales-card position-relative">
                                                        <div class="position-absolute top-0 end-0 mt-2 me-3">
                                                            <div class="dropdown">
                                                                <a class="icon" href="#"
                                                                    data-bs-toggle="dropdown"><i
                                                                        class="bi bi-three-dots"></i></a>
                                                                <ul
                                                                    class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                                    <li><a class="dropdown-item"
                                                                            @if ($pendaftarans->register->jalur->id == '2') href="{{ route('downloadDocumentAfirmasi', ['id' => $pendaftarans->id]) }}"
                                                        @elseif($pendaftarans->register->jalur->id == '6')
                                                            href="{{ route('downloadRapor', ['id' => $pendaftarans->id]) }}" @endif>Download
                                                                            File</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="card-body text-center p-2" style="min-height: 250px;">
                                                            <h5 class="card-title">
                                                                @if ($pendaftarans->register->jalur->id == '2')
                                                                    Dokumen Afirmasi
                                                                    {{ $pendaftarans->register->afirmasi->jenis_afirmasi }}
                                                                @elseif($pendaftarans->register->jalur->id == '6')
                                                                    Dokumen Rapor
                                                                @endif
                                                            </h5>
                                                            <div
                                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                                @if ($pendaftarans->register->jalur->id == '2')
                                                                    <a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#previewImg"
                                                                        data-img-url="{{ asset('storage/' . $pendaftarans->register->afirmasi?->image) }}"
                                                                        data-judul="Dokumen Afirmasi {{ $pendaftarans->register->afirmasi->jenis_afirmasi }}">
                                                                        <img src="{{ asset('storage/' . $pendaftarans->register->afirmasi?->image) }}"
                                                                            class="img-fluid rounded border mb-2"
                                                                            style="width: auto; height: 150px; object-fit: cover;"></a>
                                                                @elseif ($pendaftarans->register->jalur->id == '6')
                                                                    <a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#previewImg"
                                                                        data-img-url="{{ asset('storage/' . $pendaftarans->register->rata_rata_raport?->image) }}"
                                                                        data-judul="Dokumen Rapor">
                                                                        <img src="{{ asset('storage/' . $pendaftarans->register->rata_rata_raport?->image) }}"
                                                                            class="img-fluid rounded border mb-2"
                                                                            style="width: auto; height: 150px; object-fit: cover;"></a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif ($pendaftarans->register->jalur->id == '4' || $pendaftarans->register->jalur->id == '5')
                                                @if ($pendaftarans->register->jalur->id == '4' && $pendaftarans->register->akademik->isNotEmpty())
                                                    @foreach ($pendaftarans->register->akademik->take(5) as $item)
                                                        <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6">
                                                            <div class="card info-card sales-card position-relative h-100">
                                                                <div class="position-absolute top-0 end-0 mt-2 me-3">
                                                                    <div class="dropdown">
                                                                        <a class="icon" href="#"
                                                                            data-bs-toggle="dropdown">
                                                                            <i class="bi bi-three-dots"></i>
                                                                        </a>
                                                                        <ul
                                                                            class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                                            <li><a class="dropdown-item"
                                                                                    href="{{ route('downloadAkademik', ['id' => $pendaftarans->id]) }}">Download
                                                                                    File</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>

                                                                <div class="card-body text-center p-2"
                                                                    style="min-height: 250px;">
                                                                    <h6 class="card-title mb-3">
                                                                        {{ $item->nama_prestasi }}
                                                                    </h6>
                                                                    <div class="d-flex justify-content-center">
                                                                        <a href="#" data-bs-toggle="modal"
                                                                            data-bs-target="#previewImg"
                                                                            data-img-url="{{ asset('storage/' . $item->image) }}"
                                                                            data-judul="{{ $item->nama_prestasi }}">
                                                                            <img src="{{ asset('storage/' . $item->image) }}"
                                                                                class="img-fluid rounded border mb-2"
                                                                                style="width: auto; height: 150px; object-fit: cover;"></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @elseif ($pendaftarans->register->jalur->id == '5' && $pendaftarans->register->nonAkademik->isNotEmpty())
                                                    @foreach ($pendaftarans->register->nonAkademik->take(5) as $item)
                                                        <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6">
                                                            <div class="card info-card sales-card position-relative h-100">

                                                                <div class="position-absolute top-0 end-0 mt-2 me-3">
                                                                    <div class="dropdown">
                                                                        <a class="icon" href="#"
                                                                            data-bs-toggle="dropdown">
                                                                            <i class="bi bi-three-dots"></i>
                                                                        </a>
                                                                        <ul
                                                                            class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                                            <li><a class="dropdown-item"
                                                                                    href="{{ route('downloadNonAkademik', ['id' => $pendaftarans->id]) }}">Download
                                                                                    File</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>

                                                                <div class="card-body text-center p-2"
                                                                    style="min-height: 250px;">
                                                                    <h6 class="card-title mb-3">
                                                                        {{ $item->nama_prestasi }}
                                                                    </h6>
                                                                    <div class="d-flex justify-content-center">
                                                                        <a href="#" data-bs-toggle="modal"
                                                                            data-bs-target="#previewImg"
                                                                            data-img-url="{{ asset('storage/' . $item->image) }}"
                                                                            data-judul="{{ $item->nama_prestasi }}">
                                                                            <img src="{{ asset('storage/' . $item->image) }}"
                                                                                class="img-fluid rounded border mb-2"
                                                                                style="width: auto; height: 150px; object-fit: cover;"></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>

                    </div>
                </div><!-- End Bordered Tabs -->
            </div>
        </div>



        <div class="modal fade" id="previewImg" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalJudul">Preview Dokumen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img id="modalImgPreview" src="" class="img-fluid rounded" style="max-height: 500px;">
                    </div>
                </div>
            </div>
        </div>



    </section>
    <script>
        $(document).ready(function() {
            const flashData = $(".flash-data").data("flashdata");
            if (flashData) {
                Swal.fire({
                    title: "Opps..",
                    text: flashData,
                    icon: "error",
                });
            }


            $('#previewImg').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var imgUrl = button.data('img-url');
                var judul = button.data('judul');

                $('#modalImgPreview').attr('src', imgUrl);
                $('#modalJudul').text(judul);
            });
        });
    </script>
@endsection
