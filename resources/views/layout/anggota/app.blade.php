<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Perpustakaan Digital</title>
  @include('layout.anggota.css')
</head>
<body>

  <!-- NAVBAR dengan class -->
  <nav class="top-navbar">
    <div class="logo-area">
      <a href="index.html">
        <img src="images/logo.svg" alt="logo">
      </a>
      <a href="index.html">
        <img src="images/logo-mini.svg" alt="logo">
      </a>
    </div>

    <div class="nav-controls">
      <button type="button" class="mobile-menu-btn">Menu</button>

      <ul class="search-wrapper">
        <li>
          <input type="text" class="search-input" placeholder="Search now">
        </li>
      </ul>

      <ul class="nav-menu">
        <li class="nav-item">
          <a href="#" class="notif-link"></a>
          <div class="notif-dropdown">
            <p class="notif-dropdown-header">Notifications</p>
            <a href="#" class="notif-item">
              <div class="notif-content">
                <div class="notif-icon">Icon</div>
                <div class="notif-text">
                  <h6>Application Error</h6>
                  <p>Just now</p>
                </div>
              </div>
            </a>
            <a href="#" class="notif-item">
              <div class="notif-content">
                <div class="notif-icon">Icon</div>
                <div class="notif-text">
                  <h6>Settings</h6>
                  <p>Private message</p>
                </div>
              </div>
            </a>
            <a href="#" class="notif-item">
              <div class="notif-content">
                <div class="notif-icon">Icon</div>
                <div class="notif-text">
                  <h6>New user registration</h6>
                  <p>2 days ago</p>
                </div>
              </div>
            </a>
          </div>
        </li>

        <li class="nav-item">
          <a href="#" class="profile-link">
            <img src="images/faces/face28.jpg" alt="profile">
          </a>
          <div class="profile-dropdown">
            <a href="#">Settings</a>
            <a href="#">Logout</a>
          </div>
        </li>

        <li class="more-link">
          <a href="#">More</a>
        </li>
      </ul>

      <button type="button" class="toggle-btn">Toggle</button>
    </div>
  </nav>
  <!-- END NAVBAR -->

  <div class="app-container">

    <!-- SIDEBAR dengan class -->
    <nav class="sidebar">
      <div class="profile-card">
        <img src="jennie.jpg" alt="Profile">
        <div class="profile-role">Anggota</div>
        <div class="profile-name">Kim Jennie</div>
      </div>

      <ul class="sidebar-menu">
        <li class="active"><a href="index.html">Dashboard</a></li>
        <li><a href="#">Buku</a></li>
        <li><a href="#">Pinjam Buku</a></li>
        <li><a href="#">Denda</a></li>
      </ul>
    </nav>
    <!-- END SIDEBAR -->

    <!-- MAIN PANEL dengan class -->
    <div class="main-panel">

      <!-- KONTEN -->
      <div class="content-wrapper">
        @yield('content')
      </div>
      <!-- END KONTEN -->

      <!-- FOOTER -->
      @include('layout.anggota.footer')
      <!-- END FOOTER -->

    </div>
    <!-- END MAIN PANEL -->

  </div>

</body>
</html>
