<table>
    <thead>
        <tr>
            <th>No</th>
            <th>No Register</th>
            <th>Nama</th>
            <th>Peringkat Zonasi</th>
            <th>Jarak Sekolah</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pendaftarans as $no => $item)
            <tr>
                <td>{{ $no + 1 }}</td>
                <td>{{ $item->register->no_register }}</td>
                <td>{{ $item->register->siswa->nama }}</td>
                <td>{{ $item->peringkat_zonasi ?? '-' }}</td>
                <td>{{ $item->register->siswa->jarak_sekolah }} km</td>
            </tr>
        @endforeach
    </tbody>
</table>
