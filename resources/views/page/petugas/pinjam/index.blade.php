@extends('layout.petugas.app')
@section('content')
<div class="col-lg-15 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Tabel Buku</h4>
                  <div >
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Profile</th>
                          <th>Nama</th>
                          <th>Judul Buku</th>
                          <th>Tanggal Pinjam</th>
                          <th>Tanggal Pengembalian</th>
                          <th>Denda</th>
                          <th>Status</th>
                          <th>Opsi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($Pinjambuku as $pinjam)
                        <tr>

                            <!-- FOTO -->
                            <td>
                                <img src="{{ asset('storage/'.$pinjam->anggota->foto) }}"
                                    style="width:50px;height:50px;border-radius:50%;object-fit:cover;">
                            </td>

                            <!-- NAMA -->
                            <td>{{ $pinjam->anggota->nama }}</td>

                            <!-- JUDUL BUKU -->
                            <td>{{ $pinjam->buku->judul }}</td>

                            <!-- TANGGAL PINJAM -->
                            <td>{{ \Carbon\Carbon::parse($pinjam->tanggal_pinjam)->format('d-m-Y') }}</td>

                            <!-- TANGGAL KEMBALI -->
                            <td>
                                @if ($pinjam->status != 'selesai')
                                    -
                                @else
                                    {{ \Carbon\Carbon::parse($pinjam->tanggal_pengembalian)->format('d-m-Y') }}
                                @endif
                            </td>

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

                            <!-- STATUS BUKU -->
                            <td>
                                <span class="badge border
                                    @if($pinjam->status == 'ditolak') border-danger text-danger
                                    @elseif($pinjam->status == 'pengajuan') border-warning text-warning
                                    @elseif($pinjam->status == 'meminjam') border-info text-info
                                    @elseif($pinjam->status == 'selesai') border-success text-success
                                    @else border-secondary text-secondary
                                    @endif
                                ">
                                    {{ ucfirst($pinjam->status) }}
                                </span>
                            </td>

                            <!-- OPSI -->
                            <td>
                                <div>
                                    <a href="{{ route('petugas.pinjam.show', $pinjam->id) }}">Show</a>
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
