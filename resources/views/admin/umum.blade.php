@extends('layouts.admin.template')

@section('content')
    @include('layouts.admin.breadcrumb', [
        'title' => 'Jalur Umum',
        'breadcrumb' => [
            'Master Data' => '',
            'Jalur Umum' => '',
        ],
    ])
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Datatables</h5>
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>
                                        No. Pendaftaran
                                    </th>
                                    <th>Nama Lengkap</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pendaftarans as $pendaftaran)
                                    <tr>
                                        <td>{{ $pendaftaran->no_pendaftaran }}</td>
                                        <td>{{ $pendaftaran->nama_lengkap }}</td>
                                        <td>{{ $pendaftaran->status }}</td>
                                        <td>
                                            <a href="#" class="btn btn-success btn-sm">Konfirmasi</a>
                                            <a href="#" class="btn btn-danger btn-sm">Tolak</a>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-info btn-sm">Detail</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
