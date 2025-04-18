@extends('layouts.admin.template')

@section('content')
    @include('layouts.admin.breadcrumb', [
        'title' => 'Dashboard',
        'breadcrumb' => [
            'Beranda' => '',
        ],
    ])
@endsection
