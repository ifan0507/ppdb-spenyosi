@extends('layouts.siswa.template')

@section('content')
    <div class="misc-content pt-4">
        @include('layouts.siswa.breadcrumb', [
            'breadcrumb' => [
                'Perbarui Biodata' => '',
            ],
        ])
        <div class="container">
            <div class="card" style="border-top: 3px solid #007bff;">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h4>Perbarui Biodata Siswa</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('update-biodata') }}" method="POST" enctype="multipart/form-data" id="form_biodata">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-8 col-lg-4">
                                <div class="border m-3 py-1 px-2 text-center" id="photo-box">
                                    <label for="pribadi_blob" class="form-label">
                                        Foto Pribadi <span style="color:#e3342f">*</span><br />
                                        <b>(format: JPG/JPEG maks. 1MB)</b>
                                    </label>

                                    <img id="img-pribadi_blob" src="{{ asset('storage/' . $data->siswa->foto_siswa) }}"
                                        class="img-fluid rounded border mb-2" style="max-width: 100%;">
                                    <label for="pribadi_blob" class="btn btn-primary w-100">
                                        <i class="fas fa-folder-open"></i> Pilih Foto
                                    </label>
                                    <input type="file" id="pribadi_blob" name="foto_siswa" class="d-none"
                                        accept="image/jpeg">
                                    <div id="info-pribadi_blob" class="text-muted mt-2" style="display:none;"></div>
                                </div>
                            </div>
                            <!-- Kolom Form -->
                            <div class="col-md-8">
                                <div class="form-group  mb-3">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="nama" id="nama"
                                        value="{{ $data->siswa->nama }}" readonly>
                                </div>

                                <div class="form-group  mb-3">
                                    <label class="form-label">NISN</label>
                                    <input type="text" class="form-control" name="nisn" id="nisn"
                                        value="{{ $data->siswa->nisn }}" readonly>
                                </div>

                                <div class="form-group  mb-3">
                                    <label class="form-label">NIK <span style="color:#e3342f">*</span></label>
                                    <input type="text" class="form-control" name="nik" id="nik"
                                        value="{{ old('nik', $data->siswa->nik) }}">
                                    <div id="validasiNik" class="invalid-feedback"></div>
                                </div>

                                <div class="form-group  mb-3">
                                    <label class="form-label">Jenis Kelamin <span style="color:#e3342f">*</span></label>
                                    <div class="d-flex gap-3">
                                        <div class="form-check">
                                            <input class="form-check-input jenis_kelamin" type="radio"
                                                name="jenis_kelamin" id="jk_laki" value="Laki-Laki"
                                                {{ $data->siswa->jenis_kelamin == 'Laki-Laki' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="jk_laki">Laki-laki</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input jenis_kelamin" type="radio"
                                                name="jenis_kelamin" id="jk_perempuan" value="Perempuan"
                                                {{ $data->siswa->jenis_kelamin == 'Perempuan' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="jk_perempuan">Perempuan</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group  mb-3">
                                    <label class="form-label">Tempat Lahir <span style="color:#e3342f">*</span></label>
                                    <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir"
                                        value="{{ old('tempat_lahir', $data->siswa->tempat_lahir) }}">
                                </div>

                                <div class="form-group  mb-3">
                                    <label class="form-label">Tanggal Lahir <span style="color:#e3342f">*</span></label>
                                    <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir"
                                        value="{{ old('tanggal_lahir', $data->siswa->tanggal_lahir) }}">
                                </div>

                                <div class="form-group  mb-3">
                                    <label class="form-label">Kabupaten <span style="color:#e3342f">*</span></label>
                                    <select id="kabupaten_id" class="form-select form-select-sm" name="kab_id">
                                        <option value="">Pilih Kabupaten</option>
                                    </select>
                                    <input type="hidden" id="kab_name" name="kabupaten">
                                </div>
                                <div class="form-group  mb-3">
                                    <label class="form-label">Kecamatan <span style="color:#e3342f">*</span></label>
                                    <select id="kecamatan_id" name="kec_id" class="form-select form-select-sm">
                                        <option value="">Pilih Kecamatan</option>
                                    </select>
                                    <input type="hidden" id="kec_name" name="kecamatan">
                                </div>
                                <div class="form-group  mb-3">
                                    <label class="form-label">Kelurahan/Desa <span style="color:#e3342f">*</span></label>
                                    <select id="desa_id" class="form-select form-select-sm" name="desa_id">
                                        <option value="">Pilih Kelurahan/Desa</option>
                                    </select>
                                    <input type="hidden" id="desa_name" name="desa">
                                </div>
                                <input type="hidden" id="selected_kab"
                                    value="{{ old('kab_id', $data->siswa->kab_id ?? '') }}">
                                <input type="hidden" id="selected_kec"
                                    value="{{ old('kec_id', $data->siswa->kec_id ?? '') }}">
                                <input type="hidden" id="selected_desa"
                                    value="{{ old('desa_id', $data->siswa->desa_id ?? '') }}">
                                <div class="form-group  mb-3">
                                    <label for="alamat" class="form-label">Alamat <span
                                            style="color:#e3342f">*</span></label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Alamat tempat tinggal">{{ old('alamat', $data->siswa->alamat) }}</textarea>
                                </div>
                                <div class="form-group  mb-3">
                                    <label class="form-label">No HP <span style="color:#e3342f">*</span></label>
                                    <input type="text" class="form-control" name="no_hp" id="no_hp"
                                        value="{{ old('no_hp', $data->siswa->no_hp) }}">
                                    <div id="validasiNoHp" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group  mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email"
                                        value="{{ $data->siswa->email }}" readonly>
                                </div>
                                <label class="form-label">Titik Koordinat Rumah <span
                                        style="color:#e3342f">*</span></label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control"
                                        placeholder="Masukan titik koordinat rumah" name="lokasi"
                                        aria-label="Recipient's username" aria-describedby="button-addon2"
                                        id="coordinates" value="{{ old('lokasi', $data->siswa->lokasi) }}">
                                    <button class="btn btn-secondary" type="button" id="button-addon2"
                                        data-bs-toggle="modal" data-bs-target="#mapModal"><i
                                            class="fa-solid fa-location-dot"></i></button>
                                </div>
                                <div class="form-group  mb-3">
                                    <label class="form-label">Asal Sekolah</label>
                                    <input type="text" class="form-control" name="asal_sekolah"
                                        value="{{ old('asal_sekolah', $data->siswa->asal_sekolah) }}">
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="border m-3 py-1 px-2 text-center">
                                            <label for="foto_kk" class="form-label">
                                                Foto KK <span style="color:#e3342f">*</span><br />
                                                <b>(format: JPG/JPEG maks. 1MB)</b>
                                            </label>

                                            <img id="img-foto_kk" src="{{ asset('storage/' . $data->siswa->foto_kk) }}"
                                                class="img-fluid rounded border mb-2"
                                                style="max-width: 80%; height: auto;">
                                            <label for="foto_kk" class="btn btn-primary w-100">
                                                <i class="fas fa-folder-open"></i> Pilih Foto
                                            </label>
                                            <input type="file" id="foto_kk" name="foto_kk" class="d-none"
                                                accept="image/jpeg">
                                            <div id="info-kk_blob" class="text-muted mt-2" style="display:none;"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="border m-3 py-1 px-2 text-center">
                                            <label for="foto_akte" class="form-label">
                                                Foto Akte <span style="color:#e3342f">*</span><br />
                                                <b>(format: JPG/JPEG maks. 1MB)</b>
                                            </label>

                                            <img id="img-foto_akte"
                                                src="{{ asset('storage/' . $data->siswa->foto_akte) }}"
                                                class="img-fluid rounded border mb-2"
                                                style="max-width: 80%; height: auto;">
                                            <label for="foto_akte" class="btn btn-primary w-100">
                                                <i class="fas fa-folder-open"></i> Pilih Foto
                                            </label>
                                            <input type="file" id="foto_akte" name="foto_akte" class="d-none"
                                                accept="image/jpeg">
                                            <div id="info-akte_blob" class="text-muted mt-2" style="display:none;"></div>

                                        </div>
                                    </div>
                                    @if ($data->jalur->id == '2' || $data->jalur->id == '3' || $data->jalur->id == '4')
                                        <div class="col-md-4">
                                            <div class="border m-3 py-1 px-2 text-center">
                                                <label for="foto_lainnya" class="form-label">
                                                    @if ($data->jalur->id == '2')
                                                        KIP/KIS/PIP/PKH/SKTM
                                                    @elseif ($data->jalur->id == '3')
                                                        Surat Pindah Tugas
                                                    @elseif ($data->jalur->id == '4')
                                                        Piagam Prestasi
                                                    @endif
                                                    <span style="color:#e3342f">*</span><br />
                                                    <b>(format: JPG/JPEG maks. 1MB)</b>
                                                </label>

                                                <img id="img-foto_lainnya"
                                                    src="{{ asset('storage/' . $data->document->document) }}"
                                                    class="img-fluid rounded border mb-2"
                                                    style="max-width: 80%; height: auto;">
                                                <label for="foto_lainnya" class="btn btn-primary w-100">
                                                    <i class="fas fa-folder-open"></i> Pilih Foto
                                                </label>
                                                <input type="file" id="foto_lainnya" name="document" class="d-none"
                                                    accept="image/jpeg">
                                                <div id="info-document_blob" class="text-muted mt-2"
                                                    style="display:none;">
                                                </div>

                                            </div>
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-sm-8 col-lg-8">
                                <button type="submit" class="btn btn-primary btn-block" id="btnSubmit"><i
                                        class="fas fa-save" id="icon_save"></i>
                                    <span id="btnText"> Perbarui Biodata</span>
                                    <span id="btnLoading" class="spinner-border spinner-border-sm d-none" role="status"
                                        aria-hidden="true"></span>
                                </button>

                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="mapModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mapModalLabel">Pilih Lokasi Rumah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>


    <script>
        let map;
        let marker;
        let inputKoordinat = document.getElementById("coordinates");
        document.getElementById('mapModal').addEventListener('shown.bs.modal', function() {
            if (!map) {
                map = L.map('map').setView([-8.2341388, 113.3041141], 13);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);

                marker = L.marker([-8.2341388, 113.3041141], {
                        draggable: true
                    }).addTo(map)
                    .bindPopup('SMP NEGERI 1 YOSOWILANGUN').openPopup();

                map.on('click', function(e) {
                    let lat = e.latlng.lat;
                    let lng = e.latlng.lng;

                    marker.setLatLng([lat, lng])
                        .bindPopup(`Lokasi: ${lat.toFixed(5)}, ${lng.toFixed(5)}`)
                        .openPopup();
                    inputKoordinat.value = `${lat.toFixed(5)}, ${lng.toFixed(5)}`;
                });

            } else {
                setTimeout(() => {
                    map.invalidateSize();
                }, 200);
            }
        });

        // scrip jquery dan ajax untuk kabupaten
        document.addEventListener("DOMContentLoaded", function() {
            let kabupatenSelect = document.getElementById("kabupaten_id");
            let kecamatanSelect = document.getElementById("kecamatan_id");
            let desaSelect = document.getElementById("desa_id");

            let kabupatenName = document.getElementById("kab_name");
            let kecamatanName = document.getElementById("kec_name");
            let desaName = document.getElementById("desa_name");

            let selectedKab = document.getElementById("selected_kab").value;
            let selectedKec = document.getElementById("selected_kec").value;
            let selectedDesa = document.getElementById("selected_desa").value;

            let kabupatenChoices = new Choices(kabupatenSelect, {
                searchEnabled: true
            });
            let kecamatanChoices = new Choices(kecamatanSelect, {
                searchEnabled: true
            });
            let desaChoices = new Choices(desaSelect, {
                searchEnabled: true
            });

            fetch("https://www.emsifa.com/api-wilayah-indonesia/api/regencies/35.json")
                .then(response => response.json())
                .then(data => {
                    kabupatenChoices.clearChoices();
                    kabupatenChoices.setChoices(
                        data.map(item => ({
                            value: item.id,
                            label: item.name,
                            selected: item.id ===
                                selectedKab
                        })),
                        "value",
                        "label",
                        true
                    );

                    if (selectedKab) {
                        kabupatenName.value = kabupatenSelect.options[kabupatenSelect.selectedIndex].text;
                        loadKecamatan(selectedKab, selectedKec);
                    }
                });

            kabupatenSelect.addEventListener("change", function() {
                let kabupatenId = kabupatenSelect.value;
                kabupatenName.value = kabupatenSelect.options[kabupatenSelect.selectedIndex].text;
                kecamatanChoices.clearChoices();
                kecamatanChoices.setChoices([{
                    value: "",
                    label: "Memuat...",
                    disabled: true
                }]);
                desaChoices.clearChoices();
                desaChoices.setChoices([{
                    value: "",
                    label: "Pilih Kecamatan Terlebih Dahulu",
                    disabled: true
                }]);

                if (kabupatenId) {
                    loadKecamatan(kabupatenId);
                }
            });

            function loadKecamatan(kabupatenId, selectedKec = "") {
                fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${kabupatenId}.json`)
                    .then(response => response.json())
                    .then(data => {
                        kecamatanChoices.clearChoices();
                        kecamatanChoices.setChoices(
                            data.map(item => ({
                                value: item.id,
                                label: item.name,
                                selected: item.id === selectedKec
                            })),
                            "value",
                            "label",
                            true
                        );

                        if (selectedKec) {
                            kecamatanName.value = kecamatanSelect.options[kecamatanSelect.selectedIndex].text;
                            loadDesa(selectedKec, selectedDesa);
                        }
                    });
            }

            kecamatanSelect.addEventListener("change", function() {
                let kecamatanId = kecamatanSelect.value;
                kecamatanName.value = kecamatanSelect.options[kecamatanSelect.selectedIndex].text;
                desaChoices.clearChoices();
                desaChoices.setChoices([{
                    value: "",
                    label: "Memuat...",
                    disabled: true
                }]);

                if (kecamatanId) {
                    loadDesa(kecamatanId);
                }
            });

            function loadDesa(kecamatanId, selectedDesa = "") {
                fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${kecamatanId}.json`)
                    .then(response => response.json())
                    .then(data => {
                        desaChoices.clearChoices();
                        desaChoices.setChoices(
                            data.map(item => ({
                                value: item.id,
                                label: item.name,
                                selected: item.id === selectedDesa
                            })),
                            "value",
                            "label",
                            true
                        );

                        if (selectedDesa) {
                            desaName.value = desaSelect.options[desaSelect.selectedIndex].text;
                        }
                    });
            }

            desaSelect.addEventListener("change", function() {
                desaName.value = desaSelect.options[desaSelect.selectedIndex].text;
            });
        });


        $(document).ready(function() {

            $("#pribadi_blob").on("change", function() {
                const input = this;
                const imgPreview = $("#img-pribadi_blob");
                const infoBox = $("#info-pribadi_blob");

                if (input.files && input.files[0]) {
                    const file = input.files[0];
                    if (file.size > 1 * 1024 * 1024) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Ukuran file terlalu besar! Maksimal 1MB.!",
                        })
                        $(this).val("");
                        imgPreview.attr("src",
                            "{{ asset('storage/' . $data->siswa->foto_siswa) }}"
                        );
                        infoBox.hide();
                        return;
                    }

                    infoBox.text(`File: ${file.name} (${(file.size / 1024).toFixed(2)} KB)`).show();

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imgPreview.attr("src", e.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            });

            $("#foto_kk").on("change", function() {
                const input = this;
                const imgPreview = $("#img-foto_kk");
                const infoBox = $("#info-kk_blob");

                if (input.files && input.files[0]) {
                    const file = input.files[0];
                    if (file.size > 1 * 1024 * 1024) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Ukuran file terlalu besar! Maksimal 1MB.!",
                        })
                        $(this).val("");
                        imgPreview.attr("src",
                            "{{ asset('storage/' . $data->siswa->foto_kk) }}"
                        );
                        infoBox.hide();
                        return;
                    }

                    infoBox.text(`File: ${file.name} (${(file.size / 1024).toFixed(2)} KB)`).show();

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imgPreview.attr("src", e.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            });

            $("#foto_akte").on("change", function() {
                const input = this;
                const imgPreview = $("#img-foto_akte");
                const infoBox = $("#info-akte_blob");

                if (input.files && input.files[0]) {
                    const file = input.files[0];
                    if (file.size > 1 * 1024 * 1024) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Ukuran file terlalu besar! Maksimal 1MB.!",
                        })
                        $(this).val("");
                        imgPreview.attr("src",
                            "{{ asset('storage/' . $data->siswa->foto_akte) }}"
                        );
                        infoBox.hide();
                        return;
                    }

                    infoBox.text(`File: ${file.name} (${(file.size / 1024).toFixed(2)} KB)`).show();

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imgPreview.attr("src", e.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            });

            $("#foto_lainnya").on("change", function() {
                const input = this;
                const imgPreview = $("#img-foto_lainnya");
                const infoBox = $("#info-document_blob");

                if (input.files && input.files[0]) {
                    const file = input.files[0];
                    if (file.size > 1 * 1024 * 1024) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Ukuran file terlalu besar! Maksimal 1MB.!",
                        })
                        $(this).val("");
                        imgPreview.attr("src",
                            "{{ asset('storage/' . $data->siswa->foto_akte) }}"
                        );
                        infoBox.hide();
                        return;
                    }

                    infoBox.text(`File: ${file.name} (${(file.size / 1024).toFixed(2)} KB)`).show();

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imgPreview.attr("src", e.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            });


            $("#nik").on("input", function() {
                var nik = $(this).val();
                var nikRegex = /^[0-9]{16}$/;

                if (!nikRegex.test(nik)) {
                    $("#validasiNik").text("NIK harus terdiri dari 16 digit angka!").show();
                    $(this).addClass("is-invalid");
                } else {
                    $("#validasiNik").hide();
                    $(this).removeClass("is-invalid").addClass("is-valid");
                }
            });

            $("[name='no_hp']").on("input", function() {
                var no = $(this).val();
                var noRegex = /^[0-9]{12}$/;

                if (!noRegex.test(no)) {
                    $("#validasiNoHp").text("Nomor HP harus terdiri dari 12 digit angka!").show();
                    $(this).addClass("is-invalid");
                } else {
                    $("#validasiNoHp").hide();
                    $(this).removeClass("is-invalid").addClass("is-valid");
                }
            });

            $("#tempat_lahir, #tanggal_lahir, #alamat, #coordinates").on("input", function() {
                if ($(this).val().trim() === "") {
                    $(this).addClass("is-invalid");
                } else {
                    $(this).removeClass("is-invalid").addClass("is-valid");
                }
            });

            // Submit
            $("#form_biodata").on("submit", function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                formData.append("_method", "PUT");
                let isChecked = $("input[name='jenis_kelamin']:checked").length > 0;
                if ($("#nik").val() == "" || $("#nik").val() === "_") {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "NIK Wajib diisi!",
                    })
                } else if (!isChecked) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Jenis kelamin wajib dipilih!",
                    })
                } else if ($("#tempat_lahir").val() == "" || $("#tempat_lahir").val() === "_") {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Tempat lahir wajib diisi!",
                    })
                } else if ($("#tanggal_lahir").val() == "" || $("#tanggal_lahir").val() === "_") {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Tanggal lahir wajib diisi!",
                    })
                } else if ($("#kab_name").val() == "") {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Kabupaten wajib dipilih!",
                    })
                } else if ($("#kec_name").val() == "") {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Kecamatan wajib dipilih!",
                    })
                } else if ($("#desa_name").val() == "") {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Desa wajib dipilih!",
                    })
                } else if ($("#alamat").val() == "" || $("#alamat").val() === "_") {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Alamat wajib diisi!",
                    })
                } else if ($("#no_hp").val() == "" || $("#no_hp").val() === "_") {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "No HP wajib diisi!",
                    })
                } else if ($("#coordinates").val() == "" || $("#coordinates").val() === "_") {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Koordinate rumah wajib diisi!",
                    })
                } else {
                    $("#btnSubmit").attr("disabled", true);
                    $("#btnText").addClass("d-none");
                    $("#icon_save").addClass("d-none");
                    $("#btnLoading").removeClass("d-none");
                    $.ajax({
                        url: $(this).attr("action"),
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(res) {
                            $("#btnSubmit").attr("disabled", false);
                            $("#btnLoading").addClass("d-none");
                            $("#btnText").removeClass("d-none");
                            $("#icon_save").removeClass("d-none");
                            Swal.fire({
                                title: "Berhasil",
                                icon: "success",
                                text: "diperbarui!",
                                confirmButtonText: "OK",
                                confirmButtonColor: "#18a342",
                            }).then(() => {
                                window.location.href = res.redirect;
                            });
                        },
                        error: function(xhr) {
                            var errorString = "";
                            $("#btnSubmit").attr("disabled", false);
                            $("#btnLoading").addClass("d-none");
                            $("#btnText").removeClass("d-none");
                            $("#icon_save").removeClass("d-none");
                            if (xhr.responseJSON && xhr.responseJSON.errors) {
                                $.each(xhr.responseJSON.errors, function(key, messages) {
                                    errorString += messages[0] + "\n";
                                });
                            } else if (xhr.responseJSON && xhr.responseJSON.error) {
                                errorString += xhr.responseJSON.error;
                            } else {
                                errorString += "Kesalahan tidak diketahui.";
                            }

                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: errorString,
                            });
                        }

                    })
                }
            })
        })
    </script>
@endsection
