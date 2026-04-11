@extends('layout.petugas.app')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Tabel Anggota</h4>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Foto</th>
              <th>Nama</th>
              <th>Email</th>
              <th>No Telp</th>
              <th>Nomor Induk</th>
              <th>Jenis Kelamin</th>
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
              <td>{{ $anggota->jenis_kelamin }}</td>
              <td>{{ $anggota->alamat }}</td>

              <td>
                <a href="">Edit</a>
                <a href="">Show</a>

                <form action="" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" onclick="return confirm('Yakin hapus?')">Delete</button>
                </form>
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
