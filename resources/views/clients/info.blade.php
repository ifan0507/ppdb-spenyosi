@extends('layouts.clients.template')

@section('content')
    <div class="background-svg"></div>
    <div class="info-section position-relative py-4">
        <div class="container">
            <h2 class="fw-bold custom-title text-center mt-4 mb-5">Info Selengkapnya</h2>
            @foreach ($infos as $info)
                @php
                    $ext = pathinfo($info->file, PATHINFO_EXTENSION);
                    $url = asset('storage/' . $info->file);
                @endphp
                <div class="card info-card mb-4 shadow-sm border-0 overflow-hidden">
                    <div class="row g-0">
                        <div class="col-md-3 col-lg-2">
                            <div class="info-image h-100">
                                @if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                    <img src="{{ $url }}" alt="{{ $info->judul }}" class="img-fluid w-100 h-100"
                                        style="object-fit: cover; min-height: 200px;">
                                @elseif ($ext === 'pdf')
                                    <div class="d-flex justify-content-center align-items-center h-100 bg-light py-4">
                                        <img src="{{ asset('assets/img/icons/pdf.png') }}" alt="PDF File"
                                            style="max-height: 120px; max-width: 120px;">
                                    </div>
                                @else
                                    <div class="d-flex justify-content-center align-items-center h-100 bg-light py-4">
                                        <img src="{{ asset('img/icons/file-icon.png') }}" alt="File"
                                            style="max-height: 120px; max-width: 120px;">
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-9 col-lg-10">
                            <div class="card-body">
                                <a href="{{ route('info.detail', $info->slug) }}">
                                    <h3 class="card-title fw-bold mb-2">{{ $info->judul }}</h3>
                                    <p class="card-text text-muted small mb-2">
                                        Diunggah pada {{ \Carbon\Carbon::parse($info->created_at)->format('d F Y') }}
                                    </p>

                                </a>

                                <div class="card-text mb-3">
                                    {!! \Illuminate\Support\Str::limit(strip_tags($info->deskripsi), 350) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            @if ($infos->hasPages())
                <nav class="mt-4">
                    <ul class="pagination justify-content-center">
                        @if ($infos->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">Previous</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $infos->previousPageUrl() }}">Previous</a>
                            </li>
                        @endif

                        @foreach ($infos->getUrlRange(1, $infos->lastPage()) as $page => $url)
                            @if ($page == $infos->currentPage())
                                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link"
                                        href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach

                        @if ($infos->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $infos->nextPageUrl() }}">Next</a></li>
                        @else
                            <li class="page-item disabled"><span class="page-link">Next</span></li>
                        @endif
                    </ul>
                </nav>
            @endif
        </div>
    </div>
@endsection
