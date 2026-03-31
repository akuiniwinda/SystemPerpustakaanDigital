@extends('layout.anggota.app')

@section('content')
<div class="container mt-4">

    <!-- SEARCH -->
    <div class="row mb-4">
        <div class="col-md-6 mx-auto">
            <input type="text" class="form-control" placeholder="Search now">
        </div>
    </div>

    <!-- LIST BUKU -->
    <div class="row">
        @foreach ($activeBuku as $buku)
        <div class="col-md-2 mb-4">
            <div class="card text-center p-2 shadow-sm">

                <!-- FOTO -->
                <img src="{{ asset('storage/'.$buku->foto) }}"
                     class="card-img-top"
                     style="height:180px; object-fit:cover; border-radius:10px;">

                <!-- JUDUL -->
                <div class="mt-2">
                    <h6 class="mb-1">{{ $buku->judul }}</h6>
                    <small class="text-muted">{{ $buku->penulis }}</small>
                </div>

                <!-- BUTTON -->
                <div class="mt-2">
                    <a href="#" class="btn btn-warning btn-sm text-white">
                        Pinjam
                    </a>
                </div>

            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection
