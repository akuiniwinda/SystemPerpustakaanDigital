@extends('layout.petugas.app')
@section('content')
<div class="col-lg-15 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Tabel Peminjaman Buku</h4>
      <div class="mb-3">
       <a href="{{ route('petugas.pengajuan.denda') }}" class="btn btn-success btn-sm">
            Konfirmasi Denda
        </a>
      </div>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Foto</th>
              <th>Nama</th>
              <th>Judul Buku</th>
              <th>Tanggal Pinjam</th>
              <th>Rencana Kembali</th>
              <th>Denda</th>
              <th>Status</th>
              <th>Proses Pinjam</th>
              <th>Proses Kembali</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($Pinjambuku as $pinjam)
            <tr>
                <td>
                    <img src="{{ asset('storage/'.$pinjam->anggota->foto) }}"
                         style="width:50px;height:50px;border-radius:50%;object-fit:cover;">
                </td>
                <td>{{ $pinjam->anggota->nama }}</td>
                <td>{{ $pinjam->buku->judul }}</td>
                <td>{{ \Carbon\Carbon::parse($pinjam->tanggal_pinjam)->format('d-m-Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($pinjam->tanggal_pengembalian)->format('d-m-Y') }}</td>
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
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
