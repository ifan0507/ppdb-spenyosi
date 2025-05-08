@extends('layouts.clients.template')

@section('content')
    <div class="detail-info-section py-5">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('info.lengkap') }}">Info Terkini</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $infos->judul }}</li>
                </ol>
            </nav>

            <div class="card shadow-sm border-0">
                <div class="card-body p-md-5 p-4">
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <h1 class="article-title mb-3">{{ $infos->judul }}</h1>
                            <div class="d-flex align-items-center mb-4">
                                <div class="me-3">
                                    <i class="far fa-calendar-alt text-primary"></i>
                                    <span
                                        class="ms-1">{{ \Carbon\Carbon::parse($infos->created_at)->format('d F Y') }}</span>
                                </div>
                                <div>
                                    <i class="far fa-user text-primary"></i>
                                    <span class="ms-1">Admin</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            @php
                                $ext = pathinfo($infos->file, PATHINFO_EXTENSION);
                                $url = asset('storage/' . $infos->file);
                            @endphp

                            @if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                <img src="{{ $url }}" alt="{{ $infos->judul }}"
                                    class="img-fluid rounded shadow-sm w-100" style="max-height: 300px; object-fit: cover;">
                            @endif
                        </div>
                    </div>

                    <!-- Deskripsi dengan styling untuk Quill content -->
                    <div class="article-content quill-content mb-5">
                        {!! $infos->deskripsi !!}
                    </div>

                    <!-- PDF Viewer jika file adalah PDF -->
                    @if ($ext === 'pdf')
                        <div class="pdf-container mb-5">
                            <h4 class="mb-3">Dokumen PDF</h4>
                            <div class="ratio ratio-16x9 shadow-sm" style="min-height: 600px;">
                                <iframe src="{{ $url }}" class="rounded" allowfullscreen></iframe>
                            </div>
                            <div class="text-center mt-3">
                                <a href="{{ $url }}" class="btn btn-primary" download>
                                    <i class="fas fa-download me-2"></i> Download PDF
                                </a>
                            </div>
                        </div>
                    @endif

                    <!-- File lainnya -->
                    @if (!in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'pdf']))
                        <div class="other-file-container mb-5">
                            <h4 class="mb-3">File Lampiran</h4>
                            <div class="card border-0 shadow-sm p-3">
                                <div class="d-flex align-items-center">
                                    <div class="file-icon me-3">
                                        <img src="{{ asset('img/icons/file-icon.png') }}" alt="File"
                                            style="width: 50px;">
                                    </div>
                                    <div class="file-info">
                                        <h5 class="mb-1">{{ basename($infos->file) }}</h5>
                                        <span class="text-muted">Format: {{ strtoupper($ext) }}</span>
                                    </div>
                                    <div class="ms-auto">
                                        <a href="{{ $url }}" class="btn btn-outline-primary" download>
                                            <i class="fas fa-download me-2"></i> Download
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Artikel terkait -->
                    @if (isset($relatedInfos) && count($relatedInfos) > 0)
                        <div class="related-articles mt-5">
                            <h3 class="mb-4">Artikel Terkait</h3>
                            <div class="row">
                                @foreach ($relatedInfos as $relatedInfo)
                                    <div class="col-md-4 mb-4">
                                        <div class="card h-100 shadow-sm border-0">
                                            @php
                                                $relatedExt = pathinfo($relatedInfo->file, PATHINFO_EXTENSION);
                                                $relatedUrl = asset('storage/' . $relatedInfo->file);
                                            @endphp

                                            <div style="height: 180px; overflow: hidden;">
                                                @if (in_array($relatedExt, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                                    <img src="{{ $relatedUrl }}" class="card-img-top"
                                                        alt="{{ $relatedInfo->judul }}"
                                                        style="object-fit: cover; height: 100%; width: 100%;">
                                                @elseif ($relatedExt === 'pdf')
                                                    <div
                                                        class="d-flex justify-content-center align-items-center h-100 bg-light">
                                                        <img src="{{ asset('assets/img/icons/pdf.png') }}" alt="PDF File"
                                                            style="max-height: 80px;">
                                                    </div>
                                                @else
                                                    <div
                                                        class="d-flex justify-content-center align-items-center h-100 bg-light">
                                                        <img src="{{ asset('img/icons/file-icon.png') }}" alt="File"
                                                            style="max-height: 80px;">
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="card-body">
                                                <h5 class="card-title">{{ $relatedInfo->judul }}</h5>
                                                <p class="card-text small text-muted">
                                                    {{ \Carbon\Carbon::parse($relatedInfo->created_at)->format('d F Y') }}
                                                </p>
                                                <a href="{{ route('info.detail', $relatedInfo->slug) }}"
                                                    class="btn btn-sm btn-outline-primary">Baca Selengkapnya</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Navigasi Artikel -->
            <div class="article-navigation mt-4">
                <div class="row">
                    @if (isset($prevInfo))
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('info.detail', $prevInfo->id) }}" class="text-decoration-none">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body">
                                        <span class="text-muted d-block mb-1"><i class="fas fa-arrow-left me-2"></i> Artikel
                                            Sebelumnya</span>
                                        <h5 class="mb-0">{{ $prevInfo->judul }}</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif

                    @if (isset($nextInfo))
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('info.detail', $nextInfo->id) }}" class="text-decoration-none">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body text-md-end">
                                        <span class="text-muted d-block mb-1">Artikel Selanjutnya <i
                                                class="fas fa-arrow-right ms-2"></i></span>
                                        <h5 class="mb-0">{{ $nextInfo->judul }}</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        /* Styling untuk konten Quill Editor */
        .quill-content {
            font-size: 1.05rem;
            line-height: 1.8;
            color: #333;
        }

        .quill-content h1,
        .quill-content h2,
        .quill-content h3,
        .quill-content h4,
        .quill-content h5,
        .quill-content h6 {
            margin-top: 1.5rem;
            margin-bottom: 1rem;
            font-weight: 600;
            line-height: 1.4;
        }

        .quill-content h1 {
            font-size: 2rem;
        }

        .quill-content h2 {
            font-size: 1.75rem;
        }

        .quill-content h3 {
            font-size: 1.5rem;
        }

        .quill-content p {
            margin-bottom: 1.25rem;
        }

        .quill-content ul,
        .quill-content ol {
            margin-bottom: 1.25rem;
            padding-left: 2rem;
        }

        .quill-content ul li,
        .quill-content ol li {
            margin-bottom: 0.5rem;
        }

        .quill-content blockquote {
            border-left: 4px solid #ccc;
            margin-bottom: 1.25rem;
            padding: 0.5rem 1rem;
            color: #666;
            background-color: #f8f9fa;
        }

        .quill-content img {
            max-width: 100%;
            height: auto;
            margin: 1.5rem auto;
            display: block;
            border-radius: 5px;
        }

        .quill-content a {
            color: #0d6efd;
            text-decoration: underline;
        }

        .quill-content a:hover {
            color: #0a58ca;
        }

        .quill-content table {
            width: 100%;
            margin-bottom: 1.25rem;
            border-collapse: collapse;
        }

        .quill-content table td,
        .quill-content table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .quill-content table tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .quill-content table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #f1f1f1;
            color: #333;
        }

        .quill-content pre {
            background-color: #f8f9fa;
            border-radius: 5px;
            padding: 1rem;
            margin-bottom: 1.25rem;
            overflow-x: auto;
        }

        .quill-content code {
            background-color: #f8f9fa;
            border-radius: 3px;
            padding: 2px 4px;
            font-family: monospace;
        }

        /* Responsif styling */
        @media (max-width: 767px) {
            .article-title {
                font-size: 1.75rem;
            }

            .quill-content {
                font-size: 1rem;
            }

            .quill-content h1 {
                font-size: 1.75rem;
            }

            .quill-content h2 {
                font-size: 1.5rem;
            }

            .quill-content h3 {
                font-size: 1.35rem;
            }
        }
    </style>
@endsection
