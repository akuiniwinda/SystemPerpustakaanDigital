@extends('layout.kepalaperpus.app')
@section('content')
<div class="col-md-6 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Form Buku</h4>
      <p class="card-description">
        Tambah Data Buku
      </p>
      <form class="forms-sample" action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label>Judul</label>
          <input type="text" name="judul" class="form-control" placeholder="Masukkan judul buku">
            @error('judul')
	            <small style="color:red">{{$message}}</small>
            @enderror
        </div>

        <div class="form-group">
          <label>Penulis</label>
          <input type="text" name="penulis" class="form-control" placeholder="Masukkan nama penulis">
            @error('penulis')
	            <small style="color:red">{{$message}}</small>
            @enderror
        </div>

        <div class="form-group">
          <label>Tahun Terbit</label>
          <input type="number" name="tahun_terbit" class="form-control" placeholder="Contoh: 2024">
            @error('tahun_terbit')
	            <small style="color:red">{{$message}}</small>
            @enderror
        </div>

        <div class="form-group">
          <label>Deskripsi</label>
          <textarea name="deskripsi" class="form-control" rows="4" placeholder="Masukkan deskripsi buku"></textarea>
            @error('deskripsi')
	            <small style="color:red">{{$message}}</small>
            @enderror
        </div>

        <div class="form-group">
          <label>Foto</label>
          <input type="file" name="foto" class="form-control">
            @error('foto')
	            <small style="color:red">{{$message}}</small>
            @enderror
        </div>

        <div class="form-group">
            <input type="number" name="stock" class="form-control" placeholder="Masukkan jumlah stock" min="0">

            @error('stock')
                <small style="color:red">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mr-2">Submit</button>
        <a href="{{ route('books.index') }}" class="btn btn-light">Cancel</a>
      </form>

    </div>
  </div>
</div>
@endsection
