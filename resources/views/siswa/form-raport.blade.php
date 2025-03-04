@extends('layouts.siswa.template')
@section('content')
    <div class="misc-content pt-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="card card-primary card-outline card-outline-tabs m-0 p-0 col-md-12">
                    <div class="card-header p-0 border-bottom-0">
                    </div>
                    <div class="card-body p-0">
                        <div class="accordion" id="accordionExample">
                            <div class="card card-primary card-outline">
                                <div class="card-header" id="headingOne">
                                    <h5 class="row justify-content-between">
                                        <div class="col-8 pt-lg-2">
                                            <h4 class="font-bold" style="display: inline-block";>
                                                Form input raport
                                            </h4>
                                        </div>

                                    </h5>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="card card-primary card-outline card-outline-tabs col-md-12">
                    <div class="card-body">
                        <form action="#" method="POST" id="raporForm">
                            @csrf
                            <input type="hidden" name="id_siswa" value="{{ $data->siswa->id }}">
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
                let isValid = true;
                $(".nilai").each(function() {
                    let value = $(this).val().trim();

                    if (value === "" || isNaN(value)) {
                        $(this).addClass("is-invalid");
                        isValid = false;
                    } else {
                        $(this).removeClass("is-invalid");
                    }
                });
                if (!isValid) {
                    event.preventDefault();
                }
            });

            $(".nilai").on("input", function() {
                $(this).removeClass("is-invalid");
            });
        })
    </script>
@endsection
