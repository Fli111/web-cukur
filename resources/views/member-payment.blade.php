<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Member - Onyx & Ember</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">

    <style>
        /* === CSS RESET & VARIABLES === */
        :root {
            --bg-dark: #101010;
            --bg-panel: #171717;
            --bg-input: #1f1f1f;
            --color-gold: #cca969;
            --color-gold-hover: #e0be7d;
            --text-main: #ffffff;
            --text-muted: #999999;
            --font-serif: 'Playfair Display', serif;
            --font-sans: 'Montserrat', sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: var(--bg-dark);
            color: var(--text-main);
            font-family: var(--font-sans);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        /* === HEADER === */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 30px 5%;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .brand-logo {
            font-family: var(--font-serif);
            font-size: 24px;
            font-weight: 700;
            color: var(--color-gold);
            text-decoration: none;
            letter-spacing: 1px;
        }

        .nav-links {
            display: flex;
            gap: 40px;
        }

        .nav-links a {
            color: var(--text-main);
            text-decoration: none;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: color 0.3s ease;
        }

        .nav-links a:hover {
            color: var(--color-gold);
        }

        .btn-header {
            background-color: var(--color-gold);
            color: #000;
            border: none;
            padding: 12px 24px;
            font-family: var(--font-sans);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-header:hover {
            background-color: var(--color-gold-hover);
        }

        /* === MAIN LAYOUT === */
        .checkout-container {
            max-width: 1200px;
            margin: 60px auto;
            padding: 0 5%;
            display: flex;
            gap: 60px;
            align-items: flex-start;
        }

        .checkout-left {
            flex: 1;
        }

        .checkout-right {
            flex: 0 0 420px;
        }

        /* === LEFT SIDE (FORM) === */
        .page-title {
            font-family: var(--font-serif);
            font-size: 64px;
            font-weight: 700;
            letter-spacing: 2px;
            line-height: 1.1;
            margin-bottom: 5px;
        }

        .page-subtitle {
            font-size: 12px;
            color: var(--color-gold);
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 50px;
        }

        .step-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
            margin-top: 50px;
        }

        .step-header:first-of-type {
            margin-top: 0;
        }

        .step-number {
            background-color: var(--text-main);
            color: var(--bg-dark);
            width: 32px;
            height: 32px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 700;
            font-size: 14px;
        }

        .step-title {
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .input-group {
            margin-bottom: 25px;
        }

        .input-group label {
            display: block;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 1.5px;
            margin-bottom: 10px;
            color: var(--text-main);
            text-transform: uppercase;
        }

        .input-group input {
            width: 100%;
            background-color: var(--bg-input);
            border: none;
            padding: 18px 20px;
            color: var(--text-muted);
            font-family: var(--font-sans);
            font-size: 14px;
            outline: none;
        }

        .payment-info-box {
            background-color: var(--bg-input);
            padding: 25px;
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .payment-info-box p {
            font-size: 13px;
            color: var(--text-muted);
            line-height: 1.8;
        }

        .payment-info-box strong {
            color: var(--text-main);
            font-weight: 600;
        }
        
        .payment-info-box em {
            color: var(--color-gold);
            font-style: italic;
        }

        /* === RIGHT SIDE (SUMMARY CARD) === */
        .summary-card {
            background-color: var(--bg-panel);
            padding: 40px;
        }

        .summary-label {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 2px;
            color: var(--text-main);
            margin-bottom: 20px;
        }

        .tier-title {
            font-family: var(--font-serif);
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .tier-subtitle {
            font-size: 11px;
            color: var(--color-gold);
            font-weight: 600;
            letter-spacing: 1.5px;
            margin-bottom: 40px;
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            padding-bottom: 30px;
            margin-bottom: 30px;
        }

        .price-row span:first-child {
            font-size: 12px;
            letter-spacing: 1px;
            color: var(--text-muted);
        }

        .price-row span:last-child {
            font-size: 18px;
            font-family: var(--font-serif);
        }

        .total-section {
            text-align: center;
            margin-bottom: 35px;
        }

        .total-section p {
            font-size: 11px;
            letter-spacing: 1.5px;
            color: var(--text-muted);
            margin-bottom: 10px;
        }

        .total-amount {
            font-family: var(--font-serif);
            font-size: 54px;
            font-weight: 700;
            color: var(--color-gold);
            line-height: 1;
        }

        .btn-checkout {
            width: 100%;
            background-color: var(--color-gold);
            color: #000;
            border: none;
            padding: 18px;
            font-family: var(--font-sans);
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-bottom: 20px;
        }

        .btn-checkout:hover {
            background-color: var(--color-gold-hover);
        }

        .secure-checkout {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            font-size: 10px;
            color: var(--text-muted);
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .perks-section {
            margin-top: 30px;
            display: flex;
            gap: 15px;
            align-items: flex-start;
        }

        .perks-icon {
            color: var(--color-gold);
            flex-shrink: 0;
            margin-top: 2px;
        }

        .perks-content h4 {
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 1.5px;
            margin-bottom: 5px;
        }

        .perks-content p {
            font-size: 12px;
            color: var(--text-muted);
            line-height: 1.6;
        }

        /* === FOOTER === */
        footer {
            background-color: var(--bg-dark);
            padding: 60px 20px;
            text-align: center;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            margin-top: 80px;
        }

        .footer-logo {
            font-family: var(--font-serif);
            font-size: 20px;
            color: var(--color-gold);
            font-weight: 700;
            letter-spacing: 2px;
            margin-bottom: 30px;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin-bottom: 30px;
        }

        .footer-links a {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 11px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: var(--color-gold);
        }

        .copyright {
            font-size: 11px;
            color: var(--text-muted);
            letter-spacing: 1px;
        }

        /* === RESPONSIVE === */
        @media (max-width: 900px) {
            .checkout-container {
                flex-direction: column;
                gap: 40px;
            }
            .checkout-right {
                flex: auto;
                width: 100%;
            }
            .nav-links, .btn-header {
                display: none; /* Sembunyikan menu di mobile untuk kesederhanaan */
            }
            .page-title {
                font-size: 42px;
            }
            .total-amount {
                font-size: 42px;
            }
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <header>
        <a href="#" class="brand-logo">ONYX & EMBER</a>
        <div class="nav-links">
            <a href="#">Services</a>
            <a href="#">Barbers</a>
            <a href="#">Gallery</a>
            <a href="#">Journal</a>
        </div>
        <button class="btn-header">BOOK NOW</button>
    </header>

    <!-- MAIN CHECKOUT SECTION -->
    <main class="checkout-container">
        
        <!-- SISI KIRI (FORM) -->
        <div class="checkout-left">
            <h1 class="page-title">CHECKOUT</h1>
            <p class="page-subtitle">PENDAFTARAN KEANGGOTAAN</p>

            <!-- Step 1: Informasi Kontak -->
            <div class="step-header">
                <span class="step-number">01</span>
                <span class="step-title">INFORMASI KONTAK</span>
            </div>

            <div class="input-group">
                <label>NAMA</label>
                <input type="text" value="{{ Auth::user()->nama ?? 'Rafli Gilang Pasha' }}" readonly>
            </div>

            <div class="input-group">
                <label>ALAMAT EMAIL</label>
                <input type="email" value="{{ Auth::user()->email ?? 'raflixgilang@gmail.com' }}" readonly>
            </div>

            <!-- Step 2: Pembayaran -->
            <div class="step-header">
                <span class="step-number">02</span>
                <span class="step-title">PEMBAYARAN</span>
            </div>

            <div class="payment-info-box">
                <!-- SVG Icon Dompet/Kartu -->
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--text-muted)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="5" width="20" height="14" rx="2" ry="2"></rect>
                    <line x1="2" y1="10" x2="22" y2="10"></line>
                </svg>
                <p>Pembayaran dilakukan melalui <strong>Midtrans</strong>. Klik tombol <em>"Selesaikan Pembelian"</em> untuk memilih metode pembayaran.</p>
            </div>
        </div>

        <!-- SISI KANAN (RINGKASAN PESANAN) -->
        <aside class="checkout-right">
            <div class="summary-card">
                <p class="summary-label">RINGKASAN PESANAN</p>
                <h2 class="tier-title">{{ strtoupper($paket ?? 'PLATINUM') }} Member</h2>
                <p class="tier-subtitle">KEANGGOTAAN BULANAN</p>

                <div class="price-row">
                    <span>TARIF PAKET</span>
                    <span>IDR {{ number_format($harga ?? 25000, 0, ',', '.') }}</span>
                </div>

                <div class="total-section">
                    <p>TOTAL PEMBAYARAN</p>
                    <div class="total-amount">
                        IDR {{ number_format($harga ?? 25000, 0, ',', '.') }}
                    </div>
                </div>

                {{-- Flash message error Laravel --}}
                @if(session('error'))
                    <div style="color:#ff4d4d; font-size:12px; margin-bottom:15px; text-align:center;">
                        {{ session('error') }}
                    </div>
                @endif

                <button id="btn-bayar" class="btn-checkout">SELESAIKAN PEMBELIAN</button>

                <div class="secure-checkout">
                    <!-- SVG Secure Check Shield -->
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        <polyline points="9 12 11 14 15 10"></polyline>
                    </svg>
                    SECURE CHECKOUT
                </div>
            </div>

            <!-- Perks Section -->
            <div class="perks-section">
                <!-- SVG Scissors Icon -->
                <div class="perks-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="6" cy="6" r="3"></circle>
                        <circle cx="6" cy="18" r="3"></circle>
                        <line x1="20" y1="4" x2="8.12" y2="15.88"></line>
                        <line x1="14.47" y1="14.48" x2="20" y2="20"></line>
                        <line x1="8.12" y1="8.12" x2="12" y2="12"></line>
                    </svg>
                </div>
                <div class="perks-content">
                    <h4>PLATINUM PERKS</h4>
                    <p>Includes priority booking, 15% discount on grooming products, and exclusive access to the Atelier Lounge.</p>
                </div>
            </div>
        </aside>
    </main>

    <!-- FOOTER -->
    <footer>
        <div class="footer-logo">ONYX & EMBER</div>
        <div class="footer-links">
            <a href="#">PRIVACY</a>
            <a href="#">TERMS</a>
            <a href="#">ACCESSIBILITY</a>
            <a href="#">CONTACT</a>
        </div>
        <div class="copyright">
            © 2026 ONYX & EMBER ATELIER. ALL RIGHTS RESERVED.
        </div>
    </footer>

    {{-- Midtrans Snap JS --}}
    @if(env('MIDTRANS_IS_PRODUCTION'))
        <script src="https://app.midtrans.com/snap/snap.js"
                data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    @else
        <script src="https://app.sandbox.midtrans.com/snap/snap.js"
                data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    @endif

    <script>
        document.getElementById('btn-bayar').addEventListener('click', function() {
            // Cek apakah token tersedia, mencegah error JS jika halaman di-load tanpa token
            var snapToken = '{{ $snapToken ?? "" }}';
            
            if(!snapToken) {
                alert('Token Midtrans tidak ditemukan. Silakan refresh halaman atau coba lagi.');
                return;
            }

            snap.pay(snapToken, {
                onSuccess: function(result) {
                    window.location.href = "{{ route('member.finish') }}?order_id=" + result.order_id + "&transaction_status=" + result.transaction_status;
                },
                onPending: function(result) {
                    window.location.href = "{{ route('member.finish') }}?order_id=" + result.order_id + "&transaction_status=pending";
                },
                onError: function(result) {
                    alert('Pembayaran gagal. Silakan coba lagi.');
                },
                onClose: function() {
                    console.log('Popup Midtrans ditutup.');
                }
            });
        });
    </script>
</body>
</html>