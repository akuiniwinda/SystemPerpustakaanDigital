@if(session('login') && session('role') == 'petugas')
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    @php
        $user = session('user');
    @endphp
    <!-- Profile -->
    <div class="profile-card text-center">
        <img src="{{ $user->foto ? asset('storage/'.$user->foto) : asset('assets/images/default.png') }}"
            class="profile-img">
        <div class="role">Petugas</div>
        <h3 class="name">{{ $user->nama }}</h3>
    </div>

        <!-- Menu -->
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('petugas.dashboard.index') }}">
                    <i class="mdi mdi-border-all icon-nav"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('petugas.anggota.index') }}">
                    <i class="mdi mdi-account-multiple icon-nav"></i>
                    <span class="menu-title">Data Anggota</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('petugas.buku.index') }}">
                    <i class="mdi mdi-book-open-page-variant icon-nav"></i>
                    <span class="menu-title">Data Buku</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('petugas.pinjam.index') }}">
                    <i class="mdi mdi-clipboard-check icon-nav"></i>
                    <span class="menu-title">Pinjam</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('petugas.laporan.index') }}">
                    <i class="mdi mdi-file-multiple icon-nav"></i>
                    <span class="menu-title">Laporan</span>
                </a>
            </li>
        </ul>
      </nav>
      @endif
