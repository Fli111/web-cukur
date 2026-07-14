<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Mr. Hartono</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet">

    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <style>
        /* --- CSS VARIABLES --- */
        :root {
            --bg-main:         #0a0a0a;
            --bg-sidebar:      #121212;
            --bg-card:         #141414;
            --bg-hover:        #1e1e1e;
            --accent-gold:     #c5a059;
            --accent-gold-hover: #b08d4b;
            --accent-glow:     rgba(197, 160, 89, 0.12);
            --text-primary:    #ffffff;
            --text-secondary:  #a0a0a0;
            --text-muted:      #555555;
            --border-color:    #222222;
            --font-serif:      'Playfair Display', serif;
            --font-sans:       'Inter', sans-serif;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: var(--font-sans);
            background-color: var(--bg-main);
            color: var(--text-primary);
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }

        a { text-decoration: none; }
        ul { list-style: none; }
        button { cursor: pointer; border: none; font-family: inherit; }

        /* --- SIDEBAR --- */
        .sidebar {
            width: 260px;
            background-color: var(--bg-sidebar);
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            z-index: 10;
        }
        .sidebar-brand {
            padding: 40px 30px;
        }
        .sidebar-brand h1 {
            font-family: var(--font-serif);
            color: var(--accent-gold);
            font-size: 18px;
            letter-spacing: 1px;
            line-height: 1.4;
        }
        .sidebar-brand p {
            color: var(--text-muted);
            font-size: 10px;
            letter-spacing: 2px;
            margin-top: 5px;
            text-transform: uppercase;
        }
        .sidebar-nav { flex-grow: 1; padding-top: 20px; }
        .nav-item {
            display: flex;
            align-items: center;
            padding: 16px 30px;
            color: var(--text-secondary);
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: all 0.3s ease;
            position: relative;
        }
        .nav-item i { font-size: 20px; margin-right: 15px; }
        .nav-item:hover { color: var(--text-primary); background-color: var(--bg-hover); }
        .nav-item.active { color: var(--accent-gold); background-color: var(--bg-hover); }
        .nav-item.active::after {
            content: '';
            position: absolute;
            right: 0; top: 0;
            height: 100%; width: 3px;
            background-color: var(--accent-gold);
        }
        .sidebar-footer { padding: 20px 30px 40px; }
        .sidebar-footer .nav-item { padding: 12px 0; }

        /* --- MAIN CONTENT --- */
        .main-content {
            margin-left: 260px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            padding: 40px;
            max-width: calc(100vw - 260px);
        }

        /* Top Header */
        .top-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }
        .page-title h2 { font-size: 24px; font-weight: 700; margin-bottom: 5px; }
        .page-title p {
            color: var(--accent-gold);
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .page-title p::before {
            content: '';
            display: block;
            width: 6px; height: 6px;
            background-color: var(--accent-gold);
            border-radius: 50%;
        }
        .header-actions { display: flex; align-items: center; gap: 25px; }
        .user-profile { display: flex; align-items: center; gap: 12px; }
        .user-info { text-align: right; }
        .user-info h4 { font-size: 12px; font-weight: 600; text-transform: uppercase; }
        .user-info p { font-size: 10px; color: var(--accent-gold); }
        .user-profile img {
            width: 40px; height: 40px;
            border-radius: 50%; object-fit: cover;
            border: 1px solid var(--border-color);
        }

        /* --- DASHBOARD CARD --- */
        .dashboard-card {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 4px;
            display: flex;
            flex-direction: column;
            margin-bottom: 30px;
        }
        .card-header {
            padding: 30px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            border-bottom: 1px solid var(--border-color);
        }
        .card-title p {
            color: var(--text-muted);
            font-size: 10px;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 5px;
        }
        .card-title h3 {
            font-family: var(--font-serif);
            font-size: 28px;
            font-style: italic;
            font-weight: 600;
        }
        .card-actions { display: flex; gap: 10px; }
        .btn-outline {
            background-color: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-secondary);
            padding: 10px 20px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: 0.3s;
        }
        .btn-outline:hover { background-color: var(--bg-hover); color: var(--text-primary); }

        /* Tombol Gold */
        .btn-gold {
            background-color: var(--accent-gold);
            color: #000;
            padding: 10px 20px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: 0.3s;
        }
        .btn-gold:hover { background-color: var(--accent-gold-hover); }

        /* Badge Status */
        .badge {
            padding: 5px 12px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-block;
        }
        .badge.pending    { background: rgba(245,158,11,0.1); color: #f59e0b; border: 1px solid rgba(245,158,11,0.2); }
        .badge.confirmed  { background: rgba(59,130,246,0.1); color: #3b82f6; border: 1px solid rgba(59,130,246,0.2); }
        .badge.done       { background: rgba(16,185,129,0.1); color: #10b981; border: 1px solid rgba(16,185,129,0.2); }
        .badge.cancelled  { background: rgba(239,68,68,0.1);  color: #ef4444; border: 1px solid rgba(239,68,68,0.2); }
        .badge.tersedia   { background: rgba(16,185,129,0.1); color: #10b981; border: 1px solid rgba(16,185,129,0.2); }
        .badge.habis      { background: rgba(239,68,68,0.1);  color: #ef4444; border: 1px solid rgba(239,68,68,0.2); }

        /* Card Footer */
        .card-footer {
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .footer-stats { display: flex; gap: 50px; }
        .stat-item p { color: var(--text-muted); font-size: 10px; letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 5px; }
        .stat-item h5 { font-size: 18px; font-weight: 600; }
        .stat-item h5.gold { color: var(--accent-gold); }
        .footer-entries { color: var(--text-muted); font-size: 10px; letter-spacing: 1px; text-transform: uppercase; }

        /* Empty State */
        .empty-state-container {
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            overflow: hidden;
            border-bottom: 1px solid var(--border-color);
        }
        .empty-state-container::before {
            content: '';
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            width: 400px; height: 400px;
            background: radial-gradient(circle, var(--accent-glow) 0%, transparent 65%);
            pointer-events: none;
        }
        .empty-content { position: relative; z-index: 2; }
        .empty-icon {
            width: 60px; height: 60px;
            background-color: var(--bg-hover);
            border: 1px solid #333;
            transform: rotate(45deg);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 25px;
        }
        .empty-icon i { transform: rotate(-45deg); font-size: 24px; color: var(--accent-gold); }
        .empty-content h4 { font-family: var(--font-serif); font-size: 22px; font-style: italic; margin-bottom: 10px; }
        .empty-content p { color: var(--text-muted); font-size: 11px; letter-spacing: 1px; text-transform: uppercase; }

        /* Bottom Widgets */
        .bottom-widgets { display: grid; grid-template-columns: 1fr 1.5fr; gap: 20px; }
        .widget-card {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 4px;
            padding: 30px;
            position: relative;
            overflow: hidden;
        }

        /* Page Footer */
        .page-footer {
            margin-top: auto;
            padding-top: 40px;
            display: flex;
            justify-content: space-between;
            color: var(--text-muted);
            font-size: 10px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .footer-links { display: flex; gap: 20px; }
        .footer-links a { color: var(--text-muted); transition: 0.3s; }
        .footer-links a:hover { color: var(--text-secondary); }

        /* Flash message */
        .flash-success {
            background: rgba(16,185,129,0.1);
            border: 1px solid rgba(16,185,129,0.2);
            color: #10b981;
            padding: 12px 20px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 13px;
        }
        .flash-error {
            background: rgba(239,68,68,0.1);
            border: 1px solid rgba(239,68,68,0.2);
            color: #ef4444;
            padding: 12px 20px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        /* Responsive */
        @media (max-width: 850px) {
            .main-content { margin-left: 0; max-width: 100vw; padding: 20px; }
            .sidebar { display: none; }
            .bottom-widgets { grid-template-columns: 1fr; }
        }

        /* Slot untuk CSS tambahan per halaman */
        @yield('extra-css')
    </style>

    @stack('styles')
</head>
<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <h1>MR. HARTONO<br>ADMIN PANEL</h1>
            <p>The Modern Atelier</p>
        </div>

        <nav class="sidebar-nav">
            <ul>
                <li>
                    <a href="{{ url('/admin/dashboard') }}"
                       class="nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <i class="ph ph-package"></i> Kelola Produk
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.bookings') }}"
                       class="nav-item {{ request()->is('admin/bookings') ? 'active' : '' }}">
                        <i class="ph ph-calendar-blank"></i> Jadwal Booking
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-item">
                        <i class="ph ph-receipt"></i> Transaksi
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-item">
                        <i class="ph ph-users"></i> Pelanggan
                    </a>
                </li>
                <li>
                    <a href="{{ url('/') }}" class="nav-item">
                        <i class="ph ph-eye"></i> Kembali ke Web
                    </a>
                </li>
            </ul>
        </nav>

        <div class="sidebar-footer">
            <a href="{{ route('logout') }}" class="nav-item">
                <i class="ph ph-sign-out"></i> Logout
            </a>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="main-content">

        <!-- Top Header -->
        <header class="top-header">
            <div class="page-title">
                <h2>@yield('page-title', 'Dashboard')</h2>
                <p>@yield('page-subtitle', 'Administrator Panel')</p>
            </div>

            <div class="header-actions">
                <div class="user-profile">
                    <div class="user-info">
                        <h4>{{ Auth::user()->nama ?? 'Admin' }}</h4>
                        <p>Owner's Access</p>
                    </div>
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nama ?? 'Admin') }}&background=c5a059&color=fff&bold=true" alt="Avatar">
                </div>
            </div>
        </header>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="flash-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="flash-error">{{ session('error') }}</div>
        @endif

        {{-- Konten halaman --}}
        @yield('content')

        <!-- Footer -->
        <footer class="page-footer">
            <p>&copy; 2026 MR. HARTONO BARBERSHOP. CRAFTED FOR THE MODERN ATELIER.</p>
            <div class="footer-links">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
            </div>
        </footer>

    </main>

    @stack('scripts')
</body>
</html>