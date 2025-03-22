@extends('layouts.siswa.template')
@section('content')
    <div class="misc-content pt-4">
        <div class="container">
            @include('layouts.siswa.header-update')
            <div class="row justify-content-center">
                <div class="card card-primary card-outline card-outline-tabs col-md-12">
                    <div class="card-body">
                        <form action="#" method="POST">
                            @csrf

                            <div class="row mb-3">
                                <div class="form-group required col-md-6">
                                    <label class="form-label fw-bold">Nama Orang Tua</label>
                                    <input type="text" name="nama_ortu" class="form-control" required>
                                </div>
                                <div class="form-group required col-md-6">
                                    <label class="form-label fw-bold">Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir" class="form-control" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="form-group required col-md-6">
                                    <label class="form-label fw-bold">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" class="form-control" required>
                                </div>
                                <div class="form-group required col-md-6">
                                    <label class="form-label fw-bold">Kabupaten</label>
                                    <select id="kabupaten_id" class="form-select form-select-sm">
                                        <option value="">Pilih Kabupaten</option>
                                    </select>
                                    <input type="hidden" id="kab_name">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="form-group required col-md-6">
                                    <label class="form-label fw-bold">Kecamatan</label>
                                    <select id="kecamatan_id" class="form-select form-select-sm">
                                        <option value="">Pilih Kecamatan</option>
                                    </select>
                                    <input type="hidden" id="kec_name">
                                </div>
                                <div class="form-group required col-md-6">
                                    <label class="form-label fw-bold">Desa</label>
                                    <select id="desa_id" class="form-select form-select-sm">
                                        <option value="">Pilih Kelurahan/Desa</option>
                                    </select>
                                    <input type="hidden" id="desa_name">
                                </div>
                            </div>

                            <div class="form-group required mb-3">
                                <label class="form-label fw-bold">Alamat</label>
                                <textarea name="alamat" class="form-control" rows="3" required></textarea>
                            </div>

                            <div class="row mb-3">
                                <div class="form-group required col-md-6">
                                    <label class="form-label fw-bold">Pekerjaan</label>
                                    <input type="text" name="pekerjaan" class="form-control" required>
                                </div>
                                <div class="form-group required col-md-6">
                                    <label class="form-label fw-bold">Pendidikan</label>
                                    <input type="text" name="pendidikan" class="form-control" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="form-group required col-md-6">
                                    <label class="form-label fw-bold">Nomor HP</label>
                                    <input type="text" name="no_hp" class="form-control" required>
                                </div>
                                <div class="form-group required col-md-6">
                                    <label class="form-label fw-bold">Email</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan
                                    Data</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>

    <script>
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
