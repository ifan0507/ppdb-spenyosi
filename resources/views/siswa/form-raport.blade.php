@extends('layouts.siswa.template')
@section('content')
    <div class="misc-content pt-4">
        @include('layouts.siswa.breadcrumb', [
            'breadcrumb' => [
                'Data raport' => route('raport'),
                'Tambah data raport' => '',
            ],
        ])
        <div class="container">
            @include('layouts.siswa.header-update')
            <div class="row justify-content-center">
                <div class="card card-primary card-outline card-outline-tabs col-md-12">
                    <div class="card-body">
                        <form action="{{ route('form-raport.post') }}" method="POST" id="raporForm">
                            @csrf
                            <input type="hidden" name="id_register" value="{{ $data->id }}">
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
                                        @foreach ($mapels as $index => $mapel)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    {{ $mapel->nama_matapelajaran }}
                                                    <input type="hidden" name="id_mapel[]" value="{{ $mapel->id }}">
                                                </td>
                                                <td>
                                                    <input type="text" name="kelas4_1[]"
                                                        class="form-control text-center nilai">
                                                    <div class="invalid-feedback">Harus diisi dan berupa angka!</div>
                                                </td>
                                                <td>
                                                    <input type="text" name="kelas4_2[]"
                                                        class="form-control text-center nilai">
                                                    <div class="invalid-feedback">Harus diisi dan berupa angka!</div>
                                                </td>
                                                <td>
                                                    <input type="text" name="kelas5_1[]"
                                                        class="form-control text-center nilai">
                                                    <div class="invalid-feedback">Harus diisi dan berupa angka!</div>
                                                </td>
                                                <td>
                                                    <input type="text" name="kelas5_2[]"
                                                        class="form-control text-center nilai">
                                                    <div class="invalid-feedback">Harus diisi dan berupa angka!</div>
                                                </td>
                                                <td>
                                                    <input type="text" name="kelas6_1[]"
                                                        class="form-control text-center nilai">
                                                    <div class="invalid-feedback">Harus diisi dan berupa angka!</div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="2"><strong>Rata-rata Nilai</strong></td>
                                            <td>
                                                <input type="text" name="rata_kelas4_sem1"
                                                    class="form-control text-center nilai">
                                                <div class="invalid-feedback">Harus diisi dan berupa angka!</div>
                                            </td>
                                            <td>
                                                <input type="text" name="rata_kelas4_sem2"
                                                    class="form-control text-center nilai">
                                                <div class="invalid-feedback">Harus diisi dan berupa angka!</div>
                                            </td>
                                            <td>
                                                <input type="text" name="rata_kelas5_sem1"
                                                    class="form-control text-center nilai">
                                                <div class="invalid-feedback">Harus diisi dan berupa angka!</div>
                                            </td>
                                            <td>
                                                <input type="text" name="rata_kelas5_sem2"
                                                    class="form-control text-center nilai">
                                                <div class="invalid-feedback">Harus diisi dan berupa angka!</div>
                                            </td>
                                            <td>
                                                <input type="text" name="rata_kelas6_sem1"
                                                    class="form-control text-center nilai">
                                                <div class="invalid-feedback">Harus diisi dan berupa angka!</div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-betwen align-item-center">
                                <button type="submit" class="btn btn-primary mt-3 ms-auto"><i class="fa fa-save"></i>
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
            $("#raporForm").submit(function(event) {
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

                let form = $("#raporForm");
                let formData = form.serialize();
                let submitBtn = $("#submitBtn");
                let originalBtnText = submitBtn.html();

                submitBtn.prop("disabled", true).html(
                    `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Mengirim...`
                );

                $.ajax({
                    url: form.attr("action"),
                    method: "POST",
                    data: formData,
                    success: function(response) {
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil",
                            text: "Data telah disimpan",
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
