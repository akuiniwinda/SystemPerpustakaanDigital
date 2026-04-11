@extends('layout.petugas.app')
@section('content')
<div class="col-lg-15 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
            <h4 class="card-title mb-0">Tabel Peminjaman Buku</h4>
            <div class="d-flex gap-2">
                <form method="GET" action="{{ route('petugas.pinjam.index') }}" id="searchForm">
                    <div class="input-group" style="width: 260px;">
                        <div class="input-group-prepend hover-cursor" id="searchIcon" style="cursor: pointer;">
                            <span class="input-group-text">
                                <i class="icon-search"></i>
                            </span>
                        </div>
                        <input type="text" name="search" class="form-control" id="searchInput"
                            placeholder="Cari nama atau judul..."
                            value="{{ request('search') }}"
                            aria-label="search">
                    </div>
                </form>
            </div>
        </div>
      <div class="mb-3">
       <a href="{{ route('petugas.pengajuan.denda') }}" class="btn btn-success btn-sm">
            Konfirmasi Denda
        </a>
      </div>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Nama</th>
              <th>Judul Buku</th>
              <th>Tanggal Pinjam</th>
              <th>Rencana Kembali</th>
              <th>Tanggal Kembali</th>
              <th>Denda</th>
              <th>Status</th>
              <th>Proses Pinjam</th>
              <th>Proses Kembali</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($Pinjambuku as $pinjam)
            <tr>
                <td>{{ $pinjam->anggota->nama }}</td>
                <td>{{ $pinjam->buku->judul }}</td>
                <td>{{ \Carbon\Carbon::parse($pinjam->tanggal_pinjam)->format('d-m-Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($pinjam->tanggal_pengembalian)->format('d-m-Y') }}</td>
                <td>{{ $pinjam->tanggal_kembali }}</td>
                <td>
                    @if ($pinjam->denda > 0)
                        <span class="text-danger">Rp {{ number_format($pinjam->denda) }}</span>
                    @else
                        -
                    @endif
                </td>
                <td>
                    <span class="badge border
                        @if($pinjam->status == 'ditolak') border-danger text-danger
                        @elseif($pinjam->status == 'pengajuan') border-warning text-warning
                        @elseif($pinjam->status == 'meminjam') border-info text-info
                        @elseif($pinjam->status == 'selesai') border-success text-success
                        @endif
                    ">
                        @if($pinjam->status == 'pengajuan') Menunggu Konfirmasi
                        @elseif($pinjam->status == 'meminjam') Sedang Dipinjam
                        @elseif($pinjam->status == 'selesai') Selesai
                        @else {{ ucfirst($pinjam->status) }}
                        @endif
                    </span>
                </td>
                <td class="text-center">
                    @if($pinjam->status == 'pengajuan')
                        <a href="{{ route('petugas.pinjam.show', $pinjam->id) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-check-circle"></i> Proses
                        </a>
                    @elseif($pinjam->status == 'meminjam')
                        <span class="badge bg-secondary">Sedang dipinjam</span>
                    @elseif($pinjam->status == 'selesai')
                        <span class="badge bg-success">Selesai</span>
                    @elseif($pinjam->status == 'ditolak')
                        <span class="badge bg-danger">Ditolak</span>
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>
                <td class="text-center">
                    @if($pinjam->status == 'meminjam')
                        @if($pinjam->pengajuan_pengembalian)
                            <form action="{{ route('petugas.kembali', $pinjam->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">
                                    <i class="fas fa-undo-alt"></i> Konfirmasi Kembali
                                </button>
                            </form>
                        @else
                            <span class="badge bg-warning text-dark">Menunggu pengajuan</span>
                        @endif
                    @elseif($pinjam->status == 'selesai')
                        <span class="badge bg-success">Selesai</span>
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <!-- Info & Pagination -->
        @if ($Pinjambuku->total() > 0)
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                <div class="text-muted small mb-2 mb-sm-0">
                    Menampilkan {{ $Pinjambuku->firstItem() }} sampai {{ $Pinjambuku->lastItem() }} dari {{ $Pinjambuku->total() }} data
                </div>
                <div>
                    {{ $Pinjambuku->links('pagination::simple-bootstrap-5') }}
                </div>
            </div>
        @else
            <div class="text-center text-muted mt-4">
                Tidak ada data peminjaman.
            </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
