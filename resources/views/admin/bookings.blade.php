<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mr. Hartono Admin - Jadwal Booking</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet">
    
    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <style>
        /* --- CSS VARIABLES --- */
        :root {
            --bg-main: #0a0a0a;
            --bg-sidebar: #121212;
            --bg-card: #141414;
            --bg-hover: #1e1e1e;
            
            --accent-gold: #c5a059;
            --accent-gold-hover: #b08d4b;
            --accent-glow: rgba(197, 160, 89, 0.12);
            
            --text-primary: #ffffff;
            --text-secondary: #a0a0a0;
            --text-muted: #555555;
            
            --border-color: #222222;
            
            --font-serif: 'Playfair Display', serif;
            --font-sans: 'Inter', sans-serif;
        }

        /* --- RESET & GLOBAL --- */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

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
            text-align: left;
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

        .sidebar-nav {
            flex-grow: 1;
            padding-top: 20px;
        }

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

        .nav-item i {
            font-size: 20px;
            margin-right: 15px;
        }

        .nav-item:hover {
            color: var(--text-primary);
            background-color: var(--bg-hover);
        }

        .nav-item.active {
            color: var(--accent-gold);
            background-color: var(--bg-hover);
        }

        .nav-item.active::after {
            content: '';
            position: absolute;
            right: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background-color: var(--accent-gold);
        }

        .sidebar-btn-container {
            padding: 30px;
        }

        .btn-new-appointment {
            width: 100%;
            background-color: var(--accent-gold);
            color: #000;
            padding: 15px 0;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: 0.3s;
        }

        .btn-new-appointment:hover {
            background-color: var(--accent-gold-hover);
        }

        .sidebar-footer {
            padding: 20px 30px 40px;
        }

        .sidebar-footer .nav-item {
            padding: 12px 0;
        }

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

        .page-title h2 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 5px;
        }

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
            width: 6px;
            height: 6px;
            background-color: var(--accent-gold);
            border-radius: 50%;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .search-bar {
            display: flex;
            align-items: center;
            background-color: var(--bg-card);
            padding: 10px 20px;
            border-radius: 4px;
            width: 250px;
            border: 1px solid var(--border-color);
        }

        .search-bar i {
            color: var(--text-secondary);
            font-size: 18px;
        }

        .search-bar input {
            background: none;
            border: none;
            color: white;
            outline: none;
            padding-left: 10px;
            font-size: 12px;
            width: 100%;
        }

        .search-bar input::placeholder {
            color: var(--text-muted);
        }

        .notification-icon {
            color: var(--text-secondary);
            font-size: 22px;
            position: relative;
            cursor: pointer;
        }

        .notification-icon::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 6px;
            height: 6px;
            background-color: var(--accent-gold);
            border-radius: 50%;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-info {
            text-align: right;
        }

        .user-info h4 {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .user-info p {
            font-size: 10px;
            color: var(--accent-gold);
        }

        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 1px solid var(--border-color);
        }

        /* --- DASHBOARD CARD (TABLE GRID AREA) --- */
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

        .card-actions {
            display: flex;
            gap: 10px;
        }

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

        .btn-outline:hover {
            background-color: var(--bg-hover);
            color: var(--text-primary);
        }

        /* Responsive Grid System Replacement for Table */
        .table-header-grid, .table-row-grid {
            display: grid;
            grid-template-columns: 0.8fr 1.5fr 1.5fr 1.2fr 1.2fr 1fr 1fr;
            padding: 20px 30px;
            gap: 15px;
            align-items: center;
        }

        .table-header-grid {
            border-bottom: 1px solid var(--border-color);
            background-color: rgba(255, 255, 255, 0.01);
        }

        .table-header-grid div {
            color: var(--text-secondary);
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .table-row-grid {
            border-bottom: 1px solid var(--border-color);
            font-size: 13px;
            color: #e0e0e0;
            transition: background 0.2s ease;
        }

        .table-row-grid:hover {
            background-color: var(--bg-hover);
        }

        .table-row-grid .booking-id {
            color: var(--accent-gold);
            font-weight: 600;
        }

        /* --- MODERN STATUS BADGES --- */
        .badge {
            padding: 5px 12px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-block;
            text-align: center;
        }
        .badge.pending {
            background-color: rgba(245, 158, 11, 0.1);
            color: #f59e0b;
            border: 1px solid rgba(245, 158, 11, 0.2);
        }
        .badge.confirmed {
            background-color: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
            border: 1px solid rgba(59, 130, 246, 0.2);
        }
        .badge.done {
            background-color: rgba(16, 185, 129, 0.1);
            color: #10b981;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }
        .badge.cancelled {
            background-color: rgba(239, 68, 68, 0.1);
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        /* Empty State Styling (The Golden Glow) */
        .empty-state-container {
            position: relative;
            height: 380px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            overflow: hidden;
            border-bottom: 1px solid var(--border-color);
        }

        .empty-state-container::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, var(--accent-glow) 0%, transparent 65%);
            z-index: 1;
            pointer-events: none;
        }

        .empty-content {
            position: relative;
            z-index: 2;
        }

        .empty-icon {
            width: 60px;
            height: 60px;
            background-color: var(--bg-hover);
            border: 1px solid #333;
            transform: rotate(45deg);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
        }

        .empty-icon i {
            transform: rotate(-45deg);
            font-size: 24px;
            color: var(--accent-gold);
        }

        .empty-content h4 {
            font-family: var(--font-serif);
            font-size: 24px;
            font-style: italic;
            margin-bottom: 10px;
        }

        .empty-content p {
            color: var(--text-muted);
            font-size: 11px;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 25px;
        }

        .btn-reload {
            background-color: transparent;
            border: 1px solid var(--accent-gold);
            color: var(--accent-gold);
            padding: 12px 30px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: 0.3s;
        }

        .btn-reload:hover {
            background-color: var(--accent-gold);
            color: #000;
        }

        /* Card Footer */
        .card-footer {
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer-stats {
            display: flex;
            gap: 50px;
        }

        .stat-item p {
            color: var(--text-muted);
            font-size: 10px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .stat-item h5 {
            font-size: 18px;
            font-weight: 600;
        }

        .stat-item h5.gold {
            color: var(--accent-gold);
        }

        .footer-entries {
            color: var(--text-muted);
            font-size: 10px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        /* --- BOTTOM WIDGETS --- */
        .bottom-widgets {
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 20px;
        }

        .widget-card {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 4px;
            padding: 30px;
            position: relative;
            overflow: hidden;
        }

        .insight-widget .widget-label {
            color: var(--text-muted);
            font-size: 10px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        .insight-widget h4 {
            font-size: 18px;
            line-height: 1.5;
            font-weight: 500;
            max-width: 80%;
        }

        .insight-icon {
            position: absolute;
            top: 30px;
            right: 30px;
            color: var(--text-muted);
            font-size: 24px;
        }

        .insight-progress {
            margin-top: 30px;
            height: 4px;
            width: 100px;
            background-color: var(--border-color);
        }

        .insight-progress-bar {
            height: 100%;
            width: 35%;
            background-color: var(--accent-gold);
        }

        .quote-widget {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .quote-content {
            flex: 1;
            padding-right: 30px;
        }

        .quote-content .widget-label {
            color: var(--accent-gold);
            font-size: 10px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 15px;
            font-weight: 700;
        }

        .quote-content h3 {
            font-family: var(--font-serif);
            font-size: 21px;
            font-style: italic;
            line-height: 1.4;
            color: #d1d1d1;
        }

        .quote-image {
            width: 120px;
            height: 120px;
            background-image: url('https://images.unsplash.com/photo-1503951914875-452162b0f3f1?auto=format&fit=crop&w=300&q=80');
            background-size: cover;
            background-position: center;
            border-radius: 4px;
            filter: grayscale(100%) contrast(1.2);
            opacity: 0.7;
        }

        /* --- PAGE FOOTER --- */
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

        .footer-links {
            display: flex;
            gap: 20px;
        }
        
        .footer-links a {
            color: var(--text-muted);
            transition: 0.3s;
        }

        .footer-links a:hover {
            color: var(--text-secondary);
        }

        /* --- RESPONSIVE DESIGN --- */
        @media (max-width: 1100px) {
            .table-header-grid, .table-row-grid {
                grid-template-columns: 1fr 1.5fr 1.2fr 1fr;
            }
            .table-header-grid div:nth-child(3), .table-row-grid div:nth-child(3),
            .table-header-grid div:nth-child(4), .table-row-grid div:nth-child(4) {
                display: none; /* Hide service/barber on smaller viewports */
            }
        }

        @media (max-width: 850px) {
            .main-content { margin-left: 0; max-width: 100vw; padding: 20px; }
            .sidebar { display: none; }
            .bottom-widgets { grid-template-columns: 1fr; }
        }
    </style>
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
                    <a href="{{ url('/admin/dashboard') }}" class="nav-item">
                        <i class="ph ph-package"></i> Kelola Produk
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.bookings') }}" class="nav-item active">
                        <i class="ph ph-calendar-blank"></i> Jadwal Booking
                    </a>
                </li>
                <li>
                    <a href="/" class="nav-item">
                        <i class="ph ph-eye"></i> Kembali ke Web
                    </a>
                </li>
            </ul>
        </nav>

        <div class="sidebar-btn-container">
            <button class="btn-new-appointment">New Appointment</button>
        </div>

        <div class="sidebar-footer">
            <a href="#" class="nav-item">
                <i class="ph ph-gear"></i> Settings
            </a>
            <a href="#" class="nav-item">
                <i class="ph ph-question"></i> Support
            </a>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="main-content">
        
        <!-- Topbar -->
        <header class="top-header">
            <div class="page-title">
                <h2>Jadwal Booking Masuk</h2>
                <p>Live Dashboard - Administrator</p>
            </div>

            <div class="header-actions">
                <div class="search-bar">
                    <i class="ph ph-magnifying-glass"></i>
                    <input type="text" placeholder="Cari Booking...">
                </div>
                
                <div class="notification-icon">
                    <i class="ph ph-bell"></i>
                </div>

                <div class="user-profile">
                    <div class="user-info">
                        <h4>Admin Hartono</h4>
                        <p>Owner's Access</p>
                    </div>
                    <img src="https://ui-avatars.com/api/?name=Admin+Hartono&background=c5a059&color=fff&bold=true" alt="Admin Avatar">
                </div>
            </div>
        </header>

        <!-- Main Dashboard Card -->
        <section class="dashboard-card">
            
            <div class="card-header">
                <div class="card-title">
                    <p>Inventory Log</p>
                    <h3>Overview Antrean</h3>
                </div>
                <div class="card-actions">
                    <button class="btn-outline">
                        <i class="ph ph-faders"></i> Filter
                    </button>
                    <button class="btn-outline">
                        <i class="ph ph-download-simple"></i> Export PDF
                    </button>
                </div>
            </div>

            <!-- Table Header Grid -->
            <div class="table-header-grid">
                <div>ID Booking</div>
                <div>Nama Pelanggan</div>
                <div>Layanan (Service)</div>
                <div>Artisan (Barber)</div>
                <div>Tanggal</div>
                <div>Waktu / Jam</div>
                <div>Status</div>
            </div>

            <!-- FIX INTEGRATION: Laravel Forelse Template Loop -->
            @forelse($bookings as $booking)
                <div class="table-row-grid">
                    <div class="booking-id">#{{ $booking->book_id }}</div>
                    <div>{{ optional($booking->user)->nama ?? 'Tamu/User Dihapus' }}</div>
                    <div>{{ optional($booking->service)->nama_service ?? 'Layanan Tidak Diketahui' }}</div>
                    <div>{{ optional($booking->barber)->nama ?? 'Belum Pilih Barber' }}</div>
                    <div>{{ \Carbon\Carbon::parse($booking->tanggal)->format('d M Y') }}</div>
                    <div>{{ \Carbon\Carbon::parse($booking->waktu)->format('H:i') }} WIB</div>
                    <div>
                        <span class="badge {{ strtolower($booking->status) }}">
                            {{ $booking->status }}
                        </span>
                    </div>
                </div>
            @empty
                <!-- Empty State Component -->
                <div class="empty-state-container">
                    <div class="empty-content">
                        <div class="empty-icon">
                            <i class="ph ph-calendar-x"></i>
                        </div>
                        <h4>Belum ada jadwal booking yang masuk.</h4>
                        <p>Semua data antrean baru akan muncul di sini secara otomatis.</p>
                        <button onclick="window.location.reload();" class="btn-reload">Muat Ulang Dashboard</button>
                    </div>
                </div>
            @endforelse

            <!-- Card Footer Card / Info Summary -->
            <div class="card-footer">
                <div class="footer-stats">
                    <div class="stat-item">
                        <p>Total Bookings</p>
                        <h5>{{ $bookings->count() }}</h5>
                    </div>
                    <div class="stat-item">
                        <p>Revenue Forecast</p>
                        <h5 class="gold">IDR {{ number_format($bookings->count() * 150000, 0, ',', '.') }}</h5>
                    </div>
                </div>
                <div class="footer-entries">
                    Showing {{ $bookings->count() }} entries
                </div>
            </div>
            
        </section>

        <!-- Bottom Widgets -->
        <section class="bottom-widgets">
            <div class="widget-card insight-widget">
                <p class="widget-label">Daily Insight</p>
                <h4>Trend pelanggan meningkat 0% dari minggu lalu.</h4>
                <i class="ph ph-trend-up insight-icon"></i>
                <div class="insight-progress">
                    <div class="insight-progress-bar"></div>
                </div>
            </div>

            <div class="widget-card quote-widget">
                <div class="quote-content">
                    <p class="widget-label">The Artisan Voice</p>
                    <h3>"Precision is not just about the cut; it's about the timing of the experience."</h3>
                </div>
                <div class="quote-image"></div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="page-footer">
            <p>&copy; 2026 MR. HARTONO BARBERSHOP. CRAFTED FOR THE MODERN ATELIER.</p>
            <div class="footer-links">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
                <a href="#">API Access</a>
            </div>
        </footer>

    </main>

</body>
</html>