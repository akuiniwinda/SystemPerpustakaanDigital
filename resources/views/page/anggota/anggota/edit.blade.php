@extends('layout.anggota.app')
@section('content')
<div class="col-md-6 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">BIODATA</h4>
      <p class="card-description">
        Edit Biodata
      </p>
      @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif
      <form class="forms-sample" action="{{ route('anggota.petugas.anggota.update', $Anggotas->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama', $Anggotas->nama) }}">
            @error('nama')
	            <small style="color:red">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $Anggotas->email) }}">
            @error('email')
	            <small style="color:red">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Nomor Induk</label>
            <input type="text" name="nomor_induk" class="form-control" value="{{ old('nomor_induk', $Anggotas->nomor_induk) }}">
            @error('nomor_induk')
	            <small style="color:red">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>No Telepon</label>
            <input type="text" name="no_telp" class="form-control" value="{{ old('no_telp', $Anggotas->no_telp) }}">
            @error('no_telp')
	            <small style="color:red">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control">
                <option value="">Pilih Jenis Kelamin</option>
                <option value="laki-laki" {{ old('jenis_kelamin', $Anggotas->jenis_kelamin) == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="perempuan" {{ old('jenis_kelamin', $Anggotas->jenis_kelamin) == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
            @error('jenis_kelamin')
	            <small style="color:red">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" rows="4">{{ old('alamat', $Anggotas->alamat) }}</textarea>
            @error('alamat')
	            <small style="color:red">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Masukkan password (kosongkan jika tidak diubah)">
            @error('password')
	            <small style="color:red">{{ $message }}</small>
            @enderror
            <small class="text-muted">*Minimal 4 karakter</small>
        </div>

        <div class="form-group">
          <label>Foto</label>
          <input type="file" name="foto" class="form-control">
          @error('foto')
	            <small style="color:red">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mr-2">Submit</button>
        <a href="{{ route('anggota.dashboard.index') }}" class="btn btn-light">Cancel</a>
      </form>

    </div>
  </div>
</div>
@endsection
