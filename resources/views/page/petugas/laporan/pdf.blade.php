<!DOCTYPE html>
<html>
<head>
    <title>Laporan Peminjaman</title>
    <style>
        body {
            font-family: sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #eee;
        }
    </style>
</head>
<body>

<h3 style="text-align:center;">LAPORAN PEMINJAMAN BUKU</h3>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Buku</th>
            <th>Denda</th>
            <th>Tanggal Kembali</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($pinjams as $key => $pinjam)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $pinjam->anggota->nama }}</td>
            <td>{{ $pinjam->buku->judul }}</td>
            <td>
                @if($pinjam->denda > 0)
                    Rp {{ number_format($pinjam->denda) }}
                @else
                    -
                @endif
            </td>
            <td>{{ $pinjam->tanggal_kembali ?? '-' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
