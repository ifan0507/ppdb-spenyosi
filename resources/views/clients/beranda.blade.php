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
                    <img src="{{ asset('assets/img/swipper1.jpg') }}" class="img-fluid" alt="Slide 1">
                    {{-- <div class="carousel-caption d-none d-md-block">
                        <h5>First slide label</h5>
                        <p>Some representative placeholder content for the first slide.</p>
                    </div> --}}
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="{{ asset('assets/img/swipper2.jpg') }}" class="img-fluid" alt="Slide 2">
                    {{-- <div class="carousel-caption d-none d-md-block">
                        <h5>Second slide label</h5>
                        <p>Some representative placeholder content for the second slide.</p>
                    </div> --}}
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/img/swipper3.jpg') }}" class="img-fluid" alt="Slide 3">
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
                    <div class="col-md-12 col-lg-9" data-aos="fade-up" data-aos-delay="100">
                        @php
                            $ext = pathinfo($info->file, PATHINFO_EXTENSION);
                            $url = asset('storage/' . $info->file);
                        @endphp
                        <div class="card shadow-sm border-0 p-3 d-flex flex-column flex-md-row align-items-center"
                            style="border-radius: 15px;">
                            <div style="width: 100%; max-width: 120px; height: 120px; overflow: hidden; border-radius: 10px;"
                                class="mb-3 mb-md-0 me-md-3 flex-shrink-0">
                                @if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                    <img src="{{ $url }}" alt="Preview Info" class="img-fluid"
                                        style="object-fit: cover; width: 100%; height: 100%;">
                                @elseif ($ext === 'pdf')
                                    <img src="{{ asset('assets/img/icons/pdf.png') }}" alt="PDF File" class="img-fluid"
                                        style="object-fit: cover; width: 100%; height: 100%;">
                                @elseif (in_array($ext, ['doc', 'docx']))
                                    <img src="{{ asset('img/icons/word-icon.png') }}" alt="Word File" class="img-fluid"
                                        style="object-fit: cover; width: 100%; height: 100%;">
                                @else
                                    <img src="{{ asset('img/icons/file-icon.png') }}" alt="File" class="img-fluid"
                                        style="object-fit: cover; width: 100%; height: 100%;">
                                @endif
                            </div>
                            <a href="">
                                <div class="flex-grow-1 text-start">
                                    <h5 class="fw-bold mb-1" style="font-family: Poppins;">{{ $info->judul }}</h5>
                                    <p class="text-muted mb-2" style="font-size: 0.9rem;">Diunggah pada
                                        {{ \Carbon\Carbon::parse($info->created_at)->translatedFormat('d F Y') }}</p>
                                    <p class="mb-0" style="font-size: 0.95rem;">{!! \Illuminate\Support\Str::limit(strip_tags($info->deskripsi), 150) !!}</p>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach

                @if ($infos->count() > $maxDisplay)
                    <div class="col-12 text-end mt-4">
                        <a href="{{ route('info.lengkap') }}" class="btn btn-link"
                            style="font-weight: bold; font-family: Poppins; text-decoration: none; color: #007bff;">
                            Info Selengkapnya...
                        </a>
                    </div>
                @endif
            </div>
        </div>


    </div>

    {{-- </section><!-- /Hero Section --> --}}
@endsection
