<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Selamat Datang - Perpustakaan Digital</title>

  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/style.css') }}">

  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />

  <style>
    /* Animasi Background - SAMA DENGAN LOGIN */
    @keyframes gradientBG {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    body {
      background: linear-gradient(-45deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
      background-size: 400% 400%;
      animation: gradientBG 15s ease infinite;
      position: relative;
      overflow-x: hidden;
      min-height: 100vh;
    }

    /* Floating Books Animation - SAMA DENGAN LOGIN */
    @keyframes float1 { 0% { transform: translateY(100vh) rotate(0deg); opacity: 0; } 10% { opacity: 0.15; } 90% { opacity: 0.15; } 100% { transform: translateY(-100px) rotate(360deg); opacity: 0; } }
    @keyframes float2 { 0% { transform: translateY(100vh) rotate(0deg); opacity: 0; } 10% { opacity: 0.15; } 90% { opacity: 0.15; } 100% { transform: translateY(-100px) rotate(-360deg); opacity: 0; } }
    @keyframes float3 { 0% { transform: translateY(100vh) rotate(0deg); opacity: 0; } 10% { opacity: 0.1; } 90% { opacity: 0.1; } 100% { transform: translateY(-100px) rotate(720deg); opacity: 0; } }

    .floating-books {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
      z-index: 0;
      overflow: hidden;
    }

    .book {
      position: absolute;
      font-size: 2rem;
      opacity: 0;
    }

    .book1 { animation: float1 18s infinite linear; left: 5%; font-size: 40px; animation-delay: 0s; }
    .book2 { animation: float2 22s infinite linear; left: 15%; font-size: 30px; animation-delay: 2s; }
    .book3 { animation: float3 20s infinite linear; left: 25%; font-size: 50px; animation-delay: 4s; }
    .book4 { animation: float1 25s infinite linear; left: 35%; font-size: 35px; animation-delay: 1s; }
    .book5 { animation: float2 19s infinite linear; left: 45%; font-size: 45px; animation-delay: 3s; }
    .book6 { animation: float3 23s infinite linear; left: 55%; font-size: 28px; animation-delay: 5s; }
    .book7 { animation: float1 21s infinite linear; left: 65%; font-size: 42px; animation-delay: 2.5s; }
    .book8 { animation: float2 24s infinite linear; left: 75%; font-size: 38px; animation-delay: 1.5s; }
    .book9 { animation: float3 26s infinite linear; left: 85%; font-size: 32px; animation-delay: 3.5s; }
    .book10 { animation: float1 17s infinite linear; left: 95%; font-size: 48px; animation-delay: 0.5s; }
    .book11 { animation: float2 28s infinite linear; left: 10%; font-size: 25px; animation-delay: 6s; }
    .book12 { animation: float3 30s infinite linear; left: 50%; font-size: 55px; animation-delay: 4.5s; }
    .book13 { animation: float1 16s infinite linear; left: 70%; font-size: 35px; animation-delay: 7s; }
    .book14 { animation: float2 27s infinite linear; left: 30%; font-size: 44px; animation-delay: 5.5s; }
    .book15 { animation: float3 29s infinite linear; left: 80%; font-size: 29px; animation-delay: 8s; }

    /* Card dengan efek glassmorphism - SAMA DENGAN LOGIN */
    .welcome-card {
      background: rgba(255, 255, 255, 0.98);
      backdrop-filter: blur(10px);
      border-radius: 30px;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
      transition: all 0.3s ease;
      position: relative;
      z-index: 1;
      animation: slideUp 0.6s ease-out;
      padding: 50px 40px;
    }

    @keyframes slideUp {
      from {
        opacity: 0;
        transform: translateY(50px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .welcome-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 30px 70px rgba(0, 0, 0, 0.4);
    }

    /* Icon besar */
    .main-icon {
      font-size: 80px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      animation: bounce 2s ease-in-out infinite;
      display: inline-block;
    }

    @keyframes bounce {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
    }

    /* Judul */
    .welcome-title {
      font-size: 36px;
      font-weight: 800;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      margin: 20px 0 10px;
    }

    .welcome-subtitle {
      color: #666;
      font-size: 16px;
      margin-bottom: 40px;
    }

    /* Tombol pilihan */
    .choice-buttons {
      display: flex;
      gap: 25px;
      justify-content: center;
      margin-bottom: 40px;
      flex-wrap: wrap;
    }

    .btn-choice {
      min-width: 200px;
      padding: 15px 30px;
      border-radius: 50px;
      font-weight: 700;
      font-size: 18px;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
    }

    .btn-login {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border: none;
      box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }

    .btn-login:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
      color: white;
    }

    .btn-register {
      background: transparent;
      color: #667eea;
      border: 2px solid #667eea;
    }

    .btn-register:hover {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      transform: translateY(-3px);
      border-color: transparent;
      box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }

    .btn-choice::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
      transition: left 0.5s ease;
    }

    .btn-choice:hover::before {
      left: 100%;
    }

    .btn-choice:active {
      transform: translateY(0);
    }

    /* Fitur-fitur */
    .features {
      display: flex;
      justify-content: center;
      gap: 30px;
      margin-top: 40px;
      flex-wrap: wrap;
    }

    .feature-item {
      text-align: center;
      padding: 20px;
      border-radius: 15px;
      background: rgba(102, 126, 234, 0.05);
      transition: all 0.3s ease;
      flex: 1;
      min-width: 150px;
    }

    .feature-item:hover {
      background: rgba(102, 126, 234, 0.1);
      transform: translateY(-5px);
    }

    .feature-icon {
      font-size: 40px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      margin-bottom: 10px;
      display: inline-block;
    }

    .feature-title {
      font-weight: 700;
      color: #333;
      margin-bottom: 5px;
    }

    .feature-desc {
      font-size: 12px;
      color: #666;
    }

    /* Decorative line */
    .decorative-line {
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 30px 0;
      gap: 10px;
    }

    .line {
      width: 80px;
      height: 2px;
      background: linear-gradient(90deg, transparent, #ccc, transparent);
    }

    /* Statistik */
    .stats {
      display: flex;
      justify-content: center;
      gap: 40px;
      margin-top: 30px;
      flex-wrap: wrap;
    }

    .stat-item {
      text-align: center;
    }

    .stat-number {
      font-size: 28px;
      font-weight: 800;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      display: block;
    }

    .stat-label {
      font-size: 12px;
      color: #666;
    }

    /* Quotes */
    .quote-container {
      text-align: center;
      margin-top: 40px;
      padding-top: 30px;
      border-top: 1px solid #e0e0e0;
    }

    .quote-text {
      font-size: 14px;
      color: #666;
      font-style: italic;
      animation: glow 3s ease-in-out infinite;
    }

    @keyframes glow {
      0%, 100% { color: #666; }
      50% { color: #667eea; }
    }

    /* Responsive */
    @media (max-width: 768px) {
      .welcome-card {
        padding: 30px 20px;
        margin: 0 15px;
      }

      .welcome-title {
        font-size: 28px;
      }

      .btn-choice {
        min-width: 150px;
        padding: 12px 20px;
        font-size: 16px;
      }

      .choice-buttons {
        gap: 15px;
      }

      .features {
        gap: 15px;
      }

      .feature-item {
        min-width: 120px;
        padding: 15px;
      }

      .stats {
        gap: 20px;
      }

      .stat-number {
        font-size: 22px;
      }
    }

    /* Efek tambahan */
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .feature-item {
      animation: fadeInUp 0.6s ease-out backwards;
    }

    .feature-item:nth-child(1) { animation-delay: 0.1s; }
    .feature-item:nth-child(2) { animation-delay: 0.2s; }
    .feature-item:nth-child(3) { animation-delay: 0.3s; }
    .feature-item:nth-child(4) { animation-delay: 0.4s; }

    .stats {
      animation: fadeInUp 0.6s ease-out 0.5s backwards;
    }

    .quote-container {
      animation: fadeInUp 0.6s ease-out 0.7s backwards;
    }
  </style>
</head>

<body>
  <!-- Floating Books - SAMA DENGAN LOGIN -->
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
          <div class="col-lg-8 mx-auto">
            <div class="welcome-card text-center">

              <!-- Icon Utama -->
              <i class="ti-book main-icon"></i>

              <!-- Judul -->
              <h1 class="welcome-title">PERPUSTAKAAN DIGITAL</h1>
              <p class="welcome-subtitle">Selamat datang di platform perpustakaan digital modern. Temukan ribuan koleksi buku dan bahan bacaan berkualitas.</p>

              <!-- Tombol Pilihan -->
              <div class="choice-buttons">
                <a href="{{ route('login') }}" class="btn-choice btn-login">
                  <i class="ti-arrow-right"></i> Login
                </a>
                <a href="{{ route('register') }}" class="btn-choice btn-register">
                  <i class="ti-user"></i> Daftar
                </a>
              </div>

              <!-- Garis Dekoratif -->
              <div class="decorative-line">
                <div class="line"></div>
                <i class="ti-book" style="color: #999;"></i>
                <div class="line"></div>
              </div>

              <!-- Quotes -->
              <div class="quote-container">
                <div class="quote-text">
                  <i class="ti-quote-left" style="margin-right: 5px;"></i>
                  Membaca adalah membuka jendela dunia, mari bergabung dan temukan pengetahuannya
                  <i class="ti-quote-right" style="margin-left: 5px;"></i>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- JS -->
  <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
  <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('assets/js/template.js') }}"></script>
  <script src="{{ asset('assets/js/settings.js') }}"></script>
  <script src="{{ asset('assets/js/todolist.js') }}"></script>

  <!-- Animasi tambahan untuk stats (tanpa JS, hanya CSS) -->
  <style>
    /* Animasi counter sederhana untuk statistik */
    .stat-number {
      counter-reset: stats;
      animation: countUp 2s ease-out forwards;
    }

    @keyframes countUp {
      from {
        opacity: 0;
        transform: scale(0.5);
      }
      to {
        opacity: 1;
        transform: scale(1);
      }
    }
  </style>
</body>

</html>
