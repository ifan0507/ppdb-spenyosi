@extends('layouts.admin.template')

@section('content')
    @include('layouts.admin.breadcrumb')

    <section class="section">
        <div class="card">
            <div class="card-body pt-3">
                <a href="{{ route('admin.berita.form') }}" class="btn btn-primary mb-3">+ Tambah Berita</a>
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
                            {{-- @foreach () --}}
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        {{-- @if () --}}
                                            <img src="#" width="80" alt="thumb">
                                        {{-- @else --}}
                                            <span class="text-muted">Tidak ada</span>
                                        {{-- @endif --}}
                                    </td>
                                    <td>
                                        <a href="#"
                                        {{-- {{ route('admin.info.edit', $info->id) }} --}}
                                            class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                                        <form action="#" method="POST"
                                        {{-- {{ route('admin.info.destroy', $info->id) }} --}}
                                            class="d-inline">
                                            {{-- @csrf @method('DELETE') --}}
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin hapus berita ini?')"><i
                                                    class="bi bi-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            {{-- @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
