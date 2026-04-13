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

                    @if($user && $user->id)
                    <a class="dropdown-item" href="{{ route('anggota.petugas.anggota.edit', $user->id) }}">
                        <i class="mdi mdi-tooltip-edit text-primary"></i>
                        Edit Akun
                    </a>
                    @endif
            </div>
          </li>
        </ul>
      </div>
    </nav>
