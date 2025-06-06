@extends('layouts.admin.template')

@section('content')
    @include('layouts.admin.breadcrumb')
    <section class="section dashboard">
        <div class="row">

            <div class="col-xxl-12 col-xl-12">
                <div class="card info-card customers-card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Download</h6>
                            </li>

                            <li><a class="dropdown-item" href="">Export Exel</a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">Total Data SPMB <span>| Semua Jalur</span></h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-people"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $pendaftarans->count() }}</h6><span class="text-muted small pt-2 ps-1">siswa</span>

                            </div>
                        </div>

                    </div>
                </div>
            </div><!-- End Customers Card -->
            <div class="row">

                <div class="col-xxl-4 col-md-4">
                    <div class="card info-card sales-card">
                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Download</h6>
                                </li>

                                <li><a class="dropdown-item" href="{{ route('exportExel', ['jalur' => 'zonasi']) }}">Export
                                        Exel</a></li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">Zonasi </h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $jumlahPerJalur[1] ?? 0 }}</h6>
                                    <span class="text-muted small pt-2 ps-1">siswa</span>
                                </div>
                            </div>

                        </div>

                    </div>
                </div><!-- End Sales Card -->
                <div class="col-xxl-4 col-md-4">
                    <div class="card info-card sales-card">

                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Download</h6>
                                </li>

                                <li><a class="dropdown-item"
                                        href="{{ route('exportExel', ['jalur' => 'afirmasi']) }}">Export Exel</a></li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">Afirmasi </h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-handshake"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $jumlahPerJalur[2] ?? 0 }}</h6>
                                    <span class="text-muted small pt-2 ps-1">siswa</span>

                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End Sales Card -->
                <div class="col-xxl-4 col-md-4">
                    <div class="card info-card sales-card">

                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Download</h6>
                                </li>

                                <li><a class="dropdown-item" href="{{ route('exportExel', ['jalur' => 'mutasi']) }}">Export
                                        Exel</a></li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">Mutasi</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-briefcase"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $jumlahPerJalur[3] ?? 0 }}</h6>
                                    <span class="text-muted small pt-2 ps-1">siswa</span>

                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End Sales Card -->
                <div class="col-xxl-4 col-md-4">
                    <div class="card info-card sales-card">

                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Download</h6>
                                </li>

                                <li><a class="dropdown-item"
                                        href="{{ route('exportExel', ['jalur' => 'akademik']) }}">Export Exel</a></li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">Lomba Aakademik </h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-trophy"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $jumlahPerJalur[4] ?? 0 }}</h6>
                                    <span class="text-muted small pt-2 ps-1">siswa</span>

                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End Sales Card -->
                <div class="col-xxl-4 col-md-4">
                    <div class="card info-card sales-card">

                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Download</h6>
                                </li>

                                <li><a class="dropdown-item"
                                        href="{{ route('exportExel', ['jalur' => 'non-akademik']) }}}">Export Exel</a>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">Lomba Non akademik </h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-trophy"></i>

                                </div>
                                <div class="ps-3">
                                    <h6>{{ $jumlahPerJalur[5] ?? 0 }}</h6>
                                    <span class="text-muted small pt-2 ps-1">siswa</span>

                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End Sales Card -->
                <div class="col-xxl-4 col-md-4">
                    <div class="card info-card sales-card">

                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                    class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Download</h6>
                                </li>

                                <li><a class="dropdown-item"
                                        href="{{ route('exportExel', ['jalur' => 'raport']) }}">Export Exel</a></li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">Prestasi Nilai Rapor </h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-medal"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $jumlahPerJalur[6] ?? 0 }}</h6>
                                    <span class="text-muted small pt-2 ps-1">siswa</span>

                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End Sales Card -->

                {{-- <div class="col-12">
                    <div class="card">

                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                    class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                </li>

                                <li><a class="dropdown-item" href="#">Today</a></li>
                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                <li><a class="dropdown-item" href="#">This Year</a></li>
                            </ul>
                        </div>



                    </div>
                </div><!-- End Reports --> --}}
            </div>
            <div class="card-body">
                <h5 class="card-title">Reports <span>/Today</span></h5>
                <!-- Line Chart -->
                <div id="reportsChart"></div>
                <!-- End Line Chart -->
            </div>

            {{-- <div class="col-lg-4">
                <!-- News & Updates Traffic -->
                <div class="card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>

                    <div class="card-body pb-0">
                        <h5 class="card-title">News &amp; Updates <span>| Today</span></h5>

                        <div class="news">
                            <div class="post-item clearfix">
                                <img src="assets/img/news-1.jpg" alt="">
                                <h4><a href="#">Nihil blanditiis at in nihil autem</a></h4>
                                <p>Sit recusandae non aspernatur laboriosam. Quia enim eligendi sed ut harum...</p>
                            </div>

                            <div class="post-item clearfix">
                                <img src="assets/img/news-2.jpg" alt="">
                                <h4><a href="#">Quidem autem et impedit</a></h4>
                                <p>Illo nemo neque maiores vitae officiis cum eum turos elan dries werona nande...</p>
                            </div>

                            <div class="post-item clearfix">
                                <img src="assets/img/news-3.jpg" alt="">
                                <h4><a href="#">Id quia et et ut maxime similique occaecati ut</a></h4>
                                <p>Fugiat voluptas vero eaque accusantium eos. Consequuntur sed ipsam et totam...</p>
                            </div>

                            <div class="post-item clearfix">
                                <img src="assets/img/news-4.jpg" alt="">
                                <h4><a href="#">Laborum corporis quo dara net para</a></h4>
                                <p>Qui enim quia optio. Eligendi aut asperiores enim repellendusvel rerum cuder...</p>
                            </div>

                            <div class="post-item clearfix">
                                <img src="assets/img/news-5.jpg" alt="">
                                <h4><a href="#">Et dolores corrupti quae illo quod dolor</a></h4>
                                <p>Odit ut eveniet modi reiciendis. Atque cupiditate libero beatae dignissimos eius...</p>
                            </div>

                        </div><!-- End sidebar recent posts-->

                    </div>
                </div><!-- End News & Updates -->
            </div> --}}
        </div>
    </section>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const labels = @json($labelsMingguan);
            const series = @json($seriesChart);

            new ApexCharts(document.querySelector("#reportsChart"), {
                chart: {
                    type: 'area',
                    height: 350,
                    toolbar: {
                        show: true,
                        tools: {
                            download: false
                        }
                    }
                },
                series: series,
                xaxis: {
                    categories: labels,
                    labels: {
                        rotate: -45,
                        style: {
                            fontSize: '12px'
                        }
                    }
                },
                markers: {
                    size: 6,
                    colors: ['#4154f1', '#2eca6a', '#ff771d', '#e91e63', '#00bcd4', '#ffc107'],
                    strokeColors: '#fff',
                    strokeWidth: 2,
                    hover: {
                        size: 8
                    }
                },
                colors: ['#4154f1', '#2eca6a', '#ff771d', '#e91e63', '#00bcd4', '#ffc107'],
                stroke: {
                    curve: 'smooth',
                    width: 2
                },
                dataLabels: {
                    enabled: false
                },
                fill: {
                    type: "gradient",
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.4,
                        opacityTo: 0.1,
                        stops: [0, 90, 100]
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + " pendaftar";
                        }
                    }
                }
            }).render();
        });
    </script>
@endsection
