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

        <div class="text-center mt-4">
            <h2 class="fw-bold custom-title">Info Terkini</h2>
            <p class="custom-title">Tetap terhubung dengan berita terbaru dan pengumuman penting dari kami!</p>
        </div>


        @foreach ($infos as $info)
            <div class="row gy-4 mt-5">
                <div class="col-md-6 col-lg-3" data-aos="zoom-out" data-aos-delay="100">

                    <h4 class="title"><a href="">{{ $info->judul }}</a></h4>
                    @if ($info->file != null)
                        <iframe src="{{ asset('storage/' . $info->file) }}" width="100%" height="600px"
                            frameborder="0"></iframe>
                    @endif
                    <p class="description">{{ $info->deskripsi }}</p>
                </div>
            </div><!--End Icon Box -->

    </div>
    @endforeach
    </div>

    {{-- </section><!-- /Hero Section --> --}}
@endsection
