@if(session('login') && session('role') == 'kepalaperpus')
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    @php
        $user = session('user');
    @endphp
    <!-- Profile -->
    <div class="profile-card text-center">
        <img src="{{ $user->foto ? asset('storage/'.$user->foto) : asset('assets/images/default.png') }}"
            class="profile-img">
        <div class="role">Kepala Perpustakaan</div>
        <h3 class="name">{{ $user->name }}</h3>
    </div>

        <!-- Menu -->
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard.index') }}">
                    <i class="mdi mdi-border-all icon-nav"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('petugas.index') }}">
                    <i class="mdi mdi-account-multiple icon-nav"></i>
                    <span class="menu-title">Data Petugas</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('books.index') }}">
                    <i class="mdi mdi-book-open-page-variant icon-nav"></i>
                    <span class="menu-title">Data Buku</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('laporan.index') }}">
                    <i class="mdi mdi-file-multiple icon-nav"></i>
                    <span class="menu-title">Laporan</span>
                </a>
            </li>
        </ul>
      </nav>
@endif
