<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MR. HARTONO BARBERSHOP')</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&display=swap" rel="stylesheet">
</head>
<body>

    <div class="container">
        <!-- NAVBAR -->
        <nav class="navbar">
            <a href="/" class="brand-logo">THE ATELIER</a>
            
            <div class="nav-links">
                <a href="/ecommerceProductPage" class="{{ request()->is('ecommerceProductPage') ? 'active' : '' }}">Shop All</a>
                <a href="{{ route('history') }}" class="{{ request()->routeIs('history') ? 'active' : '' }}">History</a>
                
                @auth
                    @if(Auth::user()->role == 'admin')
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    @endif
                @endauth
            </div>

            <div class="nav-controls">
                @auth
                    <span class="greeting">Halo, {{ Auth::user()->nama }}</span>
                @endauth

                <!-- Live Search (Sesuai kode awal) -->
                <div class="nav-search">
                    <input type="text" class="search-input" placeholder="Cari produk...">
                </div>

                <!-- Cart Icon -->
                <a href="/ecommerceCartPage" title="Cart">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                    </svg>
                </a>
                
                <!-- Auth Logic (Login / Logout Icon) -->
                @guest
                    <a href="{{ route('login') }}" title="Login">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </a>
                @else
                    <a href="{{ route('logout') }}" title="Logout" style="color: #dc3545;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                    </a>
                @endguest
            </div>
        </nav>

        <!-- AJAX Notification -->
        <div id="ajax-notification" style="display: none; position: fixed; top: 100px; right: 20px; background-color: var(--color-gold); color: #000; padding: 15px 25px; border-radius: 4px; z-index: 1050; font-weight: 600; font-size: 14px; text-transform: uppercase; letter-spacing: 1px;"></div>

        <!-- MAIN CONTENT YIELD -->
        @yield('content')

    </div> <!-- End Container -->

    <!-- FOOTER -->
    <footer>
        <div class="footer-brand">THE ATELIER</div>
        <div class="copyright">
            © {{ date('Y') }} THE ATELIER / MR. HARTONO BARBERSHOP. ALL RIGHTS RESERVED.
        </div>
        <div class="crafted-by">
            Made By Kelompok 10 - Rafli Gilang Pasha
        </div>
    </footer>

    <!-- SCRIPTS -->
    <script>
        function showAjaxNotification(message, isSuccess = true) {
            const notification = document.getElementById('ajax-notification');
            if (notification) {
                notification.textContent = message;
                notification.style.backgroundColor = isSuccess ? '#dcb36d' : '#dc3545'; // Gold for success, Red for error
                notification.style.color = isSuccess ? '#000' : '#fff';
                notification.style.display = 'block';

                setTimeout(() => {
                    notification.style.display = 'none';
                }, 3000);
            }
        }
    </script>
    @stack('scripts')
</body>
</html>