@extends('layouts.admin.template')

@section('content')
    @include('layouts.admin.breadcrumb', [
        'title' => 'Detail',
        'breadcrumb' => [
            'Master Data' => '',
            'Detail' => '',
        ],
    ])
    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                        <h2>Kevin Anderson</h2>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Bio
                                    Data</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">
                                    Orang Tua</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab"
                                    data-bs-target="#profile-settings">Raport</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">Bio Data </h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">NISN</div>
                                    <div class="col-lg-9 col-md-8"></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Nama Lengkap</div>
                                    <div class="col-lg-9 col-md-8"></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">NIK</div>
                                    <div class="col-lg-9 col-md-8"></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Jenis Kelamin</div>
                                    <div class="col-lg-9 col-md-8"></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Tempat, Tanggal Lahir</div>
                                    <div class="col-lg-9 col-md-8">
                                        /
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Asal Sekolah</div>
                                    <div class="col-lg-9 col-md-8"></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Kabupaten</div>
                                    <div class="col-lg-9 col-md-8"></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Kecamatan</div>
                                    <div class="col-lg-9 col-md-8"></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Desa</div>
                                    <div class="col-lg-9 col-md-8"></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Alamat</div>
                                    <div class="col-lg-9 col-md-8"></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">No. HP</div>
                                    <div class="col-lg-9 col-md-8"></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8"></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Titik Koordinat</div>
                                    <div class="col-lg-9 col-md-8">,
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Foto KK</div>
                                    <div class="col-lg-9 col-md-8">
                                        <img src="" alt="Foto KK" class="img-fluid">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Foto Akte</div>
                                    <div class="col-lg-9 col-md-8">
                                        <img src="" alt="Foto Akte" class="img-fluid">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">KIP/KIS/PIP/PKH/SKTM</div>
                                    <div class="col-lg-9 col-md-8">
                                        <img src="" alt="Dokumen KIP/KIS" class="img-fluid">
                                    </div>
                                </div>
                            </div>


                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                <h5 class="card-title">Data Orang Tua</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Nama Ayah / Wali</div>
                                    <div class="col-lg-9 col-md-8"></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Status Ayah / Wali</div>
                                    <div class="col-lg-9 col-md-8">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Pendidikan Ayah / Wali</div>
                                    <div class="col-lg-9 col-md-8">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Pekerjaan Ayah / Wali</div>
                                    <div class="col-lg-9 col-md-8">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Nama Ibu</div>
                                    <div class="col-lg-9 col-md-8"></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Status Ibu</div>
                                    <div class="col-lg-9 col-md-8">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Pendidikan Ibu</div>
                                    <div class="col-lg-9 col-md-8">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Pekerjaan Ibu</div>
                                    <div class="col-lg-9 col-md-8">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Nomor Telepon Orang Tua</div>
                                    <div class="col-lg-9 col-md-8">
                                    </div>
                                </div>
                            </div>


                            <div class="tab-pane fade pt-3" id="profile-settings">

                                <!-- Settings Form -->
                                <form>

                                    <div class="row mb-3">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email
                                            Notifications</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="changesMade" checked>
                                                <label class="form-check-label" for="changesMade">
                                                    Changes made to your account
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="newProducts" checked>
                                                <label class="form-check-label" for="newProducts">
                                                    Information on new products and services
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="proOffers">
                                                <label class="form-check-label" for="proOffers">
                                                    Marketing and promo offers
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="securityNotify"
                                                    checked disabled>
                                                <label class="form-check-label" for="securityNotify">
                                                    Security alerts
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form><!-- End settings Form -->

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
