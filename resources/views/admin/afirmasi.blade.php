@extends('layouts.admin.template')

@section('content')
    @include('layouts.admin.breadcrumb', [
        'title' => 'Jalur Afirmasi',
        'breadcrumb' => [
            'Master Data' => '',
            'Jalur Afirmasi' => '',
        ],
    ])
@endsection
