<table>
    <thead>
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">No Register</th>
            <th colspan="11">BIODATA SISWA</th>
            {{-- @if (optional($pendaftarans->first())->register?->siswa?->ortu?->status_hubungan == 'Wali')
                <th colspan="11">ORANG TUA/WALI</th>
            @else
                <th colspan="10">ORANG TUA/WALI</th>
            @endif --}}
            <th colspan="9">ORANG TUA/WALI</th>
        </tr>
        <tr>
            <th>NISN</th>
            <th>NIK</th>
            <th>Nama Lengkap</th>
            <th>Jenis Kelamin</th>
            <th>Tempat, Tanggal Lahir</th>
            <th>Alamat</th>
            <th>No HP</th>
            <th>Email</th>
            <th>Asal Sekolah</th>
            <th>Titik Koordinat Rumah</th>
            @if ($jalur == 'zonasi')
                <th>Peringkat Zonasi(jarak)</th>
            @elseif ($jalur == 'afirmasi')
                <th>Jenis Afirmasi</th>
            @elseif ($jalur == 'raport')
                <th>Peringkat Raport(total rata rata)</th>
            @endif

            <th>Nama Ayah/Wali</th>
            <th>Status Ayah/Wali</th>
            {{-- <th>Status Hubungan</th>
            @if (optional($pendaftarans->first())->register?->siswa?->ortu?->status_hubungan == 'Wali')
                <th>Hubungan Wali</th>
            @endif --}}
            <th>Pekerjaan Ayah/Wali</th>
            <th>Pendidikan Ayah/Wali</th>
            <th>Nama Ibu</th>
            <th>Status Ibu</th>
            <th>Pekerjaan Ibu</th>
            <th>Pendidikan Ibu</th>
            <th>No HP Orang Tua/Wali</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pendaftarans as $no => $item)
            <tr>
                <td>{{ $no + 1 }}</td>
                <td>{{ $item->register->no_register }}</td>
                <td>{{ $item->register->siswa->nisn }}</td>
                <td>{{ $item->register->siswa->nik }}</td>
                <td>{{ $item->register->siswa->nama }}</td>
                <td>{{ $item->register->siswa->jenis_kelamin }}</td>
                <td>{{ $item->register->siswa->tempat_lahir . ',' . $item->register->siswa->tangal_lahir }}</td>
                <td>{{ $item->register->siswa->alamat . ',' . $item->register->siswa->desa . ',' . $item->register->siswa->kecamatan . ',' . $item->register->siswa->kabupaten }}
                </td>
                <td>{{ $item->register->siswa->no_hp }}</td>
                <td>{{ $item->register->siswa->email }}</td>
                <td>{{ $item->register->siswa->asal_sekolah }}</td>
                <td>{{ $item->register->siswa->lokasi }}</td>
                @if ($item->register->id_jalur == 5)
                    <td>
                        <strong>{{ $item->peringkat_raport ?? '-' }}</strong>
                        ({{ $item->register->rata_rata_raport->total_rata_rata }})
                    </td>
                @elseif ($item->register->id_jalur == 1)
                    <td>
                        <strong>{{ $item->peringkat_zonasi ?? '-' }}</strong>
                        ({{ $item->register->siswa->jarak_sekolah }} km)
                    </td>
                @elseif ($item->register->id_jalur == 2)
                    <td>
                        {{ $item->register->afirmasi->jenis_afirmasi }}
                    </td>
                @endif
                <td>{{ $item->register->siswa->ortu->ayah }}</td>
                <td>{{ $item->register->siswa->ortu->status_ayah }}</td>
                {{-- <td>{{ $item->register->siswa->ortu->status_hubungan }}</td>
                @if ($item->register->siswa->ortu->hubungan_wali == 'Wali')
                    <td>{{ $item->register->siswa->ortu->hubungan_wali }}</td>
                @endif --}}
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
