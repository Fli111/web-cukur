<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mr. Hartono Membership | Onyx & Ember</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400&family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,600;1,700&display=swap" rel="stylesheet">

    <style>
        /* === VARIABLES & RESET === */
        :root {
            --bg-dark: #121212;
            --bg-card: #1c1c1c;
            --bg-card-highlight: #242424;
            --gold: #ceb175;
            --gold-hover: #b5985d;
            --text-white: #ffffff;
            --text-gray: #a3a3a3;
            --text-dark: #121212;
            --font-serif: 'Playfair Display', serif;
            --font-sans: 'Montserrat', sans-serif;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: var(--bg-dark);
            color: var(--text-white);
            font-family: var(--font-sans);
            line-height: 1.6;
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        ul {
            list-style: none;
        }

        /* === NAVBAR === */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 2rem 5%;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .logo {
            font-family: var(--font-serif);
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--gold);
            letter-spacing: 2px;
        }

        .nav-links {
            display: flex;
            gap: 2.5rem;
        }

        .nav-links a {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-gray);
            transition: var(--transition);
        }

        .nav-links a:hover, .nav-links a.active {
            color: var(--text-white);
        }

        .btn-book {
            background-color: var(--gold);
            color: var(--text-dark);
            padding: 0.8rem 1.8rem;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 2px;
            transition: var(--transition);
            border: none;
            cursor: pointer;
        }

        .btn-book:hover {
            background-color: var(--gold-hover);
        }

        /* === HERO SECTION === */
        .hero {
            text-align: center;
            padding: 6rem 20px 4rem;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .hero-kicker {
            font-size: 0.8rem;
            color: var(--gold);
            text-transform: uppercase;
            letter-spacing: 4px;
            margin-bottom: 1rem;
        }

        .hero h1 {
            font-family: var(--font-serif);
            font-size: 4.5rem;
            line-height: 1;
            font-weight: 700;
            letter-spacing: 2px;
        }

        .hero h1.italic {
            font-style: italic;
            color: var(--gold);
            margin-top: -10px;
        }

        .hero-divider {
            width: 60px;
            height: 2px;
            background-color: var(--gold);
            margin: 2.5rem auto;
        }

        .hero p {
            color: var(--text-gray);
            max-width: 500px;
            margin: 0 auto 3rem;
            font-size: 0.95rem;
        }

        .scroll-down {
            color: var(--text-gray);
            font-size: 1.5rem;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
        }

        /* === MEMBERSHIP CARDS === */
        .membership-section {
            padding: 2rem 5% 6rem;
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            align-items: center;
        }

        .card {
            background-color: var(--bg-card);
            padding: 3rem 2.5rem;
            position: relative;
            overflow: hidden;
            border-radius: 4px;
            transition: var(--transition);
            border: 1px solid rgba(255,255,255,0.03);
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .card::before {
            content: attr(data-num);
            position: absolute;
            top: 10px;
            right: 15px;
            font-family: var(--font-serif);
            font-size: 8rem;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.03);
            line-height: 1;
            z-index: 0;
        }

        .card-content {
            position: relative;
            z-index: 1;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .card h2 {
            font-family: var(--font-serif);
            font-size: 1.8rem;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .card .subtitle {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--text-gray);
            margin-bottom: 2.5rem;
        }

        .benefit {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .benefit-val {
            font-family: var(--font-serif);
            font-size: 2.5rem;
            margin-right: 15px;
            line-height: 1;
        }

        .benefit-val span {
            font-size: 1.2rem;
            font-family: var(--font-sans);
        }

        .benefit-text {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-white);
        }

        .benefit-text span {
            display: block;
            text-transform: none;
            font-style: italic;
            font-family: var(--font-serif);
            color: var(--text-gray);
            font-size: 0.9rem;
            margin-top: 2px;
        }

        .priority-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--gold);
            margin-top: 1rem;
        }

        .card-footer {
            margin-top: auto;
            padding-top: 3rem;
        }

        .card-footer .investment-label {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--text-gray);
            margin-bottom: 5px;
        }

        .price {
            font-family: var(--font-serif);
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .price span {
            font-family: var(--font-sans);
            font-size: 0.9rem;
            font-weight: 400;
            color: var(--text-gray);
        }

        .btn-join {
            display: block;
            width: 100%;
            padding: 1rem;
            text-align: center;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            background: transparent;
            color: var(--text-white);
            border: 1px solid rgba(255,255,255,0.2);
            transition: var(--transition);
            cursor: pointer;
        }

        .btn-join:hover {
            border-color: var(--text-white);
            background: rgba(255,255,255,0.05);
        }

        .card.highlight {
            background-color: var(--bg-card-highlight);
            transform: scale(1.05);
            border: 1px solid rgba(206, 177, 117, 0.2);
            box-shadow: 0 20px 40px rgba(0,0,0,0.4);
        }
        
        .card.highlight::before {
            color: rgba(206, 177, 117, 0.05);
        }

        .card.highlight .price {
            color: var(--gold);
        }

        .card.highlight .btn-join {
            background-color: var(--gold);
            color: var(--text-dark);
            border-color: var(--gold);
            font-weight: 600;
        }

        .card.highlight .btn-join:hover {
            background-color: var(--gold-hover);
            border-color: var(--gold-hover);
        }

        /* === FEATURES SECTION === */
        .features {
            display: flex;
            max-width: 1200px;
            margin: 0 auto 6rem;
            padding: 0 5%;
            gap: 4rem;
            align-items: center;
        }

        .feature-img-wrapper {
            flex: 1;
            position: relative;
        }

        .feature-img-wrapper img {
            width: 100%;
            height: auto;
            border-radius: 4px;
            filter: grayscale(100%) contrast(1.2);
            opacity: 0.8;
        }

        .img-badge {
            position: absolute;
            bottom: -20px;
            right: -20px;
            background-color: #242424;
            padding: 1.5rem 2.5rem;
            border-radius: 2px;
            border: 1px solid rgba(255,255,255,0.05);
        }

        .img-badge p {
            font-family: var(--font-serif);
            font-style: italic;
            color: var(--gold);
            font-size: 1.8rem;
        }

        .feature-text {
            flex: 1;
        }

        .feature-text h2 {
            font-family: var(--font-serif);
            font-size: 3rem;
            line-height: 1.2;
            margin-bottom: 1.5rem;
        }

        .feature-text > p {
            color: var(--text-gray);
            margin-bottom: 2.5rem;
            font-size: 1rem;
        }

        .feature-list li {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 1.5rem;
        }

        .feature-list svg {
            width: 24px;
            height: 24px;
            fill: none;
            stroke: var(--gold);
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .list-content h4 {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .list-content p {
            font-size: 0.9rem;
            color: var(--text-gray);
        }

        /* === FOOTER === */
        footer {
            background-color: #0a0a0a;
            padding: 4rem 5% 2rem;
            text-align: center;
        }

        .footer-logo {
            font-family: var(--font-serif);
            font-size: 1.5rem;
            color: var(--gold);
            letter-spacing: 2px;
            margin-bottom: 2rem;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .footer-links a {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-gray);
        }

        .footer-links a:hover {
            color: var(--gold);
        }

        .copyright {
            font-size: 0.7rem;
            color: #555;
            letter-spacing: 1px;
        }

        /* === MODAL LOGIN === */
        .modal-bg {
            display: none; 
            position: fixed;
            z-index: 999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.85);
            backdrop-filter: blur(5px);
            align-items: center;
            justify-content: center;
        }

        .konten-modal {
            background-color: var(--bg-card);
            padding: 3rem;
            border: 1px solid var(--gold);
            border-radius: 4px;
            text-align: center;
            max-width: 450px;
            width: 90%;
            box-shadow: 0 15px 30px rgba(0,0,0,0.5);
        }

        .konten-modal h2 {
            font-family: var(--font-serif);
            color: var(--gold);
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .konten-modal p {
            color: var(--text-gray);
            margin-bottom: 2rem;
            font-size: 0.95rem;
        }

        .grup-tombol {
            display: flex;
            gap: 1rem;
            justify-content: center;
        }

        .tombol-tutup {
            padding: 0.8rem 1.5rem;
            background: transparent;
            color: var(--text-white);
            border: 1px solid rgba(255,255,255,0.2);
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.75rem;
            transition: var(--transition);
        }

        .tombol-tutup:hover {
            background: rgba(255,255,255,0.1);
        }

        .tombol-login-modal {
            padding: 0.8rem 1.5rem;
            background: var(--gold);
            color: var(--text-dark);
            border: 1px solid var(--gold);
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.75rem;
            font-weight: 600;
            transition: var(--transition);
        }

        .tombol-login-modal:hover {
            background: var(--gold-hover);
            border-color: var(--gold-hover);
        }

        /* === RESPONSIVE DESIGN === */
        @media (max-width: 1024px) {
            .membership-section {
                grid-template-columns: 1fr;
                gap: 3rem;
            }
            .card.highlight {
                transform: scale(1);
            }
            .features {
                flex-direction: column;
                gap: 3rem;
            }
            .img-badge {
                right: 5%;
                bottom: -15px;
            }
        }

        @media (max-width: 768px) {
            header {
                flex-direction: column;
                gap: 1.5rem;
            }
            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
                gap: 1rem;
            }
            .hero h1 {
                font-size: 3rem;
            }
            .feature-text h2 {
                font-size: 2.2rem;
            }
            .img-badge p {
                font-size: 1.4rem;
            }
            .footer-links {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <header>
        <div class="logo">ONYX & EMBER</div>
        <nav class="nav-links">
            <a href="{{ route('home') }}">HOME</a>
            <a href="#">BOOK</a>
            <a href="#">PRODUCT</a>
            <a href="" class="active">MEMBER</a>
        </nav>
        <button class="btn-book">BOOK NOW</button>
    </header>

    <!-- HERO -->
    <section class="hero">
        <p class="hero-kicker">THE MODERN ATELIER</p>
        <h1>MR. HARTONO</h1>
        <h1 class="italic">MEMBERSHIP</h1>
        <div class="hero-divider"></div>
        <p>Elevate your grooming ritual to a permanent status. Access bespoke benefits, priority curation, and signature craftsmanship.</p>
        <div class="scroll-down">&#x2304;</div>
    </section>

    <!-- MEMBERSHIPS -->
    <section class="membership-section">
        
        <!-- GOLD CARD -->
        <div class="card" data-num="01">
            <div class="card-content">
                <h2>GOLD</h2>
                <p class="subtitle">ESSENTIAL ACCESS</p>

                <div class="benefit">
                    <div class="benefit-val">10<span>%</span></div>
                    <div class="benefit-text">POTONGAN CUKUR<span>Signature Cut</span></div>
                </div>
                <div class="benefit">
                    <div class="benefit-val">10<span>%</span></div>
                    <div class="benefit-text">POTONGAN PRODUK<span>Grooming Essentials</span></div>
                </div>

                <div class="card-footer">
                    <p class="investment-label">MONTHLY INVESTMENT</p>
                    <div class="price">IDR 20K <span>/ bln</span></div>
                    <a href="{{ route('payment', ['paket' => 'gold']) }}" onclick="return cekLogin(event)" style="display: block;">
                        <button class="btn-join">JOIN GOLD</button>
                    </a>
                </div>
            </div>
        </div>

        <!-- PLATINUM CARD (HIGHLIGHT) -->
        <div class="card highlight" data-num="02">
            <div class="card-content">
                <h2>PLATINUM</h2>
                <p class="subtitle">ELITE DISTINCTION</p>

                <div class="benefit">
                    <div class="benefit-val" style="color: var(--gold)">20<span>%</span></div>
                    <div class="benefit-text">POTONGAN CUKUR<span>Master Barber Sessions</span></div>
                </div>
                <div class="benefit">
                    <div class="benefit-val" style="color: var(--gold)">15<span>%</span></div>
                    <div class="benefit-text">POTONGAN PRODUK<span>Exclusive Aftercare</span></div>
                </div>
                
                <div class="priority-badge">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    PRIORITY BOOKING
                </div>

                <div class="card-footer">
                    <p class="investment-label">ELITE INVESTMENT</p>
                    <div class="price">IDR 25K <span>/ bln</span></div>
                    <a href="{{ url('/payment?paket=platinum') }}" onclick="return cekLogin(event)" style="display: block;">
                        <button class="btn-join">JOIN PLATINUM</button>
                    </a>
                </div>
            </div>
        </div>

        <!-- DIAMOND CARD -->
        <div class="card" data-num="03">
            <div class="card-content">
                <h2>DIAMOND</h2>
                <p class="subtitle">ABSOLUTE PRESTIGE</p>

                <div class="benefit">
                    <div class="benefit-val">25<span>%</span></div>
                    <div class="benefit-text">POTONGAN CUKUR<span>Unlimited Style</span></div>
                </div>
                <div class="benefit">
                    <div class="benefit-val">20<span>%</span></div>
                    <div class="benefit-text">POTONGAN PRODUK<span>Full Collection</span></div>
                </div>

                <div class="card-footer">
                    <p class="investment-label">PRESTIGE INVESTMENT</p>
                    <div class="price">IDR 30K <span>/ bln</span></div>
                    <a href="{{ url('/payment?paket=diamond') }}" onclick="return cekLogin(event)" style="display: block;">
                        <button class="btn-join">JOIN DIAMOND</button>
                    </a>
                </div>
            </div>
        </div>

    </section>

    <!-- FEATURES -->
    <section class="features">
        <div class="feature-img-wrapper">
            <img src="https://images.unsplash.com/photo-1599351431202-1e0f0137899a?auto=format&fit=crop&q=80&w=800" alt="Barber Tools">
            <div class="img-badge">
                <p>"The Atelier Spirit"</p>
            </div>
        </div>
        <div class="feature-text">
            <h2>Beyond the cut,<br>A sense of<br>belonging.</h2>
            <p>Joining Mr. Hartono's inner circle isn't just about the discounts. It's about a curated lifestyle where heritage meets modern precision. Every session is an editorial experience.</p>
            
            <ul class="feature-list">
                <li>
                    <svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    <div class="list-content">
                        <h4>MEMBER-ONLY HOURS</h4>
                        <p>Early morning and late evening access exclusively for our community.</p>
                    </div>
                </li>
                <li>
                    <svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    <div class="list-content">
                        <h4>PRODUCT FIRST-LOOK</h4>
                        <p>Access to limited release apothecary items before they hit the general shelves.</p>
                    </div>
                </li>
            </ul>
        </div>
    </section>

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
            &copy; 2024 ONYX & EMBER ATELIER. ALL RIGHTS RESERVED.
        </div>
    </footer>

    <!-- MODAL LOGIN -->
    <div id="modalLogin" class="modal-bg">
        <div class="konten-modal">
            <h2>Maaf Anda Harus Login!!</h2>
            <p>Silahkan Login terlebih dahulu untuk bergabung dengan membership Mr. Hartono.</p>
            <div class="grup-tombol">
                <button onclick="tutupModal()" class="tombol-tutup">KEMBALI</button>
                <button onclick="keHalamanLogin()" class="tombol-login-modal">LOGIN SEKARANG</button>
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk menutup pop up
        function tutupModal() {
            document.getElementById("modalLogin").style.display = "none";
        }

        // Fungsi untuk mengarahkan ke halaman login Laravel
        function keHalamanLogin() {
            window.location.href = "{{ route('login') }}";
        }

        // Fungsi mengecek status login dengan directive Blade
        function cekLogin(event) {
            @if(!auth()->check())
                event.preventDefault(); 
                document.getElementById("modalLogin").style.display = "flex";
                return false;
            @else
                return true; 
            @endif
        }
    </script>
</body>
</html>