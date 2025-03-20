@extends('layouts.siswa.template')

@section('content')
    <div class="container py-3">
        <div class="card" style="border-top: 3px solid #007bff;">
            <div class="card-header py-2 d-flex justify-content-between align-items-center">
                <h4 class="card-title mt-3 mb-3"><b>Perbarui Biodata Siswa</b></h4>
            </div>
            <div class="card-body">
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-sm-8 col-lg-4">
                            <div class="border m-3 py-1 px-2 text-center" id="photo-box">
                                <label for="pribadi_blob" class="form-label">
                                    Foto Pribadi <span style="color:#e3342f">*</span><br />
                                    <b>(format: JPG/JPEG maks. 300KB)</b>
                                </label>

                                <img id="img-pribadi_blob" src="{{ asset('storage/' . $data->siswa->foto_siswa) }}"
                                    class="img-fluid rounded border mb-2" style="max-width: 100%;">
                                <label for="pribadi_blob" class="btn btn-primary w-100">
                                    <i class="fas fa-folder-open"></i> Pilih Foto
                                </label>
                                <input type="file" id="pribadi_blob" name="pribadi_blob" class="d-none"
                                    accept="image/jpeg">
                                <div id="info-pribadi_blob" class="text-muted mt-2" style="display:none;"></div>
                            </div>
                        </div>
                        <!-- Kolom Form -->
                        <div class="col-md-8">
                            <div class="form-group required mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama" value="{{ $data->siswa->nama }}"
                                    required>
                            </div>

                            <div class="form-group required mb-3">
                                <label class="form-label">NISN</label>
                                <input type="text" class="form-control" name="nisn" value="{{ $data->siswa->nisn }}"
                                    required>
                            </div>

                            <div class="form-group required mb-3">
                                <label class="form-label">NIK</label>
                                <input type="text" class="form-control" name="nik" value="{{ $data->siswa->nik }}"
                                    required>
                            </div>

                            <div class="form-group required mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <div class="d-flex gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk_laki"
                                            value="Laki-laki"
                                            {{ $data->siswa->jenis_kelamin == 'Laki-laki' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="jk_laki">Laki-laki</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin"
                                            id="jk_perempuan" value="Perempuan"
                                            {{ $data->siswa->jenis_kelamin == 'Perempuan' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="jk_perempuan">Perempuan</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group required mb-3">
                                <label class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" name="tempat_lahir"
                                    value="{{ $data->siswa->tempat_lahir }}" required>
                            </div>

                            <div class="form-group required mb-3">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tanggal_lahir"
                                    value="{{ $data->siswa->tanggal_lahir }}" required>
                            </div>

                            <div class="form-group required mb-3">
                                <label class="form-label">Kabupaten</label>
                                <select id="kabupaten_id" class="form-select form-select-sm">
                                    <option value="">Pilih Kabupaten</option>
                                </select>
                                <input type="hidden" id="kab_name">
                            </div>
                            <div class="form-group required mb-3">
                                <label class="form-label">Kecamatan</label>
                                <select id="kecamatan_id" class="form-select form-select-sm">
                                    <option value="">Pilih Kecamatan</option>
                                </select>
                                <input type="hidden" id="kec_name">
                            </div>
                            <div class="form-group required mb-3">
                                <label class="form-label">Kelurahan/Desa</label>
                                <select id="desa_id" class="form-select form-select-sm">
                                    <option value="">Pilih Kelurahan/Desa</option>
                                </select>
                                <input type="hidden" id="desa_name">
                            </div>
                            <div class="form-group required mb-3">
                                <label class="form-label">No HP</label>
                                <input type="text" class="form-control" name="no_hp"
                                    value="{{ $data->siswa->no_hp }}" required>
                            </div>
                            <div class="form-group required mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email"
                                    value="{{ $data->siswa->email }}" required>
                            </div>
                            <label class="form-label">Titik Koordinat Rumah</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Masukan titik koordinat rumah"
                                    aria-label="Recipient's username" aria-describedby="button-addon2" id="coordinates">
                                <button class="btn btn-outline-secondary" type="button" id="button-addon2"
                                    data-bs-toggle="modal" data-bs-target="#mapModal"><i
                                        class="fa-solid fa-location-dot"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-end">
                        <div class="col-sm-8 col-lg-8">
                            <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-save"></i> Perbarui
                                Biodata</button>
                        </div>
                    </div>
                </form>
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
            let kacamatanName = document.getElementById("kec_name");
            let desaName = document.getElementById("desa_name");

            let kabupatenChoices = new Choices(kabupatenSelect, {
                searchEnabled: true
            });
            let kecamatanChoices = new Choices(kecamatanSelect, {
                searchEnabled: true
            });
            let desaChoices = new Choices(desaSelect, {
                searchEnabled: true
            });

            // Ambil data kabupaten dari API
            fetch("https://www.emsifa.com/api-wilayah-indonesia/api/regencies/35.json")
                .then(response => response.json())
                .then(data => {
                    kabupatenChoices.clearChoices();
                    kabupatenChoices.setChoices(
                        data.map(item => ({
                            value: item.id,
                            label: item.name
                        })),
                        "value",
                        "label",
                        true
                    );
                });

            // Event listener ketika kabupaten dipilih
            kabupatenSelect.addEventListener("change", function() {
                let kabupatenId = kabupatenSelect.value;
                let selectedOption = kabupatenSelect.options[kabupatenSelect.selectedIndex];
                kabupatenName.value = selectedOption.text;
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
                    fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${kabupatenId}.json`)
                        .then(response => response.json())
                        .then(data => {
                            kecamatanChoices.clearChoices();
                            kecamatanChoices.setChoices(
                                data.map(item => ({
                                    value: item.id,
                                    label: item.name
                                })),
                                "value",
                                "label",
                                true
                            );
                        });
                }
            });

            // Event listener ketika kecamatan dipilih
            kecamatanSelect.addEventListener("change", function() {
                let kecamatanId = kecamatanSelect.value;

                let selectedOption = kecamatanSelect.options[kecamatanSelect.selectedIndex];
                kacamatanName.value = selectedOption.text;

                desaChoices.clearChoices();
                desaChoices.setChoices([{
                    value: "",
                    label: "Memuat...",
                    disabled: true
                }]);

                if (kecamatanId) {
                    fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${kecamatanId}.json`)
                        .then(response => response.json())
                        .then(data => {
                            desaChoices.clearChoices();
                            desaChoices.setChoices(
                                data.map(item => ({
                                    value: item.id,
                                    label: item.name
                                })),
                                "value",
                                "label",
                                true
                            );
                        });
                } else {
                    desaChoices.clearChoices();
                    desaChoices.setChoices([{
                        value: "",
                        label: "Pilih Kecamatan Terlebih Dahulu",
                        disabled: true
                    }]);
                }
            });

            desaSelect.addEventListener("change", function() {
                let selectedOption = desaSelect.options[desaSelect.selectedIndex];
                desaName.value = selectedOption.text;
            });
        });
    </script>
@endsection
