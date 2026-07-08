<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MR. HARTONO BARBERSHOP')</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
    <div class="navbar">
        <a href="/">MR. HARTONO</a>
        <div class="nav-menu">
            @guest
                <a href="{{ route('login') }}">Login</a>
            @else
                <a>{{ Auth::user()->nama }}</a>
                @if(Auth::user()->role == 'admin')
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                @endif
                <a href="{{ route('logout') }}" style="color: red; font-weight: bold;">Logout</a>
            @endguest
            <a href="/ecommerceProductPage">Shop All</a>

            <a href="/ecommerceCartPage">Cart</a>

            <!-- Live Search -->
            <div class="search-bar">
                <input type="text" class="search-input" placeholder="Cari produk impianmu..." style="width: 300px;">
            </div>
        </div>
    </div>

    <div id="ajax-notification" style="display: none; position: fixed; top: 80px; right: 20px; background-color: #28a745; color: white; padding: 15px; border-radius: 8px; z-index: 1050; box-shadow: 0 5px 15px rgba(0,0,0,0.2); font-weight: bold; font-size: 16px;"></div>

    @yield('content')

    <footer>
        Made By Kelompok 10 <br>
        Rafli Gilang Pasha
    </footer>

    <script>
    function showAjaxNotification(message, isSuccess = true) {
        const notification = document.getElementById('ajax-notification');
        if (notification) {
            notification.textContent = message;
            notification.style.backgroundColor = isSuccess ? '#28a745' : '#dc3545'; // Hijau untuk sukses, merah untuk error
            notification.style.display = 'block';

            setTimeout(() => {
                notification.style.display = 'none';
            }, 3000); // Sembunyikan setelah 3 detik
        }
    }
    </script>
    @stack('scripts')
</body>
</html>