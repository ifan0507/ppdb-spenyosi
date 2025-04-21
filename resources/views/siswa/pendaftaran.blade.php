@extends('layouts.siswa.template')
@section('content')
    <div class="misc-content pt-4">
        <div class="container">
            <div class="alert alert-primary">
                <i class="fas fa-check"></i>
                Jalur PPDB {{ $data->jalur->nama_jalur }}
            </div>
            <div class="row justify-content-center">
                <div class="card card-primary card-outline card-outline-tabs m-0 p-0 col-md-12">
                    <div class="card-header p-0 border-bottom-0">
                    </div>
                    <div class="card-body p-0">
                        <div class="accordion" id="accordionExample">
                            <div class="card card-primary card-outline">
                                @include('layouts.siswa.status_berkas')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="card card-primary card-outline card-outline-tabs col-md-12">
                    @include('layouts.siswa.tab-content')
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="card-body p-0">
                                <div class="accordion" id="accordionExample">
                                    <div class="card card-primary card-outline">

                                        <div class="card-body">
                                            <div class="row">
                                                {{-- Kartu Jalur Pendaftaran --}}
                                                <div class="col-md-4 mb-4">
                                                    <div class="card shadow-sm border rounded-3">
                                                        <div class="card-body">
                                                            <h5 class="fw-bold">{{ $data->jalur->nama_jalur }}</h5>
                                                            <p class="text-muted">{{ $data->jalur->keterangan }}</p>
                                                            <hr>
                                                            <form
                                                                action="{{ route('post.pendaftaran', ['id' => $data->id]) }}"
                                                                method="POST" id="post-pendaftaran">
                                                                @csrf

                                                                @if ($data->submit == '0')
                                                                    <button type="submit" class="btn btn-primary w-100"
                                                                        id="btnSubmit">
                                                                        <i class="fas fa-save me-1"></i>
                                                                        <span id="btnText">
                                                                            Kirim Data Pendaftaran
                                                                        </span>
                                                                        <span id="btnLoading"
                                                                            class="spinner-border spinner-border-sm d-none"
                                                                            role="status" aria-hidden="true"></span>
                                                                    </button>
                                                                @else
                                                                    <button type="button" class="btn btn-success w-100"
                                                                        style="cursor: not-allowed;">
                                                                        SUDAH MENDAFTAR
                                                                    </button>
                                                                @endif
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-8">
                                                    <div class="card shadow-sm border rounded-3">
                                                        <div class="card-header fw-bold"
                                                            style="background-color: rgb(237, 234, 234)">
                                                            Detil Seleksi - {{ $data->jalur->nama_jalur }} </div>
                                                        <div class="card-body p-0">
                                                            <table class="table table-bordered mb-0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td style="width: 30%;">No. Pendaftaran</td>
                                                                        <td>
                                                                            {{ $data->no_register }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Pilihan Jalur</td>
                                                                        <td>
                                                                            {{ $data->jalur->nama_jalur }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Status Pendaftaran</td>
                                                                        <td>
                                                                            @if ($data->pendaftaran)
                                                                                @if ($data->pendaftaran->confirmations == '1')
                                                                                    <span class="badge bg-success"><i
                                                                                            class="fa-solid fa-circle-check"></i>
                                                                                        {{ $data->pendaftaran->status }}</span>
                                                                                @elseif ($data->pendaftaran->decline == '1')
                                                                                    <span class="badge bg-danger"><i
                                                                                            class="fa-solid fa-triangle-exclamation"></i>
                                                                                        {{ $data->pendaftaran->status }}</span>
                                                                                @else
                                                                                    belum dikonfirmasi admin
                                                                                    <span class="badge bg-warning"><i
                                                                                            class="fa-solid fa-clock"></i>
                                                                                        pending
                                                                                    </span>
                                                                                @endif
                                                                            @else
                                                                                <span class="text-muted text-red">Belum
                                                                                    Submit
                                                                                    Data</span>
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Tanggal Daftar</td>
                                                                        <td>
                                                                            @if ($data->pendaftaran)
                                                                                {{ $data->pendaftaran->created_at->format('d M Y, H:i') }}
                                                                            @else
                                                                                <span class="text-muted text-red">Belum
                                                                                    Submit
                                                                                    Data</span>
                                                                            @endif
                                                                        </td>
                                                                    </tr>

                                                                </tbody>
                                                            </table>

                                                        </div>
                                                    </div>
                                                    @if ($data->submit == '0')
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value=""
                                                                id="flexCheckDefault">
                                                            <label class="form-check-label" for="flexCheckDefault"
                                                                style="color: red;">
                                                                Saya menyatakan data yang saya isi benar dan dapat
                                                                dipertanggungjawabkan. Jika terdapat kekeliruan, saya
                                                                siap menerima konsekuensi dari pihak sekolah.
                                                            </label>
                                                        </div>
                                                    @endif

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>

            <script>
                $(document).ready(function() {

                    $("#btnSubmit").prop("disabled", true);

                    $("#flexCheckDefault").on("change", function() {
                        if ($(this).is(":checked")) {
                            $("#btnSubmit").prop("disabled", false);
                        } else {
                            $("#btnSubmit").prop("disabled", true);
                        }
                    });

                    $("#post-pendaftaran").on("submit", function(e) {
                        e.preventDefault();
                        $("#btnSubmit").attr("disabled", true);
                        $("#btnLoading").removeClass("d-none");

                        $.ajax({
                            url: $("#post-pendaftaran").attr("action"),
                            type: "POST",
                            data: $("#post-pendaftaran").serialize(),
                            success: function(response) {
                                $("#btnSubmit").attr("disabled", false);
                                $("#btnLoading").addClass("d-none");
                                Swal.fire({
                                    title: "Berhasil!",
                                    text: "dikirim!",
                                    icon: "success",
                                    confirmButtonText: "OK",
                                    confirmButtonColor: "#18a342",
                                }).then(() => {
                                    window.location.href = response
                                        .redirect;
                                });
                            },
                            error: function(xhr) {
                                $("#btnSubmit").attr("disabled", false);
                                $("#btnLoading").addClass("d-none");
                                let errorMessages = "";
                                if (xhr.responseJSON && xhr.responseJSON.errors) {
                                    $.each(xhr.responseJSON.errors, function(key, value) {
                                        errorMessages = xhr.responseJSON.errors.join("\n");
                                    });
                                } else {
                                    errorMessages = "Terjadi kesalahan, silakan coba lagi.";
                                }
                                Swal.fire({
                                    title: "Error!",
                                    text: errorMessages,
                                    icon: "error",
                                })
                            }
                        })
                    })
                })
            </script>
        @endsection
