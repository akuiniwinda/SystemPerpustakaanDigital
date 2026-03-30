@extends('layout.auth.register')
@section('content')
<div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="../../images/logo.svg" alt="logo">
              </div>
              <h4>New here?</h4>
              <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
              <form class="pt-3" method="POST" action="{{ route('anggota.store') }}" enctype="multipart/form-data">
                @csrf
                <h4 class="text-center mb-4">Perpustakaan Digital</h4>

                <div class="form-group">
                    <input type="text" name="nama" class="form-control form-control-lg" placeholder="Nama">
                </div>

                <div class="form-group">
                    <input type="email" name="email" class="form-control form-control-lg" placeholder="Email">
                </div>

                <!-- 2 kolom -->
                <div class="form-row">
                    <div class="form-group col-md-6">
                    <input type="text" name="nomor_induk" class="form-control form-control-lg" placeholder="Nomor Induk">
                    </div>

                    <div class="form-group col-md-6">
                    <input type="text" name="no_telp" class="form-control form-control-lg" placeholder="Nomor Telepon">
                    </div>
                </div>

                <!-- 2 kolom -->
                <div class="form-row">
                    <div class="form-group col-md-6">
                    <select name="jenis_kelamin" class="form-control form-control-lg">
                        <option value="">Jenis Kelamin</option>
                        <option value="laki-laki">Laki-laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                    </div>

                    <div class="form-group col-md-6">
                    <input type="file" name="foto" class="form-control form-control-lg">
                    </div>
                </div>

                <div class="form-group">
                    <textarea name="alamat" class="form-control form-control-lg" placeholder="Alamat"></textarea>
                </div>

                <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-lg" placeholder="Password">
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium">
                    DAFTAR
                    </button>
                </div>

                <div class="text-center mt-4 font-weight-light">
                    Sudah Memiliki Akun?  class="text-primary">Masuk</a>
                </div>

                </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
@endsection
