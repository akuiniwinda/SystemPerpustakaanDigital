<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login - Perpustakaan Digital</title>

  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/style.css') }}">

  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
  @include('layout.auth.login.css')
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
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">

              <div class="text-center mb-4">
                <i class="ti-book" style="font-size: 48px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i>
                <h3>PERPUSTAKAAN DIGITAL</h3>
                <p class="text-muted mt-2">Selamat datang kembali! Silakan login untuk melanjutkan</p>
              </div>

              <!-- FORM LOGIN -->
              <form class="pt-3" method="POST" action="{{ route('login.proses') }}">
                @csrf

                <div class="form-group">
                  <i class="ti-email input-icon"></i>
                  <input type="email" name="email" class="form-control form-control-lg" placeholder="Alamat Email">
                  @error('email')
                    <small style="color:red; display: block; margin-top: 5px;">{{$message}}</small>
                  @enderror
                </div>

                <div class="form-group">
                  <i class="ti-lock input-icon"></i>
                  <input type="password" name="password" class="form-control form-control-lg" placeholder="Password">
                  @error('password')
                    <small style="color:red; display: block; margin-top: 5px;">{{$message}}</small>
                  @enderror
                </div>

                <div class="decorative-line">
                  <div class="line"></div>
                  <i class="ti-book"></i>
                  <div class="line"></div>
                </div>

                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                    <i class="ti-arrow-right"></i> Login
                  </button>
                </div>

                <div class="text-center mt-4 font-weight-light">
                  Belum Memiliki Akun?
                  <a href="{{ route('register') }}" class="text-primary" style="font-weight: 600;">Buat Akun Sekarang</a>
                </div>
              </form>

              <!-- Quote -->
              <div class="quote-container">
                <div class="quote-text">
                  "Buku adalah jendela dunia"
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- JS (tetap ada untuk Laravel) -->
  <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
  <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('assets/js/template.js') }}"></script>
  <script src="{{ asset('assets/js/settings.js') }}"></script>
  <script src="{{ asset('assets/js/todolist.js') }}"></script>

</body>
</html>
