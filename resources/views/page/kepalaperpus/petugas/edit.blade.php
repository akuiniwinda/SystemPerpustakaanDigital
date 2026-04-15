@extends('layout.kepalaperpus.app')
@section('content')
<div class="col-md-6 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Detail Edit Buku</h4>
      <p class="card-description">
        Edit Data Buku
      </p>
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
      <form class="forms-sample" action="{{ route('petugas.update', $Petugases->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{$Petugases->nama}}">
            @error('nama')
	            <small style="color:red">{{$message}}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>NIP</label>
            <input type="text" name="nip" class="form-control" value="{{$Petugases->nip}}">
            @error('nip')
	            <small style="color:red">{{$message}}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{$Petugases->email}}">
            @error('email')
	            <small style="color:red">{{$message}}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Masukkan password">
            @error('password')
	            <small style="color:red">{{$message}}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" rows="4">{{ old('alamat', $Petugases->alamat) }}</textarea>
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
