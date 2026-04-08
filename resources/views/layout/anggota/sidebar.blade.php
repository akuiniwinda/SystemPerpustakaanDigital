@if(session('login') && session('role') == 'anggota')

<nav class="sidebar sidebar-offcanvas" id="sidebar">

    @php
        $user = session('user');
    @endphp

    <!-- profile -->
    <div class="profile-card text-center">
        <img src="{{ $user->foto ? asset('storage/'.$user->foto) : asset('assets/images/default.png') }}"
            class="profile-img">
        <div class="role">Anggota</div>
        <h3 class="name">{{ $user->nama }}</h3>
    </div>

    <!-- isi sidebar -->
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
            <a class="nav-link" href="{{ route('anggota.riwayat.index') }}">
                <span class="menu-title">Riwayat</span>
            </a>
        </li>
    </ul>

</nav>

@endif
