$(document).ready(function () {
    $(".btn-decline").on("click", function (e) {
        e.preventDefault();

        const id = $(this).data("id");

        Swal.fire({
            title: "Invalid Data Pendaftaran",
            input: "textarea",
            inputLabel: "Pesan Invalid Data",
            showCancelButton: true,
            cancelButtonText: "Batal",
            confirmButtonText: "Kirim",
            reverseButtons: true,
            background: "#",
            customClass: {
                popup: "swal2-custom-popup",
                input: "swal2-custom-input",
                confirmButton: "swal2-custom-confirm",
                cancelButton: "swal2-custom-cancel",
            },
            inputValidator: (value) => {
                if (!value) {
                    return "Pesan wajib diisi!";
                }
            },
            preConfirm: (message) => {
                Swal.showLoading();

                return new Promise((resolve, reject) => {
                    $.ajax({
                        url: `/admin/${id}/decline`,
                        method: "POST",
                        contentType: "application/json",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        data: JSON.stringify({
                            message: message,
                        }),
                        success: function (response) {
                            resolve();
                        },
                        error: function () {
                            Swal.hideLoading();
                            Swal.showValidationMessage(
                                "Terjadi kesalahan saat mengirim data."
                            );
                        },
                    });
                });
            },
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    "Berhasil!",
                    "Pesan telah disampaikan.",
                    "success"
                ).then(() => {
                    location.reload();
                });
            }
        });
    });

    $(".btn-confirm").on("click", function (e) {
        e.preventDefault();

        const id = $(this).data("id");

        Swal.fire({
            title: "Yakin?",
            text: "Data dikonfirmasi!",
            icon: "warning",
            showCancelButton: true,
            reverseButtons: true,
            confirmButtonColor: "#18a342",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes",
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Memverifikasi...",
                    text: "Mohon tunggu sebentar",
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    },
                });

                $.ajax({
                    url: `/admin/${id}/confirm`,
                    method: "GET",
                    success: function (response) {
                        Swal.fire(
                            "Berhasil!",
                            "Data telah diverifikasi",
                            "success"
                        ).then(() => {
                            location.reload();
                        });
                    },
                    error: function () {
                        Swal.fire(
                            "Gagal!",
                            "Terjadi kesalahan saat memverifikasi data",
                            "error"
                        );
                    },
                });
            }
        });
    });
});
