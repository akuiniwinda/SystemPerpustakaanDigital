@extends('layout.kepalaperpus.app')
@section('content')
            <div class="col-lg-10 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                        <h4 class="card-title mb-0">Tabel Buku</h4>
                        <div class="d-flex gap-2">
                            <form method="GET" action="{{ route('books.index') }}" id="searchForm">
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
                  <a href="{{ route('books.create') }}" class="card-description">
                        Tambah Buku
                    </a>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Gambar</th>
                          <th>Judul</th>
                          <th>Penulis</th>
                          <th>Tahun Terbit</th>
                          <th>Status</th>
                          <th>Stock</th>
                          <th>Opsi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($Books as $buku)
                        <tr>
                            <td><img src="{{ asset('storage/'.$buku->foto) }}" style="width:50px;height:75px;object-fit:cover;border-radius:0;"></td>
                            <td>{{$buku->judul}}</td>
                            <td>{{$buku->penulis}}</td>
                            <td>{{$buku->tahun_terbit}}</td>
                            <td>{{$buku->status}}</td>
                            <td>
                                {{$buku->stock}}
                            </td>
                            <td>
                                <div>
                                    <a href="{{ route('books.edit', $buku->id) }}">Edit</a>
                                    <a href="{{ route('books.show', $buku->id) }}">Show</a>
                                    <a href="{{ route('books.delete', $buku->id) }}">Delete</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    @if ($Books->total() > 0)
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                            <div class="text-muted small mb-2 mb-sm-0">
                                Menampilkan {{ $Books->firstItem() }} sampai {{ $Books->lastItem() }} dari {{ $Books->total() }} data
                            </div>
                            <div>
                                {{ $Books->links('pagination::simple-bootstrap-5') }}
                            </div>
                        </div>
                    @else
                        <div class="text-center text-muted mt-4">
                            Tidak ada data buku.
                        </div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
@endsection
