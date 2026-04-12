@extends('layout.petugas.app')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Laporan Peminjaman Buku</h4>

      <!-- FORM FILTER -->
      <form method="GET" action="{{ route('petugas.laporan.index') }}" class="mb-4">
        <div class="row align-items-end">
          <div class="col-md-2">
            <label>Filter Periode</label>
            <select name="filter" class="form-control" onchange="toggleDateRange(this.value)">
              <option value="semua" {{ $filter == 'semua' ? 'selected' : '' }}>Semua Data</option>
              <option value="minggu" {{ $filter == 'minggu' ? 'selected' : '' }}>Minggu Ini</option>
              <option value="bulan" {{ $filter == 'bulan' ? 'selected' : '' }}>Bulan Ini</option>
              <option value="tahun" {{ $filter == 'tahun' ? 'selected' : '' }}>Tahun Ini</option>
              <option value="custom" {{ $filter == 'custom' ? 'selected' : '' }}>Custom Range</option>
            </select>
          </div>
          <div class="col-md-3" id="dateRangeStart" style="{{ $filter == 'custom' ? '' : 'display:none' }}">
            <label>Dari Tanggal</label>
            <input type="date" name="start_date" class="form-control" value="{{ $startDate ?? '' }}">
          </div>
          <div class="col-md-3" id="dateRangeEnd" style="{{ $filter == 'custom' ? '' : 'display:none' }}">
            <label>Sampai Tanggal</label>
            <input type="date" name="end_date" class="form-control" value="{{ $endDate ?? '' }}">
          </div>
          <div class="col-md-2">
            <button type="submit" class="btn btn-primary btn-sm">Tampilkan</button>
            <a href="{{ route('petugas.laporan.index') }}" class="btn btn-secondary btn-sm">Reset</a>
          </div>
        </div>
      </form>

      <!-- Tombol Download PDF (bawa filter yang aktif) -->
      <div class="mb-3">
        <a href="{{ route('petugas.laporan.download') }}?filter={{ $filter }}&start_date={{ $startDate }}&end_date={{ $endDate }}" class="btn btn-success btn-sm">
          Download PDF (sesuai filter)
        </a>
      </div>

      <!-- RINGKASAN STATISTIK (sama seperti sebelumnya) -->
      <div class="row mb-4">
        <div class="col-md-2">
          <div class="alert alert-success text-center py-2">
            <strong>Denda Dibayar</strong><br>
            Rp {{ number_format($totalDendaDibayar, 0, ',', '.') }}
          </div>
        </div>
        <div class="col-md-2">
          <div class="alert alert-danger text-center py-2">
            <strong>Denda Belum</strong><br>
            Rp {{ number_format($totalDendaBelumDibayar, 0, ',', '.') }}
          </div>
        </div>
        <div class="col-md-2">
          <div class="alert alert-info text-center py-2">
            <strong>Anggota</strong><br>
            {{ $jumlahAnggota }} orang
          </div>
        </div>
        <div class="col-md-2">
          <div class="alert alert-primary text-center py-2">
            <strong>Total Pinjaman</strong><br>
            {{ $jumlahPinjaman }} transaksi
          </div>
        </div>
        <div class="col-md-2">
          <div class="alert alert-warning text-center py-2">
            <strong>Dipinjam</strong><br>
            {{ $jumlahBukuDipinjam }} buku
          </div>
        </div>
      </div>

      <!-- TABEL RINCIAN (sama) -->
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Anggota</th>
              <th>Judul Buku</th>
              <th>Total Denda (Rp)</th>
              <th>Status Denda</th>
              <th>Tanggal Kembali</th>
              <th>Status Pinjam</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($pinjams as $key => $pinjam)
            @php
                $totalDenda = (float)($pinjam->denda ?? 0);
                $statusDenda = $pinjam->status_denda ?? '';
                if ($totalDenda == 0) {
                    $tampilanStatus = '-';
                } elseif ($statusDenda == 'lunas') {
                    $tampilanStatus = '<span class="badge bg-success">LUNAS</span>';
                } elseif ($statusDenda == 'belum') {
                    $tampilanStatus = '<span class="badge bg-danger">BELUM LUNAS</span>';
                } else {
                    $tampilanStatus = '-';
                }
                $statusPinjam = is_null($pinjam->tanggal_kembali) ? 'Dipinjam' : 'Kembali';
            @endphp
            <tr>
              <td>{{ $key + 1 }}</td>
              <td>{{ $pinjam->anggota->nama ?? '-' }}</td>
              <td>{{ $pinjam->buku->judul ?? '-' }}</td>
              <td class="text-end">{{ $totalDenda ? number_format($totalDenda,0,',','.') : '-' }}</td>
              <td>{!! $tampilanStatus !!}</td>
              <td>{{ $pinjam->tanggal_kembali ?? '-' }}</td>
              <td>
                @if($statusPinjam == 'Dipinjam')
                  <span class="badge bg-warning">Dipinjam</span>
                @else
                  <span class="badge bg-secondary">Kembali</span>
                @endif
              </td>
            </tr>
            @empty
            <tr><td colspan="7" class="text-center">Tidak ada data untuk periode yang dipilih.</td>
            @endforelse
          </tbody>
        </table>
        @if ($pinjams->total() > 0)
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                <div class="text-muted small mb-2 mb-sm-0">
                    Menampilkan {{ $pinjams->firstItem() }} sampai {{ $pinjams->lastItem() }} dari {{ $pinjams->total() }} data
                </div>
                <div>
                    {{ $pinjams->links('pagination::simple-bootstrap-5') }}
                </div>
            </div>
        @else
            <div class="text-center text-muted mt-4">
                Tidak ada riwayat peminjaman.
            </div>
        @endif
      </div>

      <!-- Upload form (tetap) -->
      <form action="{{ route('petugas.laporan.upload') }}" method="POST" enctype="multipart/form-data" class="mt-4">
        @csrf
        <input type="file" name="file" required>
        <button class="btn btn-primary btn-sm">Upload Laporan</button>
      </form>

    </div>
  </div>
</div>

<!-- JavaScript untuk toggle custom date range -->
<script>
function toggleDateRange(value) {
    var startDiv = document.getElementById('dateRangeStart');
    var endDiv = document.getElementById('dateRangeEnd');
    if (value === 'custom') {
        startDiv.style.display = 'block';
        endDiv.style.display = 'block';
    } else {
        startDiv.style.display = 'none';
        endDiv.style.display = 'none';
    }
}
</script>
@endsection
