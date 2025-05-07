@extends('layouts.clients.template')

@section('content')
    <div class="background-svg"></div>
    <div class="info-section position-relative">
        <div class="container mt-4 position-relative" style="z-index: 2;">
            <h2 class="text-center mb-4">Info Selengkapnya</h2>

            @foreach ($infos as $info)
                @php
                    $ext = pathinfo($info->file, PATHINFO_EXTENSION);
                    $url = asset('storage/' . $info->file);
                @endphp 
                <div class="info-box shadow-sm mb-4">
                    <div class="info-image">
                        @if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                            <img src="{{ $url }}" alt="Preview">
                        @elseif ($ext === 'pdf')
                            <iframe src="{{ $url }}" frameborder="0"></iframe>
                        @elseif (in_array($ext, ['doc', 'docx']))
                            <a href="{{ $url }}" target="_blank" class="btn btn-sm btn-outline-primary">Word</a>
                        @else
                            <a href="{{ $url }}" target="_blank"
                                class="btn btn-sm btn-outline-secondary">Download</a>
                        @endif
                    </div>

                    <div class="info-content">
                        <h6 class="mb-1 fw-semibold">{{ $info->judul }}</h6>
                        <small class="text-muted d-block mb-1">Diunggah pada
                            {{ \Carbon\Carbon::parse($info->created_at)->format('d M Y') }}</small>
                        <p class="mb-0 small text-muted">
                            {!! \Illuminate\Support\Str::limit(strip_tags($info->deskripsi), 150) !!}
                        </p>
                    </div>
                </div>
            @endforeach

            {{-- Pagination --}}
            @if ($infos->hasPages())
                <nav>
                    <ul class="pagination justify-content-center">
                        {{-- Previous --}}
                        @if ($infos->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">Previous</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $infos->previousPageUrl() }}">Previous</a>
                            </li>
                        @endif

                        {{-- Page Numbers --}}
                        @foreach ($infos->getUrlRange(1, $infos->lastPage()) as $page => $url)
                            @if ($page == $infos->currentPage())
                                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link"
                                        href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach

                        {{-- Next --}}
                        @if ($infos->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $infos->nextPageUrl() }}">Next</a></li>
                        @else
                            <li class="page-item disabled"><span class="page-link">Next</span></li>
                        @endif
                    </ul>
                </nav>
            @endif
        </div>

        {{-- Background SVG --}}
    </div>


    {{-- Style --}}
    <style>
    </style>

@endsection
