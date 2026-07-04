<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - MR. HARTONO</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body class="login-body">
    <div class="login-box">

        <h1 class="login-title">Daftar Akun Baru</h1>
        <p class="login-subtitle">Bergabunglah dan nikmati layanan MR. HARTONO</p>

        <!-- Pesan Error / Validasi -->
        @if(session('error'))
            <div style="background-color: #fce8e6; color: #d93025; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; text-align: left; border: 1px solid #fad2e1;">
                {{ session('error') }}
            </div>
        @endif

        <!-- Form Register -->
        <form action="/register" method="POST">
            @csrf
            
            <div class="form-group-login-page">
                <label style="display: block; font-weight: bold; margin-bottom: 8px; font-size: 14px; color: #333;">Nama Lengkap</label>
                <input type="text" name="nama" class="form-input-login-page" placeholder="Masukkan nama" required>
            </div>

            <div class="form-group-login-page">
                <label style="display: block; font-weight: bold; margin-bottom: 8px; font-size: 14px; color: #333;">Email Address</label>
                <input type="email" name="email" class="form-input-login-page" placeholder="Masukkan email" required>
            </div>

            <div class="form-group-login-page">
                <label style="display: block; font-weight: bold; margin-bottom: 8px; font-size: 14px; color: #333;">Password</label>
                <input type="password" name="password" class="form-input-login-page" placeholder="Bikin password yang aman..." required>
            </div>

            <button type="submit" class="btn-login">REGISTER SEKARANG</button>
        </form>

        <div class="register-link">
            Udah punya akun? <a href="/login">Login di sini</a>
        </div>
    </div>
</body>
</html>