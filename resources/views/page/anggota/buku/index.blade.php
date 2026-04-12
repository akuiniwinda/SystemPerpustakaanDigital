@extends('layout.anggota.app')

@section('content')
<div class="container mt-4">

    <!-- SEARCH -->
    <div class="row mb-4">
        <div class="col-md-6 mx-auto">
            <form method="GET" action="{{ route('anggota.buku.index') }}">
                <input type="text" name="search" class="form-control" placeholder="Search now" value="{{ request('search') }}" onkeyup="this.form.submit()">
            </form>
        </div>
    </div>

    <!-- LIST BUKU -->
    <div class="row">
        @foreach ($bukubuku as $buku)
        @php
            // Cek apakah user sedang meminjam buku ini (status belum selesai)
            $sedangMeminjam = \App\Models\Pinjam::where('anggota_id', session('user')->id)
                    ->where('book_id', $buku->id)
                    ->whereNotIn('status', ['selesai', 'ditolak'])
                    ->exists();
            $stokHabis = ($buku->stock <= 0);
        @endphp
        <div class="col-md-2 mb-4">
            <div class="card text-center p-2 shadow-sm">
                <img src="{{ asset('storage/'.$buku->foto) }}"
                    class="card-img-top"
                    style="height:200px; object-fit:cover; border-radius:10px;">

                <div class="mt-2">
                    <h6 class="mb-1 text-truncate" style="max-width:100%;">
                        <a href="{{ route('anggota.buku.show', $buku->id) }}">
                            {{ $buku->judul }}
                        </a>
                    </h6>
                    <small class="text-muted text-truncate d-block">{{ $buku->penulis }}</small>
                </div>

                <div class="mt-2">
                    @if($stokHabis)
                        <button class="btn btn-secondary btn-sm" disabled>Stock Habis</button>
                    @elseif($sedangMeminjam)
                        <button class="btn btn-info btn-sm" disabled>Dipinjam</button>
                    @else
                        <a href="{{ route('anggota.pinjam.create', $buku->id) }}" class="btn btn-warning btn-sm text-white">Pinjam</a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection
