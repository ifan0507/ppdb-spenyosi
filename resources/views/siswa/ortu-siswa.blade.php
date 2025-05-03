@extends('layouts.siswa.template')
@section('content')
    <style>
        table {
            width: 100%;
            /* Pastikan tabel penuh dalam card */
            border-collapse: collapse;
            /* Hilangkan jarak antar sel */
        }

        th,
        td {
            padding: 10px 15px;
            /* Kurangi padding agar lebih rapat */
            border-bottom: 1px solid #dee2e6;
            /* Tambahkan garis pemisah */
        }

        th {
            font-weight: 600;
            /* Tidak terlalu tebal */
            color: #333;
            /* Warna sedikit lebih lembut dari hitam */
            background-color: #f8f9fa;
            /* Warna latar belakang abu-abu sangat terang */
            text-align: left;
            /* Pastikan teks rata kiri */
            width: 30%;
            /* Atur agar th tidak terlalu panjang */
        }

        td {
            color: #555;
            background-color: #f8f9fa;
            /* Sama dengan th agar selaras */
            width: 70%;
            /* Pastikan td tidak terlalu melebar */
        }
    </style>
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
                                            <h4>Data Orang Tua</h4>
                                            <a href="{{ route('ortu.edit', ['id' => $data->siswa->ortu->id]) }}"
                                                class="btn btn-primary ms-auto">
                                                <i class="fas fa-edit"></i> Perbarui Data Orang Tua
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered">
                                                    <tbody class="table-light">
                                                        <tr>
                                                            <th>Nama Ayah / Wali</th>
                                                            <td>{{ $data->siswa->ortu->ayah ?? '_' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Status Ayah / Wali</th>
                                                            <td>{{ $data->siswa->ortu->status_ayah ?? '_' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Status Hubungan</th>
                                                            <td>{{ $data->siswa->ortu->status_hubungan ?? '_' }}</td>
                                                        </tr>
                                                        @if ($data->siswa->ortu->status_hubungan === 'Wali')
                                                            <tr>
                                                                <th>Hubungan Wali</th>
                                                                <td>{{ $data->siswa->ortu->hubungan_wali ?? '-' }}</td>
                                                            </tr>
                                                        @endif
                                                        <tr>
                                                            <th>Pendidikan Ayah / Wali</th>
                                                            <td>{{ $data->siswa->ortu->pendidikan_ayah ?? '_' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Pekerjaan Ayah / Wali</th>
                                                            <td>{{ $data->siswa->ortu->pekerjaan_ayah ?? '_' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Nama Ibu</th>
                                                            <td>{{ $data->siswa->ortu->ibu ?? '_' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Status Ibu</th>
                                                            <td>{{ $data->siswa->ortu->status_ibu ?? '_' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Pendidikan Ibu</th>
                                                            <td>{{ $data->siswa->ortu->pendidikan_ibu ?? '_' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Pekerjaan Ibu</th>
                                                            <td>{{ $data->siswa->ortu->pekerjaan_ibu ?? '_' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Nomor Telepon Orang Tua</th>
                                                            <td>{{ $data->siswa->ortu->no_hp ?? '_' }}</td>
                                                        </tr>
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
    </div>
@endsection
