<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
     @php
        $user = session('user');
    @endphp
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center" style="flex-direction: column; line-height: 1.2;">
        <a class="navbar-brand" style="font-weight: 800; font-size: 0.9rem; padding: 0; margin: 0;">PERPUSTAKAAN DIGITAL</a>
        <a class="navbar-brand" style="font-size: 0.85rem; font-weight: 400; padding: 0; margin: 0; opacity: 0.9;">Smk Negeri 3 Banjar</a>
    </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="{{ $user->foto ? asset('storage/'.$user->foto) : asset('assets/images/default.png') }}" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="{{ route('logout') }}">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
              <a class="dropdown-item" href="{{ route('tambahakun.create') }}">
                <i class="mdi mdi-account-plus text-primary"></i>
                Tambah Akun
              </a>
              <a class="dropdown-item" href="{{ route('books.trash') }}">
                <i class="mdi mdi-book-minus text-primary"></i>
                Buku Terhapus
              </a>
              <a class="dropdown-item" href="{{ route('petugas.trash') }}" >
                <i class="mdi mdi-account-remove text-primary"></i>
                Petugas Terhapus
              </a>
            </div>
          </li>
          <li class="nav-item nav-settings d-none d-lg-flex">
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
