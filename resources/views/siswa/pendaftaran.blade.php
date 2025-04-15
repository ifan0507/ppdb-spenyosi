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
                                        <div class="card-header" id="headingOne">
                                            <h5 class="mb-0">Konfirmasi Pendaftaran</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="form-check">

                                                        <input class="form-check-input" type="checkbox"
                                                            id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault"
                                                            style="color: red;">
                                                            Saya menyatakan bahwa seluruh data dan persyaratan pendaftaran
                                                            jalur
                                                            <strong>{{ $data->jalur_ppdb }}</strong> yang saya isi adalah
                                                            benar dan sesuai.
                                                            Saya bertanggung jawab atas keabsahan data yang dikirimkan.
                                                        </label>
                                                    </div>
                                                    <br>
                                                    <form action="{{ route('post.pendaftaran', ['id' => $data->id]) }}"
                                                        method="POST" id="post-pendaftaran">
                                                        @csrf
                                                        <button type="submit" class="btn btn-primary" id="btnSubmit"
                                                            disabled>
                                                            <i class="fas fa-save"></i>
                                                            <span id="btnText">Kirim Data Pendaftaran</span>
                                                            <span id="btnLoading"
                                                                class="spinner-border spinner-border-sm d-none"
                                                                role="status" aria-hidden="true"></span>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
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
