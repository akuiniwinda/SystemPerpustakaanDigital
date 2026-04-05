@extends('layout.petugas.app')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Tabel Laporan Peminjaman</h4>

      <!-- BUTTON -->
      <div class="mb-3">
        <a href="{{ route('petugas.laporan.download') }}" class="btn btn-success btn-sm">
          Download PDF
        </a>
      </div>

      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Nama</th>
              <th>Judul Buku</th>
              <th>Denda</th>
              <th>Tanggal Kembali</th>
            </tr>
          </thead>

          <tbody>
            @foreach ($pinjams as $pinjam)
            <tr>

              <!-- NAMA -->
              <td>{{ $pinjam->anggota->nama }}</td>

              <!-- BUKU -->
              <td>{{ $pinjam->buku->judul }}</td>

              <!-- DENDA -->
              <td>
                @if ($pinjam->denda > 0)
                  <span class="text-danger">
                    Rp {{ number_format($pinjam->denda) }}
                  </span>
                @else
                  -
                @endif
              </td>

              <!-- TANGGAL -->
              <td>
                {{ $pinjam->tanggal_kembali ?? '-' }}
              </td>

            </tr>
            @endforeach

            @if ($pinjams->isEmpty())
            <tr>
              <td colspan="4" class="text-center">Belum ada data</td>
            </tr>
            @endif

          </tbody>
        </table>
      </div>

        <form action="{{ route('petugas.laporan.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <input type="file" name="file" required>
            <button class="btn btn-primary btn-sm">Upload Laporan</button>
        </form>
    </div>
  </div>
</div>
@endsection
