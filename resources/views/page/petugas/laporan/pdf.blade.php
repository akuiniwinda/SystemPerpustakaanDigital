<!DOCTYPE html>
<html>
<head>
    <title>Laporan Peminjaman Buku</title>
    <style>
        body { font-family: 'Times New Roman', serif; margin: 20px; }
        .header { text-align: center; border-bottom: 2px solid #000; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 6px; vertical-align: top; }
        th { background: #eaeaea; text-align: center; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .badge-lunas { color: #004d00; font-weight: bold; }
        .badge-belum { color: #990000; font-weight: bold; }
        .footer { margin-top: 30px; text-align: right; border-top: 1px solid #ccc; padding-top: 15px; }
    </style>
</head>
<body>
<div class="header">
    <h2>LAPORAN PEMINJAMAN DAN DENDA</h2>
    <p>Perpustakaan SMKN 3 Banjar</p>
</div>

<div class="periode">
    <strong>Periode Laporan:</strong>
    @if($filter == 'minggu')
        Minggu ini ({{ Carbon\Carbon::now()->startOfWeek()->format('d/m/Y') }} - {{ Carbon\Carbon::now()->endOfWeek()->format('d/m/Y') }})
    @elseif($filter == 'bulan')
        Bulan {{ Carbon\Carbon::now()->format('F Y') }}
    @elseif($filter == 'tahun')
        Tahun {{ Carbon\Carbon::now()->year }}
    @elseif($filter == 'custom' && $startDate && $endDate)
        {{ Carbon\Carbon::parse($startDate)->format('d/m/Y') }} s/d {{ Carbon\Carbon::parse($endDate)->format('d/m/Y') }}
    @else
        Semua data
    @endif
</div>

<!-- Ringkasan Statistik -->
<table style="width:100%; margin-bottom:20px; border:1px solid #999;">
    <tr>
        <td width="30%"><strong>Denda Dibayar</strong></td>
        <td width="20%">Rp {{ number_format($totalDendaDibayar,0,',','.') }}</td>
        <td width="30%"><strong>Total Pinjaman</strong></td>
        <td width="20%">{{ $jumlahPinjaman }} transaksi</td>
    </tr>
    <tr>
        <td><strong>Denda Belum</strong></td>
        <td>Rp {{ number_format($totalDendaBelumDibayar,0,',','.') }}</td>
        <td><strong>Jumlah Anggota</strong></td>
        <td>{{ $jumlahAnggota }} orang</td>
    </tr>
    <tr>
        <td><strong>Buku Dipinjam</strong></td>
        <td colspan="3">{{ $jumlahBukuDipinjam }} eksemplar</td>
    </tr>
</table>

<!-- Tabel Rincian -->
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Anggota</th>
            <th>Buku</th>
            <th>Denda (Rp)</th>
            <th>Status Denda</th>
            <th>Status Pinjam</th>
        </tr>
    </thead>
    <tbody>
        @forelse($pinjams as $key => $p)
        @php
            $totalDenda = (float)($p->denda ?? 0);
            $statusDenda = $p->status_denda ?? '';
            if ($totalDenda == 0) {
                $tampilanStatus = '-';
            } elseif ($statusDenda == 'lunas') {
                $tampilanStatus = '<span class="badge-lunas">LUNAS</span>';
            } elseif ($statusDenda == 'belum') {
                $tampilanStatus = '<span class="badge-belum">BELUM LUNAS</span>';
            } else {
                $tampilanStatus = '-';
            }
            $statusPinjam = is_null($p->tanggal_kembali) ? 'Dipinjam' : 'Kembali';
        @endphp
        <tr>
            <td class="text-center">{{ $key+1 }}</td>
            <td>{{ $p->anggota->nama ?? '-' }}</td>
            <td>{{ $p->buku->judul ?? '-' }}</td>
            <td class="text-right">{{ $totalDenda ? number_format($totalDenda,0,',','.') : '-' }}</td>
            <td class="text-center">{!! $tampilanStatus !!}</td>
            <td class="text-center">{{ $statusPinjam }}</td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center">Tidak ada data</td></tr>
        @endforelse
    </tbody>
</table>
</body>
</html>
