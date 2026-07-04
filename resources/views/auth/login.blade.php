<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MR. HARTONO</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body class="login-body">
    <div class="login-box">
        <div class="login-title">MR. HARTONO</div>
        <div class="login-subtitle">Silakan masuk menggunakan Email Anda</div>

        @if(session('error'))
            <div style="background-color: #ffebee; color: #d93025; padding: 10px; border-radius: 6px; margin-bottom: 15px; font-weight: bold; border: 1px solid #d93025;">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div style="background-color: #e6f4ea; color: #1e8e3e; padding: 10px; border-radius: 6px; margin-bottom: 15px; font-weight: bold; border: 1px solid #1e8e3e;">
                {{ session('success') }}
            </div>
        @endif

        <form action="/login" method="POST">
            @csrf
            <div class="form-group-login-page">
                <label style="display: block; font-weight: bold; margin-bottom: 8px; font-size: 14px; color: #333;">Email</label>
                <input type="email" name="email" class="form-input-login-page" placeholder="contoh@email.com" required>
            </div>

            <div class="form-group-login-page">
                <label style="display: block; font-weight: bold; margin-bottom: 8px; font-size: 14px; color: #333;">Password</label>
                <input type="password" name="password" class="form-input-login-page" placeholder="********" required>
            </div>

            <button type="submit" class="btn-login">LOGIN</button>
        </form>

        <div class="register-link">
            Belum punya akun pelanggan? <a href="/register">Daftar di sini</a>
        </div>
    </div>
</body>
</html>