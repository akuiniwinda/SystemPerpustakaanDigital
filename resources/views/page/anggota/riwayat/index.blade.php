@extends('layout.anggota.app')
@section('content')
    <!-- JUDUL -->
    <h4 class="text-center mb-4">Buku Dipinjam</h4>
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
                        @endif
                    </div>

                    <!-- BUTTON (akan selalu di bagian bawah karena flex-grow pada area sebelumnya) -->
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
                        @else
                            <button class="btn btn-secondary btn-sm" disabled>Sudah Dikembalikan</button>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
