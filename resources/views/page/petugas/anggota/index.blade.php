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
                <img src="{{ asset('storage/'.$anggota->foto) }}"
                     style="width:50px;height:70px;object-fit:cover;">
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
      </div>
    </div>
  </div>
</div>
@endsection
