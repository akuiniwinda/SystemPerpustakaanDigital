<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Daftar - Perpustakaan Digital</title>

  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">

  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/style.css') }}">

  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />

    @include('layout.auth.register.css')

</head>

<body>
  <!-- Floating Books -->
  <div class="floating-books">
    <div class="book book1">📚</div>
    <div class="book book2">📖</div>
    <div class="book book3">📘</div>
    <div class="book book4">📙</div>
    <div class="book book5">📕</div>
    <div class="book book6">📗</div>
    <div class="book book7">📓</div>
    <div class="book book8">📒</div>
    <div class="book book9">📚</div>
    <div class="book book10">📖</div>
    <div class="book book11">📘</div>
    <div class="book book12">📙</div>
    <div class="book book13">📕</div>
    <div class="book book14">📗</div>
    <div class="book book15">📓</div>
  </div>

  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-6 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">

              <div class="text-center mb-4">
                <i class="ti-book" style="font-size: 48px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i>
                <h4>Buat Akun Baru</h4>
                <p class="text-muted mt-2">Bergabunglah dengan Perpustakaan Digital</p>
              </div>

              @if ($errors->any())
                <div class="alert alert-danger">
                  @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                  @endforeach
                </div>
              @endif

              <form class="pt-3" method="POST" action="{{ route('register.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                  <i class="ti-user input-icon"></i>
                  <input type="text" name="nama" class="form-control form-control-lg" placeholder="Nama Lengkap">
                </div>

                <div class="form-group">
                  <i class="ti-email input-icon"></i>
                  <input type="email" name="email" class="form-control form-control-lg" placeholder="Alamat Email">
                  @error('email')
                    <small style="color:red">{{$message}}</small>
                  @enderror
                </div>

                <!-- 2 kolom -->
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <i class="ti-id-card input-icon"></i>
                    <input type="text" name="nomor_induk" class="form-control form-control-lg" placeholder="Nomor Induk">
                    @error('nomor_induk')
                      <small style="color:red">{{$message}}</small>
                    @enderror
                  </div>

                  <div class="form-group col-md-6">
                    <i class="ti-mobile input-icon"></i>
                    <input type="text" name="no_telp" class="form-control form-control-lg" placeholder="Nomor Telepon">
                    @error('no_telp')
                      <small style="color:red">{{$message}}</small>
                    @enderror
                  </div>
                </div>

                <!-- 2 kolom -->
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <i class="ti-filter input-icon"></i>
                    <select name="jenis_kelamin" class="form-control form-control-lg">
                      <option value="">Jenis Kelamin</option>
                      <option value="laki-laki">Laki-laki</option>
                      <option value="perempuan">Perempuan</option>
                    </select>
                  </div>

                  <div class="form-group col-md-6">
                    <i class="ti-gallery input-icon"></i>
                    <input type="file" name="foto" class="form-control form-control-lg" style="padding-left: 45px;">
                  </div>
                </div>

                <div class="form-group">
                  <i class="ti-location-pin textarea-icon"></i>
                  <textarea name="alamat" class="form-control form-control-lg" placeholder="Alamat Lengkap"></textarea>
                </div>

                <div class="form-group">
                  <i class="ti-lock input-icon"></i>
                  <input type="password" name="password" class="form-control form-control-lg" placeholder="Password">
                </div>

                <div class="decorative-line">
                  <div class="line"></div>
                  <i class="ti-book"></i>
                  <div class="line"></div>
                </div>

                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium">
                    <i class="ti-user"></i> DAFTAR
                  </button>
                </div>

                <div class="text-center mt-4 font-weight-light">
                  Sudah Memiliki Akun? <a href="{{ route('login') }}" class="text-primary">Masuk Sekarang</a>
                </div>

              </form>

            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
  </div>

  <!-- plugins:js -->
  <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
  <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('assets/js/template.js') }}"></script>
  <script src="{{ asset('assets/js/settings.js') }}"></script>
  <script src="{{ asset('assets/js/todolist.js') }}"></script>
</body>

</html>
