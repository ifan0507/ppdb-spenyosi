<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    @php
        $isMasterActive = request()->routeIs(
            'zonasi',
            'afirmasi',
            'pindah.tugas',
            'akademik',
            'non-akademik',
            'raport',
        );
    @endphp

    <ul class="sidebar-nav" id="sidebar-nav">

        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dashboard-admin') ? '' : 'collapsed' }}"
                href="{{ route('dashboard-admin') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <!-- Master Data -->
        <li class="nav-item">
            <a class="nav-link {{ $isMasterActive ? '' : 'collapsed' }}" data-bs-target="#master-nav"
                data-bs-toggle="collapse" href="#">
                <i class="bi bi-collection me-2"></i>
                <span>Master Data</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="master-nav" class="nav-content collapse {{ $isMasterActive ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('zonasi') }}" class="{{ request()->routeIs('zonasi') ? 'active' : '' }}">
                        <i class="fas fa-users me-2"></i><span>Jalur Domisili Zonasi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('afirmasi') }}" class="{{ request()->routeIs('afirmasi') ? 'active' : '' }}">
                        <i class="fas fa-hand-holding-heart me-2"></i><span>Jalur Afirmasi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pindah.tugas') }}"
                        class="{{ request()->routeIs('pindah.tugas') ? 'active' : '' }}">
                        <i class="fas fa-briefcase me-2"></i><span>Jalur Pindah Tugas</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('akademik') }}" class="{{ request()->routeIs('akademik') ? 'active' : '' }}">
                        <i class="fas fa-trophy me-2"></i><span>Jalur Prestasi Akademik</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('non-akademik') }}"
                        class="{{ request()->routeIs('non-akademik') ? 'active' : '' }}">
                        <i class="fas fa-trophy me-2"></i><span>Jalur Prestasi Non Akademik</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('raport') }}" class="{{ request()->routeIs('raport') ? 'active' : '' }}">
                        <i class="fas fa-medal me-2"></i><span>Jalur Prestasi Raport</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Master Data Nav -->

        <!-- Manajemen Berita -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.info') ? '' : 'collapsed' }}"
                href="{{ route('admin.info') }}">
                <i class='bx bxs-news'></i>
                <span>Manajemen Info</span>
            </a>
        </li><!-- End Manajemen Berita Nav -->

    </ul>


</aside><!-- End Sidebar-->
