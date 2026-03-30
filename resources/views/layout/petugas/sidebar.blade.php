<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <!-- Profile -->
    <div class="profile-card">
        <img src="{{ asset('assets/images/Jisoo.jpg') }}" class="profile-img">

        <div class="role">Petugas</div>

        <h3 class="name">Kim Jennie</h3>
    </div>

        <!-- Menu -->
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="">
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('petugas.anggota.index') }}">
                    <span class="menu-title">Data Anggota</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="">
                    <span class="menu-title">Data Buku</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span class="menu-title">Pinjam</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span class="menu-title">Laporan</span>
                </a>
            </li>
        </ul>
      </nav>
