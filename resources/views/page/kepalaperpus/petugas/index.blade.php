@extends('layout.kepalaperpus.app')
@section('content')
            <div class="col-lg-10 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                    <h4 class="card-title mb-0">Tabel Buku</h4>
                    <div class="d-flex gap-2">
                        <form method="GET" action="{{ route('petugas.index') }}" id="searchForm">
                            <div class="input-group" style="width: 260px;">
                                <div class="input-group-prepend hover-cursor" id="searchIcon" style="cursor: pointer;">
                                    <span class="input-group-text">
                                        <i class="icon-search"></i>
                                    </span>
                                </div>
                                <input type="text" name="search" class="form-control" id="searchInput"
                                    placeholder="Cari nama atau alamat..."
                                    value="{{ request('search') }}"
                                    aria-label="search">
                            </div>
                        </form>
                    </div>
                  </div>
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
                    @if ($Petugases->total() > 0)
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                            <div class="text-muted small mb-2 mb-sm-0">
                                Menampilkan {{ $Petugases->firstItem() }} sampai {{ $Petugases->lastItem() }} dari {{ $Petugases->total() }} data
                            </div>
                            <div>
                                {{ $Petugases->links('pagination::simple-bootstrap-5') }}
                            </div>
                        </div>
                    @else
                        <div class="text-center text-muted mt-4">
                            Tidak ada data petugas.
                        </div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
@endsection
