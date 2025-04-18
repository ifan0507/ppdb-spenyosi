@extends('layouts.admin.template')

@section('content')
    @include('layouts.admin.breadcrumb', [
        'title' => 'Jalur Prestasi',
        'breadcrumb' => [
            'Master Data' => '',
            'Jalur Prestasi' => '',
        ],
    ])
@endsection
