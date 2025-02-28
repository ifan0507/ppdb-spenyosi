@extends('layouts.portal.template')

@section('content')
    <div class="container text-center mt-5 mb-5">
        <h5>Masukkan Kode OTP Anda</h5>

        <form id="formVerifikasi">
            @csrf

            <div class="d-flex justify-content-center">
                @for ($i = 1; $i <= 6; $i++)
                    <input type="text" class="otp-input" id="otp{{ $i }}" maxlength="1">
                @endfor
            </div>

            <input type="hidden" name="otp" id="otp" required>
        </form>
    </div>

    <style>
        .otp-input {
            width: 40px;
            height: 40px;
            text-align: center;
            font-size: 20px;
            margin: 0 5px;
            border: 2px solid #ddd;
            border-radius: 5px;
        }

        .otp-input:focus {
            border-color: #007bff;
            outline: none;
        }
    </style>
    <script>
        $(document).ready(function() {
            const inputs = $(".otp-input");
            const hiddenInput = $("#otp");

            inputs.each(function(index) {
                $(this).on("input", function() {
                    if (this.value.length === 1 && index < inputs.length - 1) {
                        inputs.eq(index + 1).focus();
                    }
                    updateOtpValue();
                });

                $(this).on("keydown", function(e) {
                    if (e.key === "Backspace" && this.value === "" && index > 0) {
                        inputs.eq(index - 1).focus();
                    }
                });
            });

            function updateOtpValue() {
                let otpValue = "";
                inputs.each(function() {
                    otpValue += $(this).val();
                });

                hiddenInput.val(otpValue);

                if (otpValue.length === 6) {
                    submitOtp(otpValue);
                }
            }

            function submitOtp(otp) {
                $.ajax({
                    url: "/verify",
                    type: "POST",
                    data: $("#formVerifikasi").serialize(),
                    beforeSend: function() {
                        inputs.prop("disabled", true); // Matikan input saat proses
                    },
                    success: function(response) {
                        Swal.fire({
                            title: "Verifikasi Berhasil!",
                            text: "Anda akan diarahkan ke dashboard.",
                            icon: "success",
                            confirmButtonText: "OK",
                        }).then(() => {
                            window.location.href = response.redirect;
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: "Gagal!",
                            text: xhr.responseJSON.message || "Terjadi kesalahan, coba lagi.",
                            icon: "error",
                        });

                        inputs.prop("disabled", false); // Aktifkan input kembali
                        inputs.val(""); // Kosongkan input OTP
                        inputs.first().focus(); // Kembalikan fokus ke input pertama
                    }
                });
            }
        });
    </script>
@endsection
