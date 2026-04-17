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
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
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
              <th>Kondisi Buku</th>
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
                <td>{{ $pinjam->tanggal_kembali ? \Carbon\Carbon::parse($pinjam->tanggal_kembali)->format('d-m-Y') : '-' }}</td>
                <td>
                    @if ($pinjam->denda > 0)
                        <span class="text-danger">{{ $pinjam->denda }}</span>
                    @else
                        0
                    @endif
                </td>
                <td>
                    @if($pinjam->kondisi_buku == 'baik')
                        <span class="badge bg-success">Baik</span>
                    @elseif($pinjam->kondisi_buku == 'rusak')
                        <span class="badge bg-warning text-dark">Rusak</span>
                    @elseif($pinjam->kondisi_buku == 'hilang')
                        <span class="badge bg-danger">Hilang</span>
                    @else
                        <span class="badge bg-secondary">-</span>
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
                        @elseif($pinjam->status == 'meminjam') Dipinjam
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
                <td>
                    @if($pinjam->status == 'meminjam')
                    <form action="{{ route('petugas.kembali', $pinjam->id) }}" method="POST"
                        style="display: flex; gap: 8px; align-items: center; justify-content: center;">
                        @csrf
                        <input type="date" name="tanggal_kembali" class="form-control form-control-sm"
                            value="{{ date('Y-m-d') }}" required style="width: 130px;">

                        <select name="kondisi_buku" class="form-control form-control-sm" required style="width: 155px;">
                            <option value="">Pilih Kondisi</option>
                            <option value="baik">✅ Baik</option>
                            <option value="rusak">⚠️ Rusak (+30000)</option>
                            <option value="hilang">❌ Hilang (55000)</option>
                        </select>

                        <button type="submit" class="btn btn-sm btn-success">
                            <i class="fas fa-check"></i> Proses
                        </button>
                    </form>
                    @elseif($pinjam->status == 'selesai')
                        <span class="badge bg-success">Selesai</span>  <!-- ✅ INI YANG MUNCUL -->
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

<script>
function confirmKonfirmasi(form) {
    let tanggal = form.querySelector('input[name="tanggal_kembali"]').value;
    let kondisi = form.querySelector('select[name="kondisi_buku"]').value;
    let rencanaKembali = "{{ $pinjam->tanggal_pengembalian ?? '' }}";

    if (!tanggal) {
        alert('Pilih tanggal kembali!');
        return false;
    }

    if (!kondisi) {
        alert('Pilih kondisi buku terlebih dahulu!');
        return false;
    }

    let pesan = '⚠️ KONFIRMASI PENGEMBALIAN ⚠️\n\n';
    pesan += 'Tanggal Kembali: ' + tanggal + '\n';

    if (kondisi === 'baik') {
        pesan += 'Kondisi: BAIK (Tidak ada denda kerusakan)\n\n';
    } else if (kondisi === 'rusak') {
        pesan += 'Kondisi: RUSAK (Denda Rp 30.000)\n\n';
    } else if (kondisi === 'hilang') {
        pesan += 'Kondisi: HILANG (Denda Rp 55.000)\n\n';
    }

    pesan += 'Apakah data sudah sesuai dengan pengecekan fisik buku?';

    return confirm(pesan);
}
</script>
@endsection
