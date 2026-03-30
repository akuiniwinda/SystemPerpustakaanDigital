<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <!-- Profile -->
    <div class="profile-card">
        <img src="{{ asset('assets/images/Jisoo.jpg') }}" class="profile-img">

        <div class="role">Anggota</div>

        <h3 class="name">Kim Jennie</h3>
    </div>

        <!-- Menu -->
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('anggota.dashboard.index') }}">
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('anggota.buku.index') }}">
                    <span class="menu-title">Buku</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('anggota.profile.index') }}">
                    <span class="menu-title">Profile</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span class="menu-title">Denda</span>
                </a>
            </li>
        </ul>
      </nav>
