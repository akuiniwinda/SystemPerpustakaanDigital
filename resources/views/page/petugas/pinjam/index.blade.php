@extends('layout.petugas.app')
@section('content')
<div class="col-lg-15 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Tabel Peminjaman Buku</h4>
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
                <td>
                    @if($pinjam->status == 'pengajuan')
                        <a href="{{ route('petugas.pinjam.show', $pinjam->id) }}" class="btn btn-warning">Proses</a>
                    @else
                        <span>Sudah Konfirmasi</span>
                    @endif
                </td>
                <td>
                    @if($pinjam->status == 'meminjam' && $pinjam->pengajuan_pengembalian)
                        <form action="{{ url('/petugas/kembali/'.$pinjam->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-warning">Konfirmasi Kembali</button>
                        </form>
                    @else
                        <span>Revisi ini</span>
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
