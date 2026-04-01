@extends('layout.anggota.app')

@section('content')
@php
    $user = session('user');
@endphp

<div class="col-md-6 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">

      <h4 class="card-title">Form Pinjam Buku</h4>
      <p class="card-description">Konfirmasi Peminjaman Buku</p>

      @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
        </div>
      @endif

      <form action="{{ route('anggota.pinjam', $buku->id) }}" method="POST"">
        @csrf

        <!-- NAMA -->
        <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control"
                   value="{{ $user->nama }}" readonly>
        </div>

        <!-- TANGGAL -->
        <div class="form-group">
            <label>Tanggal Pinjam</label>
            <input type="text" class="form-control"
                   value="{{ \Carbon\Carbon::now()->format('d-m-Y') }}" readonly>
        </div>

        <!-- TANGGAL KEMBALI -->
        <div class="form-group">
            <label>Tanggal Pengembalian</label>
            <input type="text" class="form-control"
                   value="{{ \Carbon\Carbon::now()->addDays(30)->format('d-m-Y') }}" readonly>
        </div>

        <!-- BUKU -->
        <div class="form-group">
            <label>Buku</label>
            <input type="text" class="form-control"
                   value="{{ $buku->judul }}" readonly>
        </div>

        <!-- BUTTON -->
        <button type="submit" class="btn btn-primary mr-2">Pinjam</button>
        <a href="{{ route('anggota.buku.index') }}" class="btn btn-light">Cancel</a>

      </form>

    </div>
  </div>
</div>
@endsection
