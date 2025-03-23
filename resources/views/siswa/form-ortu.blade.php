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

                            <div class="row">
                                <div class="col-sm-12 col-lg-6">
                                    <div class="card card-default card-outline">
                                        <div class="card-header">
                                            <div class="d-flex">
                                                <h5 class="m-0">Informasi Ayah</h5>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group required">
                                                <label class="form-label">Nama Ayah</label>
                                                <input type="text" class="form-control " name="ayah" id="nama_ayah"
                                                    value="{{ old('ayah', $data->siswa->ortu) }}">
                                            </div>
                                            <div class="form-group required">
                                                <label class="form-label">Status Ayah</label><br>
                                                <div class="d-block">
                                                    <div class="form-check mr-2">
                                                        <input class="form-check-input status_ayah" type="radio"
                                                            name="status_ayah" id="status_ayah_1" value="Hidup"
                                                            {{ $data->siswa->ortu == 'Hidup' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="status_ayah_1">Hidup</label>
                                                    </div>
                                                    <div class="form-check mr-2">
                                                        <input class="form-check-input status_ayah" type="radio"
                                                            name="status_ayah" id="status_ayah_2" value="Wafat"
                                                            {{ $data->siswa->ortu == 'Wafat' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="status_ayah_2">Wafat</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group required">
                                                <label class="form-label">Pendidikan Ayah</label>
                                                <select class="form-control" name="pendidikan_ayah" id="pendidikanAyah">
                                                    <option value="">-- Pilih Pendidikan --</option>
                                                    <option value="1">Tidak Sekolah</option>
                                                    <option value="2" selected="selected">SD/MI / Sederajat</option>
                                                    <option value="3">SMP/MTs / Sederajat</option>
                                                    <option value="4">SMA/MA / Sederajat</option>
                                                    <option value="5">D1 / Sederajat</option>
                                                    <option value="6">D2 / Sederajat</option>
                                                    <option value="7">D3 / Sederajat</option>
                                                    <option value="8">D4/S1 / Sederajat</option>
                                                    <option value="9">S2/Sp1 / Sederajat</option>
                                                    <option value="10">S3/Sp2 / Sederajat</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Harap pilih pendidikan ayah!
                                                </div>
                                            </div>
                                            <div class="form-group required">
                                                <label class="form-label">Pekerjaan Ayah</label>
                                                <select class="form-control" name="pekerjaan_ayah" id="pekerjaanAyah">
                                                    <option value="">-- Pilih Pekerjaan --</option>
                                                    <option value="PNS">PNS</option>
                                                    <option value="Peg. Swasta">Peg. Swasta</option>
                                                    <option value="Wirausaha">Wirausaha</option>
                                                    <option value="TNI / POLRI">TNI / POLRI</option>
                                                    <option value="Petani">Petani</option>
                                                    <option value="Nelayan">Nelayan</option>
                                                    <option value="Lainnya">Lainnya</option>
                                                    <option value="Tidak Bekerja">TIDAK BEKERJA</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Harap pekerjaan ayah!
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-6">
                                    <div class="card card-default card-outline">
                                        <div class="card-header">
                                            <div class="d-flex">
                                                <h5 class="m-0">Informasi Ibu</h5>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group required">
                                                <label class="title">Nama Ibu</label>
                                                <input type="text" class="form-control " name="nama_ibu" id="nama_ibu"
                                                    value="YULIL FITRIYAWATI" required="">
                                            </div>
                                            <div class="form-group required">
                                                <label class="title">Status Ibu</label><br>
                                                <div class="d-block">
                                                    <div class="custom-control custom-radio mr-2">
                                                        <input type="radio" class="custom-control-input" id="status_ibu_1"
                                                            name="status_ibu" value="hidup" checked>
                                                        <label class="custom-control-label" for="status_ibu_1">Masih
                                                            Hidup</label>
                                                    </div>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" class="custom-control-input"
                                                            id="status_ibu_2" name="status_ibu" value="wafat">
                                                        <label class="custom-control-label"
                                                            for="status_ibu_2">Wafat</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group required">
                                                <label class="title">Pendidikan Ibu</label>
                                                <select class="form-control" required="" name="pendidikan_ibu">
                                                    <option value="">-- Pilih Pendidikan --</option>
                                                    <option value="1">Tidak Sekolah</option>
                                                    <option value="2" selected="selected">SD/MI / Sederajat</option>
                                                    <option value="3">SMP/MTs / Sederajat</option>
                                                    <option value="4">SMA/MA / Sederajat</option>
                                                    <option value="5">D1 / Sederajat</option>
                                                    <option value="6">D2 / Sederajat</option>
                                                    <option value="7">D3 / Sederajat</option>
                                                    <option value="8">D4/S1 / Sederajat</option>
                                                    <option value="9">S2/Sp1 / Sederajat</option>
                                                    <option value="10">S3/Sp2 / Sederajat</option>
                                                </select>
                                            </div>
                                            <div class="form-group required">
                                                <label class="title">Pekerjaan Ibu</label>
                                                <select class="form-control" required="" name="pekerjaan_ibu">
                                                    <option value="">-- Pilih Pekerjaan --</option>
                                                    <option value="1">PNS</option>
                                                    <option value="2">Peg. Swasta</option>
                                                    <option value="3">Wirausaha</option>
                                                    <option value="4">TNI / POLRI</option>
                                                    <option value="5" selected="selected">Petani</option>
                                                    <option value="6">Nelayan</option>
                                                    <option value="7">Lainnya</option>
                                                    <option value="8">TIDAK BEKERJA</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-6">
                                    <div class="card card-default card-outline">
                                        <div class="card-header">
                                            <div class="d-flex">
                                                <h5 class="m-0">Informasi Tambahan</h5>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label class="title">No Telepon Orang Tua</label>
                                                <input type="text" class="form-control " name="no_telepon_ortu"
                                                    id="no_telepon_ortu" value="087837629378">
                                            </div>

                                        </div>
                                    </div>
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
