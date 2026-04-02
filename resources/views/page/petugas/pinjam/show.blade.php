@extends('layout.petugas.app')
@section('content')
<div class="col-md-6 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">

      <h4 class="card-title">DETAIL PINJAMAN BUKU</h4>
      <p class="card-description">Konfirmasi Peminjaman Buku</p>

      @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
        </div>
      @endif

      <form >
        @csrf

        <!-- NAMA -->
        <div class="form-group">
            <label>Nama</label>
            <h6>{{$datapinjam->anggota->nama ?? '-'}}</h6>
        </div>

        <!-- TANGGAL -->
        <div class="form-group">
            <label>Tanggal Pinjam</label>
            <h6>{{$datapinjam->tanggal_pinjam}}</h6>
        </div>

        <!-- TANGGAL KEMBALI -->
        <div class="form-group">
            <label>Tanggal Pengembalian</label>
            <h6>@if ($datapinjam->status != 'selesai') -
                    @else
                        {{ \Carbon\Carbon::parse($datapinjam->tanggal_pengembalian)->format('d-m-Y') }}
                @endif</h6>
        </div>

        <!-- BUKU -->
        <div class="form-group">
            <label>Judul Buku</label>
            <h6>{{$databuku->judul}}</h6>
        </div>

        <!-- BUTTON -->
        <button type="submit" name="status" value="konfirmasi" class="btn btn-success mr-2">
            Konfirmasi
        </button>

        <button type="submit" name="aksi" value="tolak" class="btn btn-danger">
            Tolak
        </button>
      </form>

    </div>
  </div>
</div>
@endsection
