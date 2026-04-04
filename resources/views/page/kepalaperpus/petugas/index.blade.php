@extends('layout.kepalaperpus.app')
@section('content')
            <div class="col-lg-10 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Tabel Petugas</h4>
                  <a class="card-description" href="{{ route('petugas.create') }}">
                    Tambah Petugas
                  </a>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Profile</th>
                          <th>Nama</th>
                          <th>Nip</th>
                          <th>Alamat</th>
                          <th>Opsi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($Petugases as $petugas)
                        <tr>
                            <td><img src="{{ asset('storage/'.$petugas->foto) }}"></td>
                            <td>{{$petugas->nama}}</td>
                            <td>{{$petugas->nip}}</td>
                            <td>{{$petugas->alamat}}</td>
                            <td>
                                <div>
                                    <a href="{{ route('petugas.edit', $petugas->id) }}">Edit</a>
                                    <a href="{{ route('petugas.show', $petugas->id) }}">Show</a>
                                    <a href="{{ route('petugas.delete', $petugas->id) }}">Delete</a>
                                </div>
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
