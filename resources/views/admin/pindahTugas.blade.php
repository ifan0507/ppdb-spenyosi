@extends('layouts.admin.template')

@section('content')
    @include('layouts.admin.breadcrumb', [
        'title' => 'Pindah Tugas',
        'breadcrumb' => [
            'Master Data' => '',
            'Jalur Pindah Tugas' => '',
        ],
    ])
@endsection
