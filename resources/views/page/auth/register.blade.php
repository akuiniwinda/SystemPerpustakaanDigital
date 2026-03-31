<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Daftar</title>
  <!-- plugins:css -->
  <!-- plugins:css -->
<link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
<!-- endinject -->

<!-- inject:css -->
<link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/style.css') }}">
<!-- endinject -->

<link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
</head>
<body>
<div class="container-scroller">
<div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-6 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <h4>Buat Akun?</h4>
              <form class="pt-3" method="POST" action="{{ route('petugas.anggota.store') }}" enctype="multipart/form-data">
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
                    Sudah Memiliki Akun?  <a href="{{ route('login') }}" class="text-primary">Masuk</a>
                </div>

                </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
</div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>

    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/todolist.js') }}"></script>
  <!-- endinject -->
</body>
