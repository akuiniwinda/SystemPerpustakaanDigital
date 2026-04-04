@extends('layout.kepalaperpus.app')
@section('content')
<div class="col-md-6 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Form Buku</h4>
      <p class="card-description">
        Tambah Data Buku
      </p>
      @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif
      <form class="forms-sample" action="{{ route('petugas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" placeholder="Masukkan nama">
            @error('nama')
	            <small style="color:red">{{$message}}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>NIP</label>
            <input type="text" name="nip" class="form-control" placeholder="Masukkan NIP">
            @error('nip')
	            <small style="color:red">{{$message}}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" placeholder="Masukkan email">
            @error('email')
	            <small style="color:red">{{$message}}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Masukkan password">
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" rows="4" placeholder="Masukkan alamat"></textarea>
            @error('alamat')
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

        <button type="submit" class="btn btn-primary mr-2">Submit</button>
        <a href="{{ route('petugas.index') }}" class="btn btn-light">Cancel</a>
      </form>

    </div>
  </div>
</div>
@endsection
