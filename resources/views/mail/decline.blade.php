<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Tidak Valid</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px;">

    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center">
                <table width="600px" cellspacing="0" cellpadding="0"
                    style="background: #ffffff; border-radius: 8px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1);">

                    <!-- HEADER -->
                    <tr>
                        <td align="center"
                            style="background: #f8f9fa; padding: 20px; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                            <table width="100%" cellspacing="0" cellpadding="0"
                                style="display: flex; align-items: center; justify-content: center;">
                                <tr>
                                    <td width="20%" align="right">
                                        <img src="https://smpn1yosowilangun.sch.id/wp-content/uploads/2024/01/logosmp1.png"
                                            alt="Logo Sekolah" width="50">
                                    </td>
                                    <td width="80%" align="left" style="padding-left: 15px;">
                                        <h2 style="color: #333; margin: 0; font-size: 18px;">SMP NEGERI 1 YOSOWILANGUN
                                        </h2>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- KONTEN EMAIL -->
                    <tr>
                        <td style="padding: 30px; text-align: left;">
                            <p style="color: #333;">Halo <strong>{{ $nama }}</strong>,</p>

                            <p style="color: #666;">Mohon maaf, data yang Anda kirimkan pada proses pendaftaran belum
                                bisa kami terima karena alasan berikut:</p>

                            <p
                                style="font-size: 18px; font-weight: bold; color: #e3342f; background: #f2f2f2; padding: 15px 20px; display: inline-block; border-radius: 5px;">
                                {{ $message }}
                            </p>

                            <p style="color: #666; margin-top: 20px;">Silakan periksa kembali data Anda dan lakukan
                                perbaikan jika diperlukan.</p>
                            <p style="color: #666;">Jika ada pertanyaan lebih lanjut, silakan hubungi panitia PPDB.</p>

                            <p><strong>Hormat kami,<br>Panitia PPDB SPENYOSI</strong></p>
                        </td>
                    </tr>

                    <!-- FOOTER -->
                    <tr>
                        <td align="center"
                            style="background: #f8f9fa; padding: 15px; font-size: 12px; color: #777; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px;">
                            © 2025 SMP Negeri 1 Yosowilangun. All rights reserved.
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>

</html>
