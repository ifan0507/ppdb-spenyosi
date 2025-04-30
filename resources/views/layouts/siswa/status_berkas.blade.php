<div class="card-header" id="headingOne">
    <h5 class="row justify-content-between">
        <div class="col-8 pt-lg-2">
            <h4 class="font-weight" style="display: inline-block;">
                Status Kelengkapan Berkas
            </h4>
            @if (
                ($data->jalur->id == '2' &&
                    $data->siswa->status_berkas == '1' &&
                    $data->siswa->ortu->status_berkas == '1' &&
                    $data->afirmasi?->status_berkas == '1') ||
                    ($data->jalur->id == '3' &&
                        $data->siswa->status_berkas == '1' &&
                        $data->siswa->ortu->status_berkas == '1' &&
                        $data->mutasi?->status_berkas == '1') ||
                    ($data->jalur->id == '4' &&
                        $data->siswa->status_berkas == '1' &&
                        $data->siswa->ortu->status_berkas == '1' &&
                        $data->lomba?->status_berkas == '1') ||
                    ($data->jalur->id == '5' &&
                        $data->siswa->status_berkas == '1' &&
                        $data->siswa->ortu->status_berkas == '1' &&
                        $data->raport?->status == '1') ||
                    (!in_array($data->jalur->id, ['2', '3', '4', '5']) &&
                        $data->siswa->status_berkas == '1' &&
                        $data->siswa->ortu->status_berkas == '1'))
                <span class="badge badge-success p-2 ml-2" style="border-radius: 0.5rem;">Lengkap</span>
            @else
                <span class="badge badge-danger p-2 ml-2" style="border-radius: 0.5rem;">Belum Lengkap</span>
            @endif
        </div>
        <div class="col-4 text-right">
            <button class="btn btn-sm font-weight-bold" style="background-color: #2d89ef; color: white" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                aria-controls="collapseOne">
                Detail &nbsp;<i class="fa-solid fa-chevron-down"></i>
            </button>
        </div>
    </h5>
</div>

<div id="collapseOne" class="collapse" aria-labelledby="headingOne">
    <div class="card-body">
        <div class="alert alert-info alert-blue-outline mb-3">
            <div class="row align-items-center">
                <div class="col text-center" style="flex: 0 0 5%;">
                    <i class="fas fa-info-circle fa-2x"></i>
                </div>
                <div class="col">
                    <p class="mb-0 text-navi">
                        <strong>
                            Pastikan Seluruh Formulir Wajib Berstatus Lengkap
                        </strong>
                    </p>
                    <p class="mb-0 text-navi">
                        Formulir bertanda bintang merah wajib dilengkapi. Jika seluruh formulir telah lengkap, Formulir
                        Seleksi akan muncul untuk dapat dilengkapi dan dikirim.
                    </p>
                </div>
            </div>
        </div>
        <div class="p-3" style="border: 1px solid #D7DCE5;">
            <table class="table table-borderless table-hover mb-0">
                <tr style="border-bottom: 1px solid #ddd">
                    <th width="250px">
                        <p class="font-weight-bold font-16 mb-0">
                            Formulir
                        </p>
                    </th>
                    <th width="220px">
                        <p class="font-weight-bold font-16 mb-0">
                            Kelengkapan
                        </p>
                    </th>
                </tr>
                <tr>
                    <td>
                        <p class="font-16 mb-0">
                            Biodata<span class="text-red">*</span>
                        </p>
                    </td>
                    <td class="text-left">
                        @if ($data->siswa->status_berkas == '1')
                            <i class="far fa-check-circle fa-xl fa-xl" style="color:#38c172"></i>
                        @else
                            <i class="far fa-times-circle fa-xl" style="color:#e3342f"></i>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="font-16 mb-0">
                            Orang Tua<span class="text-red">*</span>
                        </p>
                    </td>
                    <td class="text-left">
                        @if ($data->siswa->ortu->status_berkas == '1')
                            <i class="far fa-check-circle fa-xl fa-xl" style="color:#38c172"></i>
                        @else
                            <i class="far fa-times-circle fa-xl" style="color:#e3342f"></i>
                        @endif
                    </td>
                </tr>

                @if ($data->jalur->id == '2')
                    <tr>
                        <td>
                            <p class="font-16 mb-0">Dokumen Afirmasi<span class="text-red">*</span></p>
                        </td>
                        <td class="text-left">
                            @if ($data->afirmasi?->status_berkas == '1')
                                <i class="far fa-check-circle fa-xl" style="color:#38c172"></i>
                            @else
                                <i class="far fa-times-circle fa-xl" style="color:#e3342f"></i>
                            @endif
                        </td>
                    </tr>
                @endif

                @if ($data->jalur->id == '3')
                    <tr>
                        <td>
                            <p class="font-16 mb-0">Dokumen Pindah Tugas<span class="text-red">*</span></p>
                        </td>
                        <td class="text-left">
                            @if ($data->mutasi?->status == '1')
                                <i class="far fa-check-circle fa-xl" style="color:#38c172"></i>
                            @else
                                <i class="far fa-times-circle fa-xl" style="color:#e3342f"></i>
                            @endif
                        </td>
                    </tr>
                @endif

                @if ($data->jalur->id == '4')
                    <tr>
                        <td>
                            <p class="font-16 mb-0">Dokumen Prestasi<span class="text-red">*</span></p>
                        </td>
                        <td class="text-left">
                            @if ($data->lomba?->status_berkas == '1')
                                <i class="far fa-check-circle fa-xl" style="color:#38c172"></i>
                            @else
                                <i class="far fa-times-circle fa-xl" style="color:#e3342f"></i>
                            @endif
                        </td>
                    </tr>
                @endif

                @if ($data->jalur->id == '5')
                    <tr>
                        <td>
                            <p class="font-16 mb-0">Raport<span class="text-red">*</span></p>
                        </td>
                        <td class="text-left">
                            @if ($data->raport?->status == '1')
                                <i class="far fa-check-circle fa-xl" style="color:#38c172"></i>
                            @else
                                <i class="far fa-times-circle fa-xl" style="color:#e3342f"></i>
                            @endif
                        </td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
</div>
