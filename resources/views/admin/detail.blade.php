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
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Bio
                                    Data</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">
                                    Orang Tua</button>
                            </li>
                            @if ($pendaftarans->register->jalur->id == '5')
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#profile-settings">Raport</button>
                                </li>
                            @endif

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">Bio Data </h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">NISN</div>
                                    <div class="col-lg-9 col-md-8">{{ $pendaftarans->register->siswa->nisn }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Nama Lengkap</div>
                                    <div class="col-lg-9 col-md-8">{{ $pendaftarans->register->siswa->nama }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">NIK</div>
                                    <div class="col-lg-9 col-md-8">{{ $pendaftarans->register->siswa->nik }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Jenis Kelamin</div>
                                    <div class="col-lg-9 col-md-8">{{ $pendaftarans->register->siswa->jenis_kelamin }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Tempat, Tanggal Lahir</div>
                                    <div class="col-lg-9 col-md-8">{{ $pendaftarans->register->siswa->tempat_lahir }}
                                        , {{ $pendaftarans->register->siswa->tanggal_lahir }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Asal Sekolah</div>
                                    <div class="col-lg-9 col-md-8">{{ $pendaftarans->register->siswa->asal_sekolah }}</div>
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
                                    <div class="col-lg-3 col-md-4 label">Titik Koordinat</div>
                                    <div class="col-lg-9 col-md-8">{{ $pendaftarans->register->siswa->lokasi }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Foto KK</div>
                                    <div class="col-lg-9 col-md-8">
                                        <img src="{{ asset('storage/' . $pendaftarans->register->siswa->foto_kk) }}"
                                            alt="Foto KK" class="img-fluid">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Foto Akte</div>
                                    <div class="col-lg-9 col-md-8">
                                        <img src="{{ asset('storage/' . $pendaftarans->register->siswa->foto_akte) }}"
                                            alt="Foto Akte" class="img-fluid">
                                    </div>
                                </div>

                                @if (
                                    $pendaftarans->register->jalur->id == '2' ||
                                        $pendaftarans->register->jalur->id == '3' ||
                                        $pendaftarans->register->jalur->id == '4')
                                    <div class="row">
                                        @if ($pendaftarans->register->jalur->id == '2')
                                            <div class="col-lg-3 col-md-4 label">KIP/KIS/PIP/PKH/SKTM</div>
                                        @elseif ($pendaftarans->register->jalur->id == '3')
                                            <div class="col-lg-3 col-md-4 label">Surat Pindah Tugas</div>
                                        @elseif ($pendaftarans->register->jalur->id == '4')
                                            <div class="col-lg-3 col-md-4 label">Piagam Prestasi</div>
                                        @endif
                                        <div class="col-lg-9 col-md-8">
                                            <img src="{{ asset('storage/' . $pendaftarans->register->document->document) }}"
                                                alt="" class="img-fluid">
                                        </div>
                                    </div>
                                @endif

                            </div>


                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
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


                            <div class="tab-pane fade pt-3" id="profile-settings">

                                <div class="card-header">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2" class="align-middle text-center">No</th>
                                                    <th rowspan="2" class="align-middle text-center">Mata
                                                        Pelajaran</th>
                                                    <th colspan="2" class="align-middle text-center">Rapor
                                                        Kelas 4</th>
                                                    <th colspan="2" class="align-middle text-center">Rapor
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

                                            <tbody>
                                                @php $no = 1; @endphp
                                                @forelse ($raports as $raport)
                                                    <tr>
                                                        <td>{{ $no++ }}</td>
                                                        <td>
                                                            {{ $raport->mapel->nama_matapelajaran }}
                                                        </td>
                                                        <td>
                                                            {{ $raport->kelas4_1 }}
                                                        </td>
                                                        <td>
                                                            {{ $raport->kelas4_2 }}
                                                        </td>
                                                        <td>
                                                            {{ $raport->kelas5_1 }}
                                                        </td>
                                                        <td>
                                                            {{ $raport->kelas5_2 }}
                                                        </td>
                                                        <td>
                                                            {{ $raport->kelas6_1 }}
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="8" class="text-center">
                                                            <p>Tidak ada data</p>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                                @if (!$raports->isEmpty())
                                                    <tr>
                                                        <td colspan="2"><strong>Rata-rata Nilai</strong></td>
                                                        <td>{{ $raports->avg('rata_kelas4_sem1') }}</td>
                                                        <td>{{ $raports->avg('rata_kelas4_sem2') }}</td>
                                                        <td>{{ $raports->avg('rata_kelas5_sem1') }}</td>
                                                        <td>{{ $raports->avg('rata_kelas5_sem2') }}</td>
                                                        <td>{{ $raports->avg('rata_kelas6_sem1') }}</td>
                                                    </tr>
                                                @endif

                                            </tbody>

                                        </table>
                                    </div>
                                </div>

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
