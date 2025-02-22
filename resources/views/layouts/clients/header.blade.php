<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="index.html" class="logo d-flex align-items-center me-auto">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <img src="{{ asset('assets/img/logo.png') }}" alt="logo">
            <h1 class="sitename fw-bold">SMPN 1 Yosowilangun</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ route('beranda') }}" class="active">Beranda<br></a></li>
                <li><a href="{{ route('portal') }}">Portal</a></li>
                <li><a href="#jadwal">Jadwal</a></li>
                <li><a href="#unduhan">Unduhan</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        {{-- <a class="btn-getstarted" href="#about">Get Started</a> --}}

    </div>
</header>
