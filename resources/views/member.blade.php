2<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mr. Hartono BarberShop</title>

    {{-- Google Fonts yang dipakai di CSS lo --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Inter:wght@300;400&display=swap" rel="stylesheet">

    {{-- CSS Home --}}
    <link rel="stylesheet" href="{{ asset('home.css') }}">

    <script src="{{ asset('script.js') }}" defer></script>
</head>
<body>

    {{-- ==================== NAVBAR ==================== --}}
    <section>
        <nav class="navbar" id="home">
            <div class="logo">THE ALTER</div>

            <ul class="nav-link">
                <li><a href="#home">HOME</a></li>
                <li><a href="#service">SERVICE</a></li>
                <li><a href="#team">TEAM</a></li>
                <li><a href="#gallery">GALLERY</a></li>
                <li><a href="#about">ABOUT</a></li>
                <li><a href="#contact">CONTACT</a></li>
                <li><a href="{{ url('/shop') }}">SHOP</a></li>       {{-- Ganti ke route('/shop') kalau sudah ada --}}
                <li><a href="#">MEMBER</a></li>     {{-- Ganti ke route('/member') kalau sudah ada --}}
            </ul>

            <div class="btn">
                <a href="#service">BOOK APPOINTMENT</a>
            </div>
        </nav>
    </section>

    {{-- ==================== HERO ==================== --}}
    <section class="hero">
        <div class="hero-overlay">
            <p class="est">ESTABLISHED 2020</p>
            <h1>MR. <br>HARTONO</h1>
            <p class="desc">
                Redefining the modern grooming experience through surgical precision,
                heritage techniques, and an uncompromising eye for detail.
            </p>

            <div class="hero-btn">
                <a href="#service" class="btn-gold">BOOK NOW</a>
                <a href="#" class="btn-link">EXPLORE SERVICE →</a>
            </div>

            <div class="location">
                <p>LOCATION</p>
                <span>Jl. Taman Harapan Baru Raya</span>
            </div>
        </div>
    </section>

    {{-- ==================== ABOUT ==================== --}}
    <section class="heros" id="about">
        <div class="container">
            <div class="left">
                <img src="{{ asset('img/NetWork.jpeg') }}" alt="Atelier Network">
                <div class="badge">
                    <h2>5+</h2>
                    <p>YEARS OF MASTERY</p>
                </div>
            </div>
            <div class="right">
                <h1>
                    A modern <br>
                    <span>Atelier Network</span>
                </h1>
                <p class="descs">
                    Mr. Hartono isn't just a barbershop; it's a dedicated sanctuary of precision
                    where the craft of grooming is elevated to a high art form.
                    Founded on the belief that every man deserves a tailored aesthetic,
                    we have cultivated a premier destination for the discerning individual who values quality over convenience.
                    We understand that a haircut is more than a routine—it is a moment of refinement.
                </p>
                <p class="descs">
                    Every member of our elite team is a true artisan,
                    meticulously trained in the complex geometry of modern
                    fades as well as the timeless, meditative ritual of the classic straight razor shave.
                    We pride ourselves on creating an atmosphere that balances contemporary style with
                    old-world sophistication. At Mr. Hartono, we provide far more than a standard trim;
                    we provide a signature identity and the confidence that comes with a look uniquely crafted for you.
                </p>
                <a href="#" class="btns">READ OUR STORY</a>
            </div>
        </div>
    </section>

    {{-- ==================== MISSION ==================== --}}
    <section class="mission">
        <div class="mission-header">
            <p>THE CORE VALUES</p>
            <h2>Our Mission</h2>
        </div>
        <div class="mission-container">
            <div class="mission-card">
                <div class="icon">✂️</div>
                <h3>Precision Engineering</h3>
                <p>
                    We view hair through a structural lens, ensuring every cut grows
                    out perfectly and maintains its shape for weeks.
                </p>
            </div>
            <div class="mission-card">
                <div class="icon">🪒</div>
                <h3>Preserving Ritual</h3>
                <p>
                    From hot towels to traditional lather, we honor the meticulous
                    rituals that have defined the gentleman's barbershop for centuries.
                </p>
            </div>
            <div class="mission-card">
                <div class="icon">📐</div>
                <h3>Tailored Identity</h3>
                <p>
                    No templates. No generic styles. We consult deeply to understand
                    your face shape, lifestyle, and unique aesthetic goals.
                </p>
            </div>
        </div>
    </section>

    {{-- ==================== SERVICE MENU ==================== --}}
    <section class="menu" id="service">
        <div class="menu-header">
            <h2>THE MENU</h2>
            <p>
                Curated grooming packages designed for the modern lifestyle.
                Click an item to view full details and ritual components.
            </p>
        </div>

        <div class="menu-item">
            <div class="menu-title" onclick="toggleMenu(this)">
                <span>01</span>
                <h3>THE ALTER HAIRCUT</h3>
                <div class="price">65k <b>⌄</b></div>
            </div>
            <div class="menu-content">
                <div class="left-menu">
                    <h4>SERVICE VARIATIONS</h4>
                    <p><strong>Classic Atelier Cut</strong> - 65k</p>
                    <p><strong>Executive Master Cut</strong> - 85k</p>
                    <p><strong>Wash, Style & Sculpt</strong> - 45k</p>
                </div>
                <div class="right-menu">
                    <h4>INCLUDED RITUALS</h4>
                    <ul>
                        <li>Anatomical analysis</li>
                        <li>Triple-hot towel</li>
                        <li>Signature pomade finish</li>
                    </ul>
                    <a href="#" class="btn-gold-menu">SERVICE ORDER</a> {{-- Ganti ke route book kalau sudah ada --}}
                </div>
            </div>
        </div>

        <div class="menu-item">
            <div class="menu-title" onclick="toggleMenu(this)">
                <span>02</span>
                <h3>RITUAL HOT SHAVE</h3>
                <div class="price">55k <b>⌄</b></div>
            </div>
            <div class="menu-content">
                <div class="left-menu">
                    <h4>SERVICE VARIATIONS</h4>
                    <p><strong>Classic Shave</strong> - 55k</p>
                    <p><strong>Luxury Shave</strong> - 75k</p>
                </div>
                <div class="right-menu">
                    <h4>INCLUDED RITUALS</h4>
                    <ul>
                        <li>Hot towel treatment</li>
                        <li>Premium shaving cream</li>
                        <li>Aftershave care</li>
                    </ul>
                    <a href="#" class="btn-gold-menu">SERVICE ORDER</a>
                </div>
            </div>
        </div>

        <div class="menu-item">
            <div class="menu-title" onclick="toggleMenu(this)">
                <span>03</span>
                <h3>BEARD SCULPTING</h3>
                <div class="price">45k <b>⌄</b></div>
            </div>
            <div class="menu-content">
                <div class="left-menu">
                    <h4>SERVICE VARIATIONS</h4>
                    <p><strong>Basic Trim</strong> - 45k</p>
                    <p><strong>Full Sculpt</strong> - 65k</p>
                </div>
                <div class="right-menu">
                    <h4>INCLUDED RITUALS</h4>
                    <ul>
                        <li>Precision trimming</li>
                        <li>Beard shaping</li>
                        <li>Oil treatment</li>
                    </ul>
                    <a href="#" class="btn-gold-menu">SERVICE ORDER</a>
                </div>
            </div>
        </div>

        <div class="menu-item">
            <div class="menu-title" onclick="toggleMenu(this)">
                <span>04</span>
                <h3>THE EXECUTIVE PACKAGE</h3>
                <div class="price">110k <b>⌄</b></div>
            </div>
            <div class="menu-content">
                <div class="left-menu">
                    <h4>SERVICE VARIATIONS</h4>
                    <p><strong>Full Grooming</strong> - 110k</p>
                    <p><strong>Premium Package</strong> - 150k</p>
                </div>
                <div class="right-menu">
                    <h4>INCLUDED RITUALS</h4>
                    <ul>
                        <li>Haircut + shave</li>
                        <li>Hot towel & massage</li>
                        <li>Premium styling</li>
                    </ul>
                    <a href="#" class="btn-gold-menu">SERVICE ORDER</a>
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== TEAM ==================== --}}
    <section class="team" id="team">
        <h2>The Master Barbers</h2>

        <div class="team-grid">
            <div class="card">
                <img src="{{ asset('img/TheMaster1.jpeg') }}" alt="Aksa Mahardika">
                <div class="overlay">
                    <p class="role">CREATIVE DIRECTOR</p>
                    <h3>Aksa Mahardika</h3>
                </div>
            </div>
            <div class="card">
                <img src="{{ asset('img/TheMaster2.jpeg') }}" alt="Gavra Rakabuming">
                <div class="overlay">
                    <p class="role">LEAD ARTISAN</p>
                    <h3>Gavra Rakabuming</h3>
                </div>
            </div>
            <div class="card">
                <img src="{{ asset('img/TheMaster3.jpeg') }}" alt="Aka Arkananta">
                <div class="overlay">
                    <p class="role">GROOMING SPECIALIST</p>
                    <h3>Aka Arkananta</h3>
                </div>
            </div>
            <div class="card">
                <img src="{{ asset('img/TheMaster4.jpeg') }}" alt="Lazuardi Kinasih">
                <div class="overlay">
                    <p class="role">STYLIST ELITE</p>
                    <h3>Lazuardi Kinasih</h3>
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== GALLERY ==================== --}}
    <section class="work" id="gallery">
        <div class="work-header">
            <h2>See Our Work</h2>
            <p>FOLLOW @Mr. Hartono</p>
        </div>

        <div class="work-grid">
            <img src="{{ asset('img/SeeOurWork1.jpeg') }}" alt="Our Work 1">
            <img src="{{ asset('img/SeeOurWork2.jpeg') }}" alt="Our Work 2">
            <img src="{{ asset('img/SeeOurWork3.jpeg') }}" alt="Our Work 3">
            <img src="{{ asset('img/SeeOurWork4.jpeg') }}" alt="Our Work 4">
        </div>
    </section>

    {{-- ==================== CTA ==================== --}}
    <section class="cta">
        <h1>Experience <br> Excellence</h1>
        <p>Your signature look awaits. Join the elite who trust the atelier with their identity.</p>
        <a href="#service" class="cta-btn">BOOK AN APPOINTMENT</a>
    </section>

    {{-- ==================== LOGIN/MEMBER WIDGET ==================== --}}
    <div class="log-member">
        @if(session('status') === 'sudah_login')

            @if(session('role') === 'admin')
                <a href="{{ url('/admin/dashboard') }}" class="highlight">Panel Admin</a>
            @else
                <a href="#">Halo, {{ session('nama') }}</a>
            @endif

            <p><a href="{{ url('/logout') }}" style="color: gray; text-decoration: none;">Logout</a></p>

        @else
            <a href="#" onclick="openLogin()">Log in</a>
            <p>To Member</p>
        @endif
    </div>

    {{-- ==================== LOGIN POPUP ==================== --}}
    <div class="login-popup" id="loginPopup">
        <div class="popup-box">
            <span class="close-popup" onclick="closeLogin()">✕</span>
            {{-- 
                Ganti iframe ini dengan form login langsung atau component
                kalau sudah tidak pakai halaman login.php terpisah 
            --}}
            <iframe id="popupFrame" src="{{ url('/login') }}"></iframe>
        </div>
    </div>

    {{-- ==================== FOOTER ==================== --}}
    <footer class="footer" id="contact">
        <h3>THE MODERN ATELIER</h3>

        <div class="footer-grid">
            <div>
                <p class="label">VISIT US</p>
                <p>124 Precision Blvd, Atelier District</p>
            </div>
            <div>
                <p class="label">INQUIRIES</p>
                <p>studio@mrhartono.com</p>
            </div>
            <div>
                <p class="label">DIRECT LINE</p>
                <p>+1 202 555 0192</p>
            </div>
        </div>

        <div class="footer-links">
            <a href="#">PRIVACY POLICY</a>
            <a href="#">TERMS OF SERVICE</a>
            <a href="#">CAREERS</a>
        </div>

        <p class="copyright">
            © 2025 THE MODERN ATELIER. ALL RIGHTS RESERVED.
        </p>
    </footer>

    {{-- ==================== JAVASCRIPT ==================== --}}
    <script>
        function toggleMenu(el) {
            const parent = el.parentElement;

            document.querySelectorAll('.menu-item').forEach(item => {
                if (item !== parent) {
                    item.classList.remove('active');
                }
            });

            parent.classList.toggle('active');
        }

        function openLogin() {
            document.getElementById("loginPopup").style.display = "flex";
        }

        function closeLogin() {
            document.getElementById("loginPopup").style.display = "none";
        }

        function openCreate() {
            document.getElementById("popupFrame").src = "{{ url('/register') }}";
        }

        function openLoginForm() {
            document.getElementById("popupFrame").src = "{{ url('/login') }}";
        }

        window.onclick = function(e) {
            const popup = document.getElementById("loginPopup");
            if (e.target === popup) {
                popup.style.display = "none";
            }
        }
    </script>

</body>
</html>