@extends('layouts.admin.template')

@section('content')
    @include('layouts.admin.breadcrumb', [
        'title' => 'Jalur Tahfidz',
        'breadcrumb' => [
            'Master Data' => '',
            'Jalur Tahfidz' => '',
        ],
    ])
@endsection
