@extends('layout.anggota.app')
@section('content')
    <!-- JUDUL -->
    <h4 class="text-center mb-4">Buku Dipinjam</h4>
    <!--Buku-->
    <div class="row justify-content-center">
    @foreach ($pinjams as $pinjam)
        <div class="col-md-3 mb-4">
            <div class="card text-center p-3 shadow-sm">

                <!-- FOTO -->
                <img src="{{ asset('storage/'.$pinjam->buku->foto) }}"
                    style="height:200px; object-fit:cover; border-radius:10px;">

                <!-- JUDUL -->
                <div class="mt-2">
                    <h6>{{ $pinjam->buku->judul }}</h6>
                    <small class="text-muted">
                        {{ $pinjam->buku->penulis }}
                    </small>
                </div>

                <!-- STATUS -->
                <div class="mt-2">
                    @if ($pinjam->status == 'meminjam')
                        <span class="badge badge-warning">Dipinjam</span>
                    @elseif ($pinjam->status == 'selesai')
                        <span class="badge badge-success">Selesai</span>
                    @endif
                </div>

                <!-- BUTTON -->
                <div class="mt-2">
                @if ($pinjam->status == 'meminjam')
                    <form action="{{ route('anggota.kembalikan', $pinjam->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-danger btn-sm">
                            Kembalikan
                        </button>
                    </form>
                @elseif ($pinjam->status == 'pengajuan')
                    <button class="btn btn-warning btn-sm" disabled>
                        Menunggu Konfirmasi
                    </button>
                @else
                    <button class="btn btn-secondary btn-sm" disabled>
                        Sudah Dikembalikan
                    </button>
                @endif
                </div>

            </div>
        </div>
    @endforeach
    </div>
@endsection
