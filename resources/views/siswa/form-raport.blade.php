@extends('layouts.siswa.template')
@section('content')
    <div class="misc-content pt-4">
        @include('layouts.siswa.breadcrumb')
        <div class="container">
            @include('layouts.siswa.header-update')
            <div class="row justify-content-center">
                <div class="card card-primary card-outline card-outline-tabs col-md-12">
                    <div class="card-body">
                        <div class="alert  mb-3" style="background-color: #d4eefa; color: #1c759e">
                            <div class="row align-items-center">
                                <div class="col text-center" style="flex: 0 0 5%;">
                                    <i class="fas fa-info-circle fa-2x"></i>
                                </div>
                                <div class="col">

                                    <p class="mb-0 text-navi">
                                        1. Nilai yang dimasukan adalah Nilai Kompetensi Pengetahuan <br>
                                        2. Siswa dari MI jika Nilai Agama tidak berdiri sendiri, Nilai Pendidikan Agama
                                        adalah rerata nilai Keagamaan yang diajarkan (misal: Al Quran Hadits, Akidah Akhlaq,
                                        Fiqih, Sejarah Islam ...dll)

                                    </p>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('form-raport.post') }}" method="POST" id="raporForm">
                            @csrf
                            <input type="hidden" name="id_register" value="{{ $data->id }}">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center table-rapor">
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
                                        <tr>
                                            <td colspan="8" class="kelompok-header text-left">
                                                <strong>Kelompok A</strong>
                                            </td>
                                        </tr>
                                        @foreach ($mapels->take(6) as $index => $mapel)
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
                                            <td colspan="8" class="kelompok-header text-left">
                                                <strong>Kelompok B</strong>
                                            </td>
                                        </tr>

                                        @foreach ($mapels->skip(6)->take(2) as $index => $mapel)
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

                                        @php
                                            $mapel = $mapels->firstWhere('nama_matapelajaran', 'Bahasa Jawa');
                                        @endphp
                                        @if ($mapel)
                                            <tr>
                                                <td rowspan="2">9</td>
                                                <td colspan="7" class="text-left"><b>Muatan
                                                        Lokal</b></td>
                                            <tr>
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

                                            </tr>
                                        @endif
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
                            <div class="row justify-content-center">
                                <div class="col-sm-8 col-lg-6">
                                    <button type="submit" class="btn btn-primary btn-block" id="btnCreate"><i
                                            class="fas fa-save" id="fa_create"></i> <span id="textCreate"> Save
                                            Data</span>
                                        <span id="loadingCreate" class="spinner-border spinner-border-sm d-none"
                                            role="status" aria-hidden="true"></span>
                                    </button>
                                </div>
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
                $("#btnCreate").attr("disabled", true);
                $("#fa_create").addClass("d-none");
                $("#textCreate").addClass("d-none");
                $("#loadingCreate").removeClass("d-none");

                $.ajax({
                    url: form.attr("action"),
                    method: "POST",
                    data: formData,
                    success: function(response) {
                        $("#btnCreate").attr("disabled", true);
                        $("#fa_create").removeClass("d-none");
                        $("#textCreate").removeClass("d-none");
                        $("#loadingCreate").addClass("d-none");
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
                        $("#btnCreate").attr("disabled", true);
                        $("#fa_create").removeClass("d-none");
                        $("#textCreate").removeClass("d-none");
                        $("#loadingCreate").addClass("d-none");
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
