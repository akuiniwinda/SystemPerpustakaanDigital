<style>
    /* Animasi Background */
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
    }

    /* Floating Books Animation */
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

    /* Card dengan efek glassmorphism */
    .auth-form-light {
      background: rgba(255, 255, 255, 0.98);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
      transition: all 0.3s ease;
      position: relative;
      z-index: 1;
      animation: slideUp 0.6s ease-out;
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

    .auth-form-light:hover {
      transform: translateY(-5px);
      box-shadow: 0 30px 70px rgba(0, 0, 0, 0.4);
    }

    /* Animasi input fields */
    .form-group {
      position: relative;
      margin-bottom: 25px;
    }

    .form-control {
      border-radius: 10px;
      border: 2px solid #e0e0e0;
      transition: all 0.3s ease;
      padding: 12px 15px 12px 45px;
      font-size: 14px;
    }

    .form-control:focus {
      border-color: #667eea;
      box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
      transform: scale(1.02);
      outline: none;
    }

    /* Icon dalam input */
    .input-icon {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: #999;
      z-index: 10;
      font-size: 18px;
      transition: color 0.3s ease;
    }

    .form-group:hover .input-icon {
      color: #667eea;
    }

    /* Button efek */
    .btn-primary {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border: none;
      border-radius: 10px;
      padding: 12px;
      font-weight: 600;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .btn-primary::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
      transition: left 0.5s ease;
    }

    .btn-primary:hover::before {
      left: 100%;
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
    }

    .btn-primary:active {
      transform: translateY(0);
    }

    /* Judul dengan efek */
    h3 {
      font-size: 28px;
      font-weight: 700;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      margin-bottom: 10px;
      position: relative;
      display: inline-block;
      animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
      0%, 100% { opacity: 1; }
      50% { opacity: 0.8; }
    }

    h3::after {
      content: '';
      position: absolute;
      bottom: -5px;
      left: 0;
      width: 50px;
      height: 3px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border-radius: 2px;
      animation: expandWidth 2s ease-in-out infinite;
    }

    @keyframes expandWidth {
      0%, 100% { width: 50px; }
      50% { width: 100px; }
    }

    /* Statistik pengunjung */
    .visitor-stats {
      background: linear-gradient(135deg, rgba(102,126,234,0.1) 0%, rgba(118,75,162,0.1) 100%);
      border-radius: 10px;
      padding: 15px;
      margin-top: 20px;
      text-align: center;
      backdrop-filter: blur(5px);
      animation: fadeIn 1s ease-out 0.3s both;
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    .stat-item {
      display: inline-block;
      margin: 0 15px;
      color: #333;
      font-size: 12px;
      font-weight: 500;
    }

    .stat-number {
      font-size: 24px;
      font-weight: bold;
      display: block;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    /* Quotes */
    .quote-container {
      text-align: center;
      margin-top: 30px;
      padding-top: 20px;
      border-top: 1px solid #e0e0e0;
      animation: fadeIn 1s ease-out 0.6s both;
    }

    .quote-text {
      font-size: 13px;
      color: #666;
      font-style: italic;
      animation: glow 3s ease-in-out infinite;
    }

    @keyframes glow {
      0%, 100% { color: #666; }
      50% { color: #667eea; }
    }

    /* Decorative line */
    .decorative-line {
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 20px 0;
      gap: 10px;
    }

    .line {
      flex: 1;
      height: 1px;
      background: linear-gradient(90deg, transparent, #ccc, transparent);
    }

    .decorative-line i {
      color: #999;
      font-size: 14px;
    }

    /* Link hover effect */
    .text-primary {
      transition: all 0.3s ease;
      position: relative;
    }

    .text-primary::after {
      content: '';
      position: absolute;
      bottom: -2px;
      left: 0;
      width: 0;
      height: 2px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      transition: width 0.3s ease;
    }

    .text-primary:hover::after {
      width: 100%;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .col-lg-4 {
        padding: 0 15px;
      }

      .auth-form-light {
        padding: 30px 20px !important;
      }

      h3 {
        font-size: 24px;
      }

      .stat-item {
        margin: 0 8px;
      }

      .stat-number {
        font-size: 18px;
      }
    }

    /* Efek loading pada tombol saat submit */
    .btn-primary:active {
      transform: scale(0.98);
    }

    /* Animasi icon buku di judul */
    .ti-book {
      animation: bounce 2s ease-in-out infinite;
      display: inline-block;
    }

    @keyframes bounce {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-5px); }
    }

    /* Efek hover pada form group */
    .form-group {
      transition: transform 0.3s ease;
    }

    .form-group:hover {
      transform: translateX(5px);
    }
  </style>
