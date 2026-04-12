@extends('layout.anggota.app')
@section('content')
    <!-- JUDUL -->
    <h4 class="text-center mb-4">Buku Dipinjam</h4>

    <!-- SEARCH -->
    <div class="row mb-4">
        <div class="col-md-6 mx-auto">
            <form method="GET" action="{{ route('anggota.riwayat.index') }}">
                <input type="text" name="search" class="form-control" placeholder="Search now" value="{{ request('search') }}" onkeyup="this.form.submit()">
            </form>
        </div>
    </div>

    <!--Buku-->
    <div class="row justify-content-center">
        @foreach ($pinjams as $pinjam)
            <div class="col-md-3 mb-4 d-flex align-items-stretch">
                <div class="card text-center p-3 shadow-sm w-100 d-flex flex-column">
                    <!-- FOTO -->
                    <div style="aspect-ratio: 2 / 3; overflow: hidden; border-radius: 10px;">
                        <img src="{{ asset('storage/'.$pinjam->buku->foto) }}"
                            style="width:100%; height:100%; object-fit:cover;">
                    </div>

                    <!-- JUDUL & PENULIS (area fleksibel) -->
                    <div class="mt-2 flex-grow-1 d-flex flex-column">
                        <h6 class="judul-buku">{{ $pinjam->buku->judul }}</h6>
                        <small class="text-muted">{{ $pinjam->buku->penulis }}</small>
                    </div>

                    <!-- STATUS -->
                    <div class="mt-2">
                        @if ($pinjam->status == 'meminjam')
                            <span class="badge badge-warning">Dipinjam</span>
                        @elseif ($pinjam->status == 'selesai')
                            <span class="badge badge-success">Selesai</span>
                        @elseif ($pinjam->status == 'pengajuan')
                            <span class="badge badge-info">Menunggu Konfirmasi</span>
                        @elseif ($pinjam->status == 'ditolak')
                            <span class="badge badge-danger">Ditolak</span>
                        @endif
                    </div>

                    <!-- BUTTON -->
                    <div class="mt-2">
                        @if ($pinjam->status == 'meminjam' && !$pinjam->pengajuan_pengembalian)
                            <form action="{{ route('anggota.kembalikan', $pinjam->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-danger btn-sm">Kembalikan</button>
                            </form>
                        @elseif ($pinjam->status == 'meminjam' && $pinjam->pengajuan_pengembalian)
                            <button class="btn btn-warning btn-sm" disabled>Menunggu Konfirmasi Pengembalian</button>
                        @elseif ($pinjam->status == 'pengajuan')
                            <button class="btn btn-warning btn-sm" disabled>Menunggu Konfirmasi Pinjam</button>
                        @elseif ($pinjam->status == 'ditolak')
                            <button class="btn btn-secondary btn-sm" disabled>Pinjaman Ditolak</button>
                        @else
                            <button class="btn btn-secondary btn-sm" disabled>Sudah Dikembalikan</button>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
