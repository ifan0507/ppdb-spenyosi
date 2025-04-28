@extends('layouts.clients.template')
@section('content')
    {{-- <section id="beranda" class="hero"> --}}

    {{-- <img src="assets/img/hero-bg-abstract.jpg" alt="" data-aos="fade-in" class=""> --}}

    <div class="container mt-1 mb-5">
        <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="10000">
                    <img src="{{ asset('assets/img/bg01.png') }}" class="img-fluid" alt="Slide 1">
                    {{-- <div class="carousel-caption d-none d-md-block">
                        <h5>First slide label</h5>
                        <p>Some representative placeholder content for the first slide.</p>
                    </div> --}}
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="{{ asset('assets/img/bg02.png') }}" class="img-fluid" alt="Slide 2">
                    {{-- <div class="carousel-caption d-none d-md-block">
                        <h5>Second slide label</h5>
                        <p>Some representative placeholder content for the second slide.</p>
                    </div> --}}
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/img/bg03.png') }}" class="img-fluid" alt="Slide 3">
                    {{-- <div class="carousel-caption d-none d-md-block">
                        <h5>Third slide label</h5>
                        <p>Some representative placeholder content for the third slide.</p>
                    </div> --}}
                </div>
            </div>
        </div>

        <div class="text-center mt-4 mb-8">
            <h2 class="fw-bold custom-title">Info Terkini</h2>
            <p class="custom-title">Tetap terhubung dengan berita terbaru dan pengumuman penting dari kami!</p>
        </div>

        @php
            $maxDisplay = 4;
        @endphp

        <div class="icon-box-wrapper">
            <div class="row gy-4 mt-5 justify-content-center">
                @foreach ($infos->take($maxDisplay) as $info)
                    <div class="col-md-12 col-lg-9" data-aos="zoom-out" data-aos-delay="100">
                        @php
                            $ext = pathinfo($info->file, PATHINFO_EXTENSION);
                            $url = asset('storage/' . $info->file);
                        @endphp
                        <div class="icon-box horizontal-box">
                            <div class="icon-box-img">
                                @if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                    <img src="{{ $url }}" alt="Preview Info">
                                @elseif ($ext === 'pdf')
                                    <img src="{{ asset('assets/img/icons/pdf.png') }}" alt="PDF File">
                                @elseif (in_array($ext, ['doc', 'docx']))
                                    <img src="{{ asset('img/icons/word-icon.png') }}" alt="Word File">
                                @else
                                    <img src="{{ asset('img/icons/file-icon.png') }}" alt="File">
                                @endif
                            </div>
                            <div class="icon-box-content">
                                <h4 class="title"><a href="{{ route('info.detail', $info->id) }}">{{ $info->judul }}</a>
                                </h4>
                                <p class="mb-1 text-muted">Diunggah pada
                                    {{ \Carbon\Carbon::parse($info->created_at)->translatedFormat('d F Y') }}</p>
                                <p class="description">{!! \Illuminate\Support\Str::limit(strip_tags($info->deskripsi), 200) !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
                @if ($infos->count() > $maxDisplay)
                    <div class="col-12">
                        <a href="{{ route('info.lengkap') }}">
                            <h5 style="text-align:right; margin-right: 20px; margin-top: 20px; font-style:poppins">Info
                                Selengkapnya....</h5>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- </section><!-- /Hero Section --> --}}
@endsection
