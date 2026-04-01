@extends('layout.kepalaperpus.app')

@section('content')
<div class="container mt-4">

    <div class="card p-4 shadow-sm">

        <!-- HEADER -->
        <div class="d-flex justify-content-between mb-3">
            <h5>Detail Buku</h5>
            <span>{{$databuku->tahun_terbit}}</span>
        </div>

        <div class="row">

            <!-- FOTO -->
            <div class="col-md-3 text-center">
                <img src="{{ asset('storage/'.$databuku->foto) }}"
                     style="width:150px;height:200px;object-fit:cover;">
            </div>

            <!-- DATA -->
            <div class="col-md-9">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Judul</label>
                        <input type="text" class="form-control" value="{{ $databuku->judul }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label>Pengarang</label>
                        <input type="text" class="form-control" value="{{ $databuku->penulis }}" readonly>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Deskripsi</label>
                    <textarea class="form-control" rows="5" readonly>{{ $databuku->deskripsi }}</textarea>
                </div>

            </div>

        </div>

        <!-- BUTTON -->
        <div class="mt-3">
            <a href="{{ route('books.index') }} class="btn btn-primary">
                Kembali
            </a>
        </div>

    </div>

</div>
@endsection
