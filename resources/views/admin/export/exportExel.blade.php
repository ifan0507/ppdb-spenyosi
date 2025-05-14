<!-- Clean Excel Export Table Structure -->
<table border="1" cellpadding="3" cellspacing="0" style="border-collapse: collapse;">
    <thead>
        <!-- Main Header Groups -->
        <tr>
            <th colspan="2" style="text-align: center; font-weight: bold; background-color: #f2f2f2;">IDENTITAS</th>
            <th colspan="10" style="text-align: center; font-weight: bold; background-color: #e6f2ff;">BIODATA SISWA
            </th>
            <!-- Dynamic column for specific enrollment path -->
            @if ($jalur == 'akademik' || $jalur == 'non-akademik')
                <th colspan="2" style="text-align: center; font-weight: bold; background-color: #ffe6e6;">DATA PRESTASI
                </th>
            @else
                <th colspan="1" style="text-align: center; font-weight: bold; background-color: #ffe6e6;">DATA KHUSUS
                    JALUR</th>
            @endif
            <th colspan="11" style="text-align: center; font-weight: bold; background-color: #e6ffe6;">DATA ORANG
                TUA/WALI</th>
        </tr>

        <!-- Detailed Headers -->
        <tr style="background-color: #f9f9f9;">
            <!-- IDENTITAS -->
            <th style="text-align: center; font-weight: bold;">No</th>
            <th style="text-align: center; font-weight: bold;">No Register</th>

            <!-- BIODATA SISWA -->
            <th style="text-align: center; font-weight: bold;">NISN</th>
            <th style="text-align: center; font-weight: bold;">NIK</th>
            <th style="text-align: center; font-weight: bold;">No KK</th>
            <th style="text-align: center; font-weight: bold;">Nama Lengkap</th>
            <th style="text-align: center; font-weight: bold;">Jenis Kelamin</th>
            <th style="text-align: center; font-weight: bold;">Tempat, Tanggal Lahir</th>
            <th style="text-align: center; font-weight: bold;">Alamat</th>
            <th style="text-align: center; font-weight: bold;">No HP</th>
            <th style="text-align: center; font-weight: bold;">Email</th>
            <th style="text-align: center; font-weight: bold;">Asal Sekolah</th>
            <th style="text-align: center; font-weight: bold;">Titik Koordinat Rumah</th>

            <!-- DATA KHUSUS JALUR -->
            @if ($jalur == 'zonasi')
                <th style="text-align: center; font-weight: bold;">Peringkat Zonasi (jarak)</th>
            @elseif ($jalur == 'afirmasi')
                <th style="text-align: center; font-weight: bold;">Jenis Afirmasi</th>
            @elseif ($jalur == 'raport')
                <th style="text-align: center; font-weight: bold;">Peringkat Raport (total rata-rata)</th>
            @elseif ($jalur == 'akademik' || $jalur == 'non-akademik')
                <th style="text-align: center; font-weight: bold;">Nama Lomba</th>
                <th style="text-align: center; font-weight: bold;">Perolehan</th>
            @endif

            <!-- DATA ORANG TUA/WALI -->
            <th style="text-align: center; font-weight: bold;">Nama Ayah/Wali</th>
            <th style="text-align: center; font-weight: bold;">Status Ayah/Wali</th>
            <th style="text-align: center; font-weight: bold;">Status Hubungan</th>
            @if (optional($pendaftarans->first())->register?->siswa?->ortu?->status_hubungan == 'Wali')
                <th style="text-align: center; font-weight: bold;">Hubungan Wali</th>
            @endif
            <th style="text-align: center; font-weight: bold;">Pekerjaan Ayah/Wali</th>
            <th style="text-align: center; font-weight: bold;">Pendidikan Ayah/Wali</th>
            <th style="text-align: center; font-weight: bold;">Nama Ibu</th>
            <th style="text-align: center; font-weight: bold;">Status Ibu</th>
            <th style="text-align: center; font-weight: bold;">Pekerjaan Ibu</th>
            <th style="text-align: center; font-weight: bold;">Pendidikan Ibu</th>
            <th style="text-align: center; font-weight: bold;">No HP Orang Tua/Wali</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pendaftarans as $no => $item)
            <tr>
                <!-- IDENTITAS -->
                <td style="text-align: center;">{{ $no + 1 }}</td>
                <td>{{ $item->register->no_register }}</td>

                <!-- BIODATA SISWA -->
                <td>{{ $item->register->siswa->nisn }}</td>
                <td>{{ $item->register->siswa->nik }}</td>
                <td>{{ $item->register->siswa->nik }}</td>
                <td>{{ $item->register->siswa->no_kk }}</td>
                <td>{{ $item->register->siswa->jenis_kelamin }}</td>
                <td>{{ $item->register->siswa->tempat_lahir }}, {{ $item->register->siswa->tanggal_lahir }}</td>
                <td>{{ $item->register->siswa->alamat }},{{ $item->register->siswa->rt }} /
                    {{ $item->register->siswa->rw }}, {{ $item->register->siswa->desa }},
                    {{ $item->register->siswa->kecamatan }}, {{ $item->register->siswa->kabupaten }}</td>
                <td>{{ $item->register->siswa->no_hp }}</td>
                <td>{{ $item->register->siswa->email }}</td>
                <td>{{ $item->register->siswa->asal_sekolah }}</td>
                <td>{{ $item->register->siswa->lokasi }}</td>

                <!-- DATA KHUSUS JALUR -->
                @if ($item->register->id_jalur == 6)
                    <td><strong>{{ $item->peringkat_raport ?? '-' }}</strong>
                        ({{ $item->register->rata_rata_raport?->total_rata_rata }})
                    </td>
                @elseif ($item->register->id_jalur == 1)
                    <td><strong>{{ $item->peringkat_zonasi ?? '-' }}</strong>
                        ({{ $item->register->siswa->jarak_sekolah }} km)</td>
                @elseif ($item->register->id_jalur == 2)
                    <td>{{ $item->register->afirmasi->jenis_afirmasi }}</td>
                @elseif ($item->register->id_jalur == 4)
                    <td>{!! $item->register->akademik->map(fn($a) => "$a->nama_prestasi")->implode('<br>') !!}</td>
                    <td>{!! $item->register->akademik->map(fn($a) => "{$a->perolehan} ({$a->tingkat_prestasi})")->implode('<br>') !!}</td>
                @elseif ($item->register->id_jalur == 5)
                    <td>{!! $item->register->nonAkademik->map(fn($a) => "$a->nama_prestasi")->implode('<br>') !!}</td>
                    <td>{!! $item->register->nonAkademik->map(fn($a) => "{$a->perolehan} ({$a->tingkat_prestasi})")->implode('<br>') !!}</td>
                @endif

                <!-- DATA ORANG TUA/WALI -->
                <td>{{ $item->register->siswa->ortu->ayah }}</td>
                <td>{{ $item->register->siswa->ortu->status_ayah }}</td>
                <td>{{ $item->register->siswa->ortu->status_hubungan }}</td>
                @if ($item->register->siswa->ortu->status_hubungan == 'Wali')
                    <td>{{ $item->register->siswa->ortu->hubungan_wali }}</td>
                @endif
                <td>{{ $item->register->siswa->ortu->pekerjaan_ayah }}</td>
                <td>{{ $item->register->siswa->ortu->pendidikan_ayah }}</td>
                <td>{{ $item->register->siswa->ortu->ibu }}</td>
                <td>{{ $item->register->siswa->ortu->status_ibu }}</td>
                <td>{{ $item->register->siswa->ortu->pekerjaan_ibu }}</td>
                <td>{{ $item->register->siswa->ortu->pendidikan_ibu }}</td>
                <td>{{ $item->register->siswa->ortu->no_hp }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
