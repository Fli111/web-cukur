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
            <a href="/ecommerceProductPage">Shop All</a>  
            <a href="#">Treatment</a> 

            @guest
                <a href="{{ route('login') }}">Login</a>
            @else
                <a>{{ Auth::user()->nama }}</a>
                @if(Auth::user()->role == 'admin')
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                @endif
                <a href="{{ route('logout') }}" style="color: red; font-weight: bold;">Logout</a>
            @endguest

            <a href="/ecommerceCartPage">Cart</a>

            <!-- Live Search -->
            <div class="search-bar">
                <input type="text" class="search-input" placeholder="Cari produk impianmu..." style="width: 300px;">
            </div>
        </div>
    </div>

    @yield('content')

    <footer>
        Made By Kelompok 10 <br>
        Rafli Gilang Pasha
    </footer>
</body>
</html>