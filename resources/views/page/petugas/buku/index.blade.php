@extends('layout.petugas.app')
@section('content')
<div class="col-lg-14 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Tabel Buku</h4>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Gambar</th>
                          <th>Judul</th>
                          <th>Penulis</th>
                          <th>Status</th>
                          <th>Opsi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($Books as $buku)
                        <tr>
                            <td><img src="{{ asset('storage/'.$buku->foto) }}" style="width:50px;height:75px;object-fit:cover;border-radius:0;"></td>
                            <td>{{$buku->judul}}</td>
                            <td>{{$buku->penulis}}</td>
                            <td>
                                @if($buku->status == 'tersedia')
                                    <span class="badge badge-success">Tersedia</span>
                                @elseif($buku->status == 'habis')
                                    <span class="badge badge-secondary">Habis</span>
                                @else
                                    <span class="badge badge-danger">Dipinjam</span>
                                @endif
                            </td>
                            <td>
                                <div>
                                    <a href="{{ route('books.show', $buku->id) }}">Show</a>
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
