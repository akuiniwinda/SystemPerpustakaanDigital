<style>
    /* ============================================
       PERPUSTAKAAN DIGITAL - DASHBOARD LAYOUT
       Menggunakan class untuk selektor yang lebih maintainable
       ============================================ */

    /* ---------- GLOBAL RESET & BASE ---------- */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
      background: #f0f2f6;
      color: #1e293b;
      line-height: 1.5;
      overflow-x: hidden;
    }

    a {
      text-decoration: none;
      color: inherit;
    }

    ul {
      list-style: none;
    }

    img {
      max-width: 100%;
      display: block;
    }

    /* ---------- TOP NAVBAR ---------- */
    .top-navbar {
      background: #ffffff;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05), 0 1px 2px rgba(0, 0, 0, 0.03);
      padding: 0 1.5rem;
      height: 70px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: sticky;
      top: 0;
      z-index: 100;
      border-bottom: 1px solid #e9eef3;
    }

    .logo-area {
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }

    .logo-area a {
      display: flex;
      align-items: center;
    }

    .logo-area img {
      height: 40px;
      width: auto;
    }

    .nav-controls {
      display: flex;
      align-items: center;
      gap: 1.25rem;
    }

    .mobile-menu-btn {
      display: none;
      background: none;
      border: none;
      font-size: 1.25rem;
      cursor: pointer;
      color: #2c3e50;
    }

    /* Search */
    .search-input {
      border: 1px solid #dce3ec;
      border-radius: 40px;
      padding: 0.5rem 1rem 0.5rem 2.5rem;
      width: 240px;
      font-size: 0.875rem;
      background: #f8fafc url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="%2394a3b8" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>') no-repeat 0.75rem center;
      background-size: 1.1rem;
      transition: all 0.2s ease;
    }

    .search-input:focus {
      outline: none;
      border-color: #3b82f6;
      background-color: #ffffff;
      box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
      width: 280px;
    }

    /* Navbar menus */
    .nav-menu {
      display: flex;
      align-items: center;
      gap: 1rem;
      margin: 0;
    }

    .nav-item {
      position: relative;
    }

    /* Notifikasi */
    .notif-link {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 38px;
      height: 38px;
      border-radius: 50%;
      background: #f1f5f9;
      transition: 0.2s;
      color: #475569;
    }

    .notif-link::before {
      content: "🔔";
      font-size: 1.2rem;
    }

    .notif-dropdown {
      position: absolute;
      top: 48px;
      right: 0;
      width: 320px;
      background: #ffffff;
      border-radius: 1rem;
      box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.08), 0 8px 10px -6px rgba(0, 0, 0, 0.02);
      border: 1px solid #edf2f7;
      opacity: 0;
      visibility: hidden;
      transition: all 0.2s;
      z-index: 200;
    }

    .nav-item:hover .notif-dropdown,
    .nav-item:focus-within .notif-dropdown {
      opacity: 1;
      visibility: visible;
    }

    .notif-dropdown-header {
      padding: 1rem 1rem 0.5rem;
      font-weight: 600;
      border-bottom: 1px solid #eef2f6;
      color: #0f172a;
    }

    .notif-item {
      display: block;
      padding: 0.75rem 1rem;
      border-bottom: 1px solid #f1f5f9;
      transition: 0.15s;
    }

    .notif-item:hover {
      background: #f8fafc;
    }

    .notif-content {
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }

    .notif-icon {
      width: 36px;
      height: 36px;
      background: #eef2ff;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1rem;
      color: #3b82f6;
    }

    .notif-text h6 {
      font-size: 0.8rem;
      font-weight: 600;
      margin-bottom: 0.2rem;
    }

    .notif-text p {
      font-size: 0.7rem;
      color: #6c7a91;
    }

    /* Profile */
    .profile-link img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid #e2e8f0;
      transition: 0.2s;
    }

    .profile-link:hover img {
      border-color: #3b82f6;
    }

    .profile-dropdown {
      position: absolute;
      top: 52px;
      right: 0;
      background: white;
      min-width: 160px;
      border-radius: 0.75rem;
      box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
      border: 1px solid #eef2ff;
      opacity: 0;
      visibility: hidden;
      transition: all 0.2s;
      z-index: 200;
    }

    .nav-item:hover .profile-dropdown,
    .nav-item:focus-within .profile-dropdown {
      opacity: 1;
      visibility: visible;
    }

    .profile-dropdown a {
      display: block;
      padding: 0.7rem 1rem;
      font-size: 0.85rem;
      color: #334155;
      transition: 0.1s;
    }

    .profile-dropdown a:hover {
      background: #f1f5f9;
      color: #0f172a;
    }

    .more-link {
      display: none;
    }

    .toggle-btn {
      display: none;
      background: none;
      border: none;
      font-size: 1.5rem;
      cursor: pointer;
      color: #475569;
    }

    /* ---------- MAIN LAYOUT (sidebar + main panel) ---------- */
    .app-container {
      display: flex;
      min-height: calc(100vh - 70px);
    }

    /* ---------- SIDEBAR ---------- */
    .sidebar {
      width: 280px;
      background: #ffffff;
      border-right: 1px solid #e9edf2;
      padding: 1.75rem 1rem 2rem 1rem;
      display: flex;
      flex-direction: column;
      gap: 2rem;
      flex-shrink: 0;
      transition: all 0.2s;
    }

    .profile-card {
      text-align: center;
      padding-bottom: 1rem;
      border-bottom: 1px solid #eef2f8;
      margin-bottom: 0.5rem;
    }

    .profile-card img {
      width: 90px;
      height: 90px;
      border-radius: 50%;
      object-fit: cover;
      margin: 0 auto 0.75rem auto;
      border: 3px solid #e0e7ff;
      box-shadow: 0 4px 8px rgba(0,0,0,0.02);
    }

    .profile-role {
      font-size: 0.8rem;
      font-weight: 500;
      color: #3b82f6;
      background: #eff6ff;
      display: inline-block;
      padding: 0.2rem 0.8rem;
      border-radius: 30px;
      margin-bottom: 0.5rem;
    }

    .profile-name {
      font-weight: 700;
      font-size: 1.1rem;
      color: #0f172a;
    }

    .sidebar-menu {
      display: flex;
      flex-direction: column;
      gap: 0.3rem;
    }

    .sidebar-menu li a {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      padding: 0.75rem 1rem;
      border-radius: 0.75rem;
      font-weight: 500;
      color: #334155;
      transition: all 0.2s;
    }

    .sidebar-menu li a:hover {
      background: #f1f5f9;
      color: #1e40af;
    }

    .sidebar-menu li.active a {
      background: #eef2ff;
      color: #2563eb;
      font-weight: 600;
    }

    /* Icons for menu items */
    .sidebar-menu li:nth-child(1) a::before { content: "📊"; font-size: 1.1rem; }
    .sidebar-menu li:nth-child(2) a::before { content: "📚"; font-size: 1.1rem; }
    .sidebar-menu li:nth-child(3) a::before { content: "📖"; font-size: 1.1rem; }
    .sidebar-menu li:nth-child(4) a::before { content: "💰"; font-size: 1.1rem; }

    /* ---------- MAIN PANEL ---------- */
    .main-panel {
      flex: 1;
      display: flex;
      flex-direction: column;
      background: #f8fafc;
      overflow-x: auto;
    }

    .content-wrapper {
      padding: 2rem 2rem 1rem 2rem;
      flex: 1;
    }

    /* ---------- CONTENT STYLES (Data Buku, Table, Tambah Buku) ---------- */
    .page-title {
      font-size: 1.8rem;
      font-weight: 700;
      margin-bottom: 1.5rem;
      color: #0f172a;
      letter-spacing: -0.01em;
      display: inline-block;
    }

    .data-buku-card {
      background: #ffffff;
      border-radius: 1.25rem;
      box-shadow: 0 1px 2px rgba(0,0,0,0.03), 0 4px 12px rgba(0,0,0,0.05);
      padding: 1.5rem;
      margin-bottom: 1.5rem;
    }

    .table-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      margin-bottom: 1.75rem;
    }

    .table-header h2 {
      font-size: 1.35rem;
      font-weight: 600;
      color: #1e293b;
      margin: 0;
    }

    .btn-tambah {
      background: #2563eb;
      color: white;
      border: none;
      padding: 0.6rem 1.3rem;
      border-radius: 2rem;
      font-weight: 500;
      font-size: 0.85rem;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      cursor: pointer;
      transition: 0.2s;
      box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    }

    .btn-tambah:hover {
      background: #1d4ed8;
      transform: translateY(-1px);
    }

    .btn-tambah::before {
      content: "+";
      font-size: 1.2rem;
      font-weight: 500;
    }

    .table-responsive {
      overflow-x: auto;
      margin-bottom: 1.2rem;
    }

    .data-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 0.9rem;
    }

    .data-table thead tr {
      border-bottom: 1px solid #e2e8f0;
    }

    .data-table th {
      text-align: left;
      padding: 1rem 0.5rem 0.8rem 0;
      font-weight: 600;
      color: #475569;
    }

    .data-table td {
      padding: 0.9rem 0.5rem 0.9rem 0;
      border-bottom: 1px solid #f1f5f9;
      color: #1e293b;
    }

    .data-table tr:hover td {
      background-color: #fafcff;
    }

    .pagination-info {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      margin-top: 1rem;
      font-size: 0.85rem;
      color: #4b5563;
      border-top: 1px solid #edf2f7;
      padding-top: 1rem;
    }

    .pagination-controls {
      display: flex;
      gap: 0.5rem;
    }

    .pagination-controls span, .pagination-controls a {
      display: inline-block;
      padding: 0.3rem 0.75rem;
      border-radius: 0.5rem;
      background: #f1f5f9;
      color: #2c3e50;
      transition: 0.2s;
    }

    .pagination-controls a:hover {
      background: #e2e8f0;
    }

    /* ---------- FOOTER ---------- */
    .footer {
      background: #ffffff;
      border-top: 1px solid #e2e8f0;
      padding: 1rem 2rem;
      text-align: center;
      font-size: 0.75rem;
      color: #6c7a91;
      margin-top: auto;
    }

    /* ---------- RESPONSIVE ---------- */
    @media (max-width: 1024px) {
      .search-input {
        width: 180px;
      }
      .search-input:focus {
        width: 200px;
      }
    }

    @media (max-width: 768px) {
      .top-navbar {
        padding: 0 1rem;
      }

      .search-wrapper {
        display: none;
      }

      .mobile-menu-btn,
      .toggle-btn {
        display: block;
      }

      .app-container {
        flex-direction: column;
      }

      .sidebar {
        width: 100%;
        flex-direction: row;
        flex-wrap: wrap;
        gap: 1rem;
        padding: 1rem;
        border-right: none;
        border-bottom: 1px solid #e9edf2;
      }

      .profile-card {
        flex: 1;
        display: flex;
        align-items: center;
        gap: 1rem;
        border-bottom: 0;
        text-align: left;
      }

      .profile-card img {
        width: 50px;
        height: 50px;
        margin: 0;
      }

      .sidebar-menu {
        flex-direction: row;
        flex-wrap: wrap;
        width: 100%;
        justify-content: center;
      }

      .content-wrapper {
        padding: 1.5rem;
      }

      .table-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
      }

      .pagination-info {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.8rem;
      }
    }

    @media (max-width: 480px) {
      .content-wrapper {
        padding: 1rem;
      }

      .data-table th, .data-table td {
        font-size: 0.75rem;
        padding-right: 0.3rem;
      }

      .btn-tambah {
        padding: 0.4rem 1rem;
        font-size: 0.8rem;
      }
    }
  </style>
