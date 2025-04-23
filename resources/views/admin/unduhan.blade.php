@extends('layouts.admin.template')

@section('content')
    @include('layouts.admin.breadcrumb')
    <div class="pagetitle">
        <h1>Manajemen Unduhan</h1>
    </div>

    <a href="" class="btn btn-primary mb-3">Tambah File</a>
    {{-- {{ route('admin.unduhan.create') }} --}}
    <div class="card">
        <div class="card-body">
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>File</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($unduhans as $unduhan) --}}
                    <tr>
                        <td></td>
                        {{-- {{ $unduhan->judul }} --}}
                        <td></td>
                        {{-- {{ $unduhan->deskripsi }} --}}
                        <td><a href="" target="_blank">Unduh</a></td>
                        {{-- {{ asset('storage/unduhan/' . $unduhan->nama_file) }} --}}
                        <td>
                            {{-- {{ route('admin.unduhan.edit', $unduhan->id) }} --}}
                            <a href="" class="btn btn-warning btn-sm">Edit</a>
                            <form action="" method="POST" {{-- {{ route('admin.unduhan.destroy', $unduhan->id) }} --}} style="display:inline">
                                {{-- @csrf @method('DELETE') --}}
                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    {{-- @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
@endsection
