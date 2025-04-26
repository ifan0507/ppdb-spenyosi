@extends('layouts.clients.template')

@section('content')

    <div class="container mt-4">
        <h2 class="text-center mb-4">Info Selengkapnya</h2>

        @foreach ($infos as $info)
            @php
                $ext = pathinfo($info->file, PATHINFO_EXTENSION);
            @endphp
            <div class="info-box mb-4">
                <div class="info-image">
                    @if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                        <img src="{{ asset('storage/' . $info->file) }}" alt="Preview">
                    @elseif ($ext === 'pdf')
                        <img src="{{ asset('assets/img/icons/pdf.png') }}" alt="Preview"></img>
                    @elseif (in_array($ext, ['doc', 'docx']))
                        <a href="{{ asset('img/icons/word-icon.png') }}" target="_blank"
                            class="btn btn-sm btn-outline-primary">Word</a>
                    @else
                        <a href="{{ asset('storage/' . $info->file) }}" target="_blank"
                            class="btn btn-sm btn-outline-secondary">Download</a>
                    @endif
                </div>

                <a href="">
                    <div class="info-content">
                        <h6 class="mb-1 fw-semibold">{{ $info->judul }}</h6>
                        <small class="text-muted d-block mb-1">Diunggah pada
                            {{ \Carbon\Carbon::parse($info->created_at)->format('d M Y') }}</small>
                        <p class="mb-0 small text-muted">
                            {!! \Illuminate\Support\Str::limit(strip_tags($info->deskripsi), 150) !!}
                        </p>
                    </div>
                </a>
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
                        <li class="page-item"><a class="page-link" href="{{ $infos->previousPageUrl() }}">Previous</a></li>
                    @endif

                    {{-- Page Numbers --}}
                    @foreach ($infos->getUrlRange(1, $infos->lastPage()) as $page => $url)
                        @if ($page == $infos->currentPage())
                            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
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

    <style>
        .info-box {
            display: flex;
            flex-wrap: nowrap;
            gap: 12px;
            padding: 12px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background-color: #fff;
            align-items: flex-start;
        }

        .info-image {
            flex-shrink: 0;
            width: 65px;
            height: 65px;
            border-radius: 6px;
            overflow: hidden;
            background: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .info-image img,
        .info-image iframe {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .info-content {
            flex: 1;
        }

        .info-content h6 {
            font-size: 0.95rem;
            line-height: 1.3;
        }

        .info-content p {
            font-size: 0.85rem;
        }

        .info-content small {
            font-size: 0.75rem;
        }

        @media (min-width: 768px) {
            .info-image {
                width: 90px;
                height: 90px;
            }

            .info-content h6 {
                font-size: 1.05rem;
            }

            .info-content p {
                font-size: 0.9rem;
            }
        }
    </style>

@endsection
