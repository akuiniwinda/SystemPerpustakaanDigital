@extends('layout.petugas.app')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
            <h4 class="card-title mb-0">Tabel Anggota</h4>
            <div class="d-flex gap-2">
                <form method="GET" action="{{ route('petugas.anggota.index') }}" id="searchForm">
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
        <table class="table">
          <thead>
            <tr>
              <th>Foto</th>
              <th>Nama</th>
              <th>Email</th>
              <th>No Telp</th>
              <th>Nomor Induk</th>
              <th>Alamat</th>
              <th>Opsi</th>
            </tr>
          </thead>

          <tbody>
            @foreach ($anggotas as $anggota)
            <tr>
              <td>
                <img src="{{ asset('storage/'.$anggota->foto) }}">
              </td>

              <td>{{ $anggota->nama }}</td>
              <td>{{ $anggota->email }}</td>
              <td>{{ $anggota->no_telp }}</td>
              <td>{{ $anggota->nomor_induk }}</td>
              <td>{{ $anggota->alamat }}</td>

              <td>
                <a href="{{ route('petugas.anggota.show', $anggota->id) }}" class="text-info mx-1">
                    <i class="mdi mdi-eye mdi-24px"></i>
                </a>
                <a href="{{ route('petugas.anggota.delete', $anggota->id) }}" onclick="return confirm('Yakin?')" class="text-danger mx-1">
                    <i class="mdi mdi-delete mdi-24px"></i>
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @if ($anggotas->total() > 0)
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                <div class="text-muted small mb-2 mb-sm-0">
                    Menampilkan {{ $anggotas->firstItem() }} sampai {{ $anggotas->lastItem() }} dari {{ $anggotas->total() }} data
                </div>
                <div>
                    {{ $anggotas->links('pagination::simple-bootstrap-5') }}
                </div>
            </div>
         @else
            <div class="text-center text-muted mt-4">
                Tidak ada data anggota.
            </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
