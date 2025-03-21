@extends('layouts.siswa.template')
@section('content')
    <div class="misc-content pt-4">
        <div class="container">
            @include('layouts.siswa.header-update')
            <div class="row justify-content-center">
                <div class="card card-primary card-outline card-outline-tabs col-md-12">
                    <div class="card-body">
                        <form action="{{ route('update-raport', ['id' => optional($raports->first())->id_register]) }}"
                            method="PUT" id="editRaporForm">
                            @csrf

                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" class="align-middle">No</th>
                                            <th rowspan="2" class="align-middle">Mata Pelajaran</th>
                                            <th colspan="2">Rapor Kelas 4</th>
                                            <th colspan="2">Rapor Kelas 5</th>
                                            <th>Rapor Kelas 6</th>
                                        </tr>
                                        <tr>
                                            <th>Semester 1</th>
                                            <th>Semester 2</th>
                                            <th>Semester 1</th>
                                            <th>Semester 2</th>
                                            <th>Semester 1</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($raports as $index => $raport)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    {{ $raport->mapel->nama_matapelajaran }}
                                                    <input type="hidden" name="id_mapel[]"
                                                        value="{{ old('id_mapel.' . $index, $raport->id_mapel) }}">
                                                </td>
                                                <td>
                                                    <input type="text" name="kelas4_1[]"
                                                        class="form-control text-center nilai"
                                                        value="{{ old('kelas4_1.' . $index, $raport->kelas4_1) }}">
                                                    <div class="invalid-feedback">Harus diisi dan berupa angka!</div>
                                                </td>
                                                <td>
                                                    <input type="text" name="kelas4_2[]"
                                                        class="form-control text-center nilai"
                                                        value="{{ old('kelas4_2.' . $index, $raport->kelas4_2) }}">
                                                    <div class="invalid-feedback">Harus diisi dan berupa angka!</div>
                                                </td>
                                                <td>
                                                    <input type="text" name="kelas5_1[]"
                                                        class="form-control text-center nilai"
                                                        value="{{ old('kelas5_1.' . $index, $raport->kelas5_1) }}">
                                                    <div class="invalid-feedback">Harus diisi dan berupa angka!</div>
                                                </td>
                                                <td>
                                                    <input type="text" name="kelas5_2[]"
                                                        class="form-control text-center nilai"
                                                        value="{{ old('kelas5_2.' . $index, $raport->kelas5_2) }}">
                                                    <div class="invalid-feedback">Harus diisi dan berupa angka!</div>
                                                </td>
                                                <td>
                                                    <input type="text" name="kelas6_1[]"
                                                        class="form-control text-center nilai"
                                                        value="{{ old('kelas6_1.' . $index, $raport->kelas6_1) }}">
                                                    <div class="invalid-feedback">Harus diisi dan berupa angka!</div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                    <tr>
                                        <td colspan="2"><strong>Rata-rata Nilai</strong></td>
                                        <td>
                                            <input type="text" name="rata_kelas4_sem1"
                                                class="form-control text-center nilai"
                                                value="{{ old('rata_kelas4_sem1', optional($raports->first())->rata_kelas4_sem1) }}">
                                            <div class="invalid-feedback">Harus diisi dan berupa angka!</div>
                                        </td>
                                        <td>
                                            <input type="text" name="rata_kelas4_sem2"
                                                class="form-control text-center nilai"
                                                value="{{ old('rata_kelas4_sem2', optional($raports->first())->rata_kelas4_sem2) }}">
                                            <div class="invalid-feedback">Harus diisi dan berupa angka!</div>
                                        </td>
                                        <td>
                                            <input type="text" name="rata_kelas5_sem1"
                                                class="form-control text-center nilai"
                                                value="{{ old('rata_kelas5_sem1', optional($raports->first())->rata_kelas5_sem1) }}">
                                            <div class="invalid-feedback">Harus diisi dan berupa angka!</div>
                                        </td>
                                        <td>
                                            <input type="text" name="rata_kelas5_sem2"
                                                class="form-control text-center nilai"
                                                value="{{ old('rata_kelas5_sem2', optional($raports->first())->rata_kelas5_sem2) }}">
                                            <div class="invalid-feedback">Harus diisi dan berupa angka!</div>
                                        </td>
                                        <td>
                                            <input type="text" name="rata_kelas6_sem1"
                                                class="form-control text-center nilai"
                                                value="{{ old('rata_kelas6_sem1', optional($raports->first())->rata_kelas6_sem1) }}">
                                            <div class="invalid-feedback">Harus diisi dan berupa angka!</div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-betwen align-item-center">
                                <button type="submit" class="btn btn-primary mt-3 ms-auto" id="submitBtnEdit"><i
                                        class="fa fa-save"></i>
                                    Simpan</button>
                            </div>
                        </form>

                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#editRaporForm").submit(function(event) {
                event.preventDefault();

                let isValid = true;

                $(".nilai").removeClass("is-invalid");

                $(".nilai").each(function() {
                    let value = $(this).val().trim();
                    if (value === "" || isNaN(value)) {
                        $(this).addClass("is-invalid");
                        isValid = false;
                    }
                });

                if (!isValid) {
                    return;
                }

                let form = $("#editRaporForm");
                let formData = form.serialize();
                let submitBtn = $("#submitBtnRaport");
                let originalBtnText = submitBtn.html();

                submitBtn.prop("disabled", true).html(
                    `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Mengirim...`
                );

                $.ajax({
                    url: form.attr("action"),
                    method: "PUT",
                    data: formData,
                    success: function(response) {
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil",
                            text: "Data telah diperbarui",
                            confirmButtonText: "OK",
                            confirmButtonColor: "#18a342",
                        }).then(() => {
                            if (response.redirect) {
                                window.location.href = response.redirect;
                            } else {
                                location.reload();
                            }
                        });
                    },
                    error: function(xhr) {
                        let errorMessage = "Terjadi kesalahan, coba lagi.";
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        Swal.fire({
                            title: "Gagal!",
                            text: errorMessage,
                            icon: "error",
                        });
                    },
                    complete: function() {
                        submitBtn.prop("disabled", false).html(originalBtnText);
                    }
                });
            });

            $(".nilai").on("input", function() {
                $(this).removeClass("is-invalid");
            });
        });
    </script>
@endsection
