<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Nilai Rapor SD/MI</title>
    <style>
        @media print {
            @page {
                size: A4;
                margin: 1cm;
            }

            body {
                font-family: Arial, sans-serif;
                font-size: 13px;
                line-height: 1.3;
            }

            .print-button {
                display: none;
            }

            .data-siswa td {
                padding: 3px 0;
            }
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            line-height: 1.3;
            margin: 0;
            padding: 10px;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        h1 {
            font-size: 14px;
            font-weight: bold;
            margin: 3px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        /* Menambahkan border untuk tabel utama */
        .main-table {
            border: 1px solid rgb(210, 210, 210);
        }

        .main-table th,
        .main-table td {
            border: 1px solid rgb(210, 210, 210);
            padding: 4px;
            text-align: center;
        }

        /* Pastikan semua kolom memiliki border */
        .main-table tr th:last-child,
        .main-table tr td:last-child {
            border-right: 1px solid rgb(210, 210, 210);
        }

        .main-table .kelompok-header {
            background-color: #dee2e6;
            font-weight: bold;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .signature table {
            width: 100%;
            margin-top: 10px;
        }

        .signature td {
            border: none;
            vertical-align: top;
            font-size: 12px;
        }

        .signature-space {
            height: 40px;
        }

        .text-underline {
            text-decoration: underline;
        }

        .print-button {
            position: fixed;
            top: 10px;
            right: 10px;
            padding: 6px 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        .print-button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>SISTEM PENERIMAAN MURID BARU (SPMB)</h1>
        <h1>TAHUN PELAJARAN 2025/2026</h1>
        <h1>REKAP NILAI KOMPETENSI PENGETAHUAN RAPOR SD/MI</h1>
    </div>

    <br>
    <!-- Data Siswa -->
    <table class="data-siswa" style="width: 100%; margin-bottom: 15px; border-collapse: collapse;">
        <tr>
            <td style="width: 15%; font-weight: bold;">Nama</td>
            <td style="width: 2%;">:</td>
            <td style="width: 33%;">{{ $siswa->siswa->nama ?? '....................................................' }}
            </td>
        </tr>
        <tr>
            <td style="width: 15%; font-weight: bold;">Tempat, Tanggal Lahir</td>
            <td style="width: 2%;">:</td>
            <td style="width: 33%;">
                {{ $siswa->siswa->tempat_lahir . ', ' . \Carbon\Carbon::parse($siswa->siswa->tanggal_lahir)->translatedFormat('d F Y') ?? '....................................................' }}
            </td>
        </tr>
        <tr>
            <td style="font-weight: bold;">NISN</td>
            <td>:</td>
            <td>{{ $siswa->siswa->nisn ?? '....................................................' }}</td>
        </tr>
        <tr>
            <td style="width: 15%; font-weight: bold;">Asal Sekolah</td>
            <td style="width: 2%;">:</td>
            <td style="width: 33%;">
                {{ $siswa->siswa->asal_sekolah ?? '....................................................' }}
            </td>
        </tr>
    </table>

    <table class="main-table">
        <thead>
            <tr>
                <th rowspan="2">No
                </th>
                <th rowspan="2">Mata
                    Pelajaran</th>
                <th colspan="2">
                    Rapor
                    Kelas 4</th>
                <th colspan="2">
                    Rapor
                    Kelas 5</th>
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
            @php
                $indexA = 1;
                $indexB = 7;
            @endphp
            <tr>
                <td colspan="7" class="kelompok-header">
                    <strong>Kelompok A</strong>
                </td>
            </tr>
            @foreach ($raports as $raport)
                @if (in_array($raport->mapel->nama_matapelajaran, [
                        'Pendidikan Agama',
                        'Pendidikan Pancasila & Kewarganegaraan',
                        'Bahasa Indonesia',
                        'Matematika',
                        'Ilmu Pengetahuan Alam (IPA)',
                        'Ilmu Pengetahuan Sosial (IPS)',
                    ]))
                    <tr>
                        <td>{{ $indexA++ }}.</td>
                        <td>{{ $raport->mapel->nama_matapelajaran }}
                        </td>
                        <td>{{ $raport->kelas4_1 }}</td>
                        <td>{{ $raport->kelas4_2 }}</td>
                        <td>{{ $raport->kelas5_1 }}</td>
                        <td>{{ $raport->kelas5_2 }}</td>
                        <td>{{ $raport->kelas6_1 }}</td>
                    </tr>
                @endif
            @endforeach

            <tr>
                <td colspan="7" class="kelompok-header">
                    <strong>Kelompok B</strong>
                </td>
            </tr>
            @foreach ($raports as $raport)
                @if (in_array($raport->mapel->nama_matapelajaran, ['Seni Budaya dan Prakarya', 'Pend. Jasmani, Olahraga dan Kesehatan']))
                    <tr>
                        <td>{{ $indexB++ }}.</td>
                        <td>{{ $raport->mapel->nama_matapelajaran }}
                        </td>
                        <td>{{ $raport->kelas4_1 }}</td>
                        <td>{{ $raport->kelas4_2 }}</td>
                        <td>{{ $raport->kelas5_1 }}</td>
                        <td>{{ $raport->kelas5_2 }}</td>
                        <td>{{ $raport->kelas6_1 }}</td>
                    </tr>
                @endif
            @endforeach

            @php
                $bahasaJawa = $raports->firstWhere('mapel.nama_matapelajaran', 'Bahasa Jawa');
            @endphp
            @if ($bahasaJawa)
                <tr>
                    <td rowspan="2">{{ $indexB++ }}.</td>
                    <td colspan="6" style="text-align: left"><b>Muatan
                            Lokal</b></td>
                </tr>
                <tr>
                    <td>{{ $bahasaJawa->mapel->nama_matapelajaran }}
                    </td>
                    <td>{{ $bahasaJawa->kelas4_1 }}</td>
                    <td>{{ $bahasaJawa->kelas4_2 }}</td>
                    <td>{{ $bahasaJawa->kelas5_1 }}</td>
                    <td>{{ $bahasaJawa->kelas5_2 }}</td>
                    <td>{{ $bahasaJawa->kelas6_1 }}</td>
                </tr>
            @endif
            @if (!$raports->isEmpty())
                <tr>
                    <td colspan="2"><strong>Rata-rata
                            Nilai</strong>
                    </td>
                    <td>{{ $raports->avg('rata_kelas4_sem1') }}
                    </td>
                    <td>{{ $raports->avg('rata_kelas4_sem2') }}
                    </td>
                    <td>{{ $raports->avg('rata_kelas5_sem1') }}
                    </td>
                    <td>{{ $raports->avg('rata_kelas5_sem2') }}
                    </td>
                    <td>{{ $raports->avg('rata_kelas6_sem1') }}
                    </td>
                </tr>
            @endif
        </tbody>

    </table>

    <div class="signature">
        <table>
            <tr>
                <td style="width: 60%"></td>
                <td style="width: 40%; text-align: center;">
                    <p>........................, .... ............. 2025</p>
                    <p>Kepala SD/MI</p>
                    <div class="signature-space"></div>
                    <p class="text-underline">...............................................................</p>
                    <p>NIP. .......................................................</p>
                </td>
            </tr>
        </table>
    </div>

</body>

</html>
