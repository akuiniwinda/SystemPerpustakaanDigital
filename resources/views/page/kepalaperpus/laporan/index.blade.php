@extends('layout.kepalaperpus.app')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">

      <h4 class="card-title">Tabel Laporan Petugas</h4>

      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Profile</th>
              <th>Nama Petugas</th>
              <th>Tanggal Upload</th>
              <th>Status</th>
              <th>Opsi</th>
            </tr>
          </thead>

          <tbody>
            @foreach ($laporans as $laporan)
            <tr>

              <!-- FOTO -->
              <td>
                <img src="{{ asset('storage/'.$laporan->petugas->foto) }}" width="50">
              </td>

              <!-- NAMA -->
              <td>{{ $laporan->petugas->nama }}</td>

              <!-- TANGGAL -->
              <td>{{ $laporan->created_at->format('d-m-Y') }}</td>

              <!-- STATUS -->
              <td>
                @if ($laporan->status == 'belum_dilihat')
                  <span class="badge badge-danger">Belum Dilihat</span>
                @else
                  <span class="badge badge-success">Sudah Dilihat</span>
                @endif
              </td>

              <!-- OPSI -->
              <td>

                <!-- LIHAT PDF -->
                <a href="{{ asset('storage/'.$laporan->file) }}" target="_blank" class="btn btn-info btn-sm">
                  Lihat
                </a>

                <!-- TANDAI DILIHAT -->
                @if ($laporan->status == 'belum_dilihat')
                <form action="{{ route('laporan.lihat', $laporan->id) }}" method="POST" style="display:inline;">
                  @csrf
                  <button class="btn btn-success btn-sm">
                    Tandai
                  </button>
                </form>
                @endif

              </td>

            </tr>
            @endforeach

            @if ($laporans->isEmpty())
            <tr>
              <td colspan="5" class="text-center">Belum ada laporan</td>
            </tr>
            @endif

          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>
@endsection
