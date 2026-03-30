@extends('layout.kepalaperpus.app')
@section('content')
            <div class="col-lg-10 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Basic Table</h4>
                  <a class="card-description" href="{{ route('books.create') }}">
                    Tambah Buku
                  </a>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Gambar</th>
                          <th>Judul.</th>
                          <th>Penulis</th>
                          <th>Tahun Terbit</th>
                          <th>Active</th>
                          <th>Opsi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($Books as $buku)
                        <tr>
                            <td><img src="{{ asset('storage/'.$buku->foto) }}" style="width:50px;height:75px;object-fit:cover;border-radius:0;"></td>
                            <td>{{$buku->judul}}</td>
                            <td>{{$buku->penulis}}</td>
                            <td>aktif</td>
                            <td>{{$buku->tahun_terbit}}</td>
                            <td>
                                <div>
                                    <a href="{{ route('books.edit', $buku->id) }}">Edit</a>
                                    <a href="{{ route('books.show', $buku->id) }}">Show</a>
                                    <a href="{{ route('books.destroy', $buku->id) }}">Delete</a>
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
