<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mr. Hartono BarberShop</title>
    <link rel="stylesheet" href="{{ asset('style1.css') }}">
</head>
<body>
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
            <li><a href="/ecommerceHomePage">SHOP</a></li>
            <li><a href="/pilih-member">MEMBER</a></li>
        </ul>

        <div class="btn">
            <a href="#service">BOOK APPOINMENT</a>
        </div>
    </nav>
    </section>
    
    <section class="hero">
        <div class="hero-overlay">
            <p class="est">ESTABLISHED 2020</p>
            <h1>MR. <br>HARTONO</h1>
            <p class="desc">
                Redefining the modern grooming experience throught surgical precision
                heritage techniques, and uncompromising eye for detail.
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

    <section class="heros" id="about">
        <div class="container">
            <div class="left">
            <img src="{{ asset('img/NetWork.jpeg') }}" alt="">
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

    <section class="mission">
        <div class="mission-header">
            <p>THE CORE VALUES</p>
            <h2>Our mission</h2>
        </div>
        <div class="mission-container">
            <div class="mission-card">
                <div class="icon">✂️</div>
                <h3>Precision Engineering</h3>
                <p>
                    we view hair throught a structural lens, ensuring every cut grows 
                    out perfectly and maintains its shape for week.
                </p>
            </div>
            <div class="mission-card">
                <div class="icon">🪒</div>
                <h3>Preserving Ritual</h3>
                <p>
                    From hot towels to traditional lather, we honor the meticulous
                    ritual that have defined the gentlement's barbershop for centuries.
                </p>
            </div>
            <div class="mission-card">
                <div class="icon">📐</div>
                <h3>Tailored identity</h3>
                <p>
                    No templates. No generic style. we consult deeply to understand
                    your face shape, lifestyle, and unique aesthetic goals.
                </p>
            </div>
        </div>
    </section>

    <section class="menu" id="service">
        <div class="menu-header">
            <h2>THE MENU</h2>
            <p>
                curated grooming packages designed for the modern lifestyle.
                click an time view full details and ritual components.
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

                    <a href="{{ route('book', ['service_id' => 1, 'service' => 'The Atelier Haircut', 'price' => '65k']) }}" class="btn-gold-menu">
                        SERVICE ORDER
                    </a>
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

                    <a href="{{ route('book', ['service_id' => 2, 'service' => 'Ritual Hot Shave', 'price' => '55k']) }}" class="btn-gold-menu">
                        SERVICE ORDER
                    </a>>
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

                    <a href="{{ route('book', ['service_id' => 3, 'service' => 'Beard Sculpting', 'price' => '45k']) }}" class="btn-gold-menu">
                        SERVICE ORDER
                    </a>
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

                    <a href="{{ route('book', ['service_id' => 4, 'service' => 'The Executive Package', 'price' => '110k']) }}" class="btn-gold-menu">
                        SERVICE ORDER
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="team" id="team">
        <h2>The Master Barbers</h2>

        <div class="team-grid">
            <div class="card">
                <img src="{{ asset('img/TheMaster1.jpeg') }}">
                <div class="overlay">
                    <p class="role">CREATIVE DIRECTOR</p>
                    <h3>Aksa Mahardika</h3>
                </div>
            </div>

            <div class="card">
                <img src="{{ asset('img/TheMaster2.jpeg') }}">
                <div class="overlay">
                    <p class="role">LEAD ARTISAN</p>
                    <h3>Gavra Rakabuming</h3>
                </div>
            </div>

            <div class="card">
                <img src="{{ asset('img/TheMaster3.jpeg') }}">
                <div class="overlay">
                    <p class="role">GROOMING SPECIALIST</p>
                    <h3>Aka Arkananta</h3>
                </div>
            </div>

            <div class="card">
                <img src="{{ asset('img/TheMaster4.jpeg') }}">
                <div class="overlay">
                    <p class="role">STYLIST ELITE</p>
                    <h3>Lazuardi Kinasih</h3>
                </div>
            </div>
        </div>
    </section>

    <section class="work" id="gallery">
        <div class="work-header">
            <h2>See Our Work</h2>
            <p>FOLLOW @Mr. Hartomo</p>
        </div>

        <div class="work-grid">
            <img src="{{ asset('img/SeeOurWork1.jpeg') }}">
            <img src="{{ asset('img/SeeOurWork2.jpeg') }}">
            <img src="{{ asset('img/SeeOurWork3.jpeg') }}">
            <img src="{{ asset('img/SeeOurWork4.jpeg') }}">
        </div>
    </section>

    <section class="cta">
        <h1>Experience <br> Excellence</h1>
        <p>Your signature look awaits. Join the elite who trust the atelier with their identity.</p>

        <a href="#service" class="cta-btn">BOOK AN APPOINTMENT</a>
    </section>

    <div class="log-member">
        <a href="#" onclick="openLogin()">Log in</a>
        <p>To Member</p>
    </div>

    <div class="login-popup" id="loginPopup">

    <div class="popup-box">

        <span class="close-popup" onclick="closeLogin()">✕</span>

        <iframe id="popupFrame" src="{{ route('login') }}"></iframe>

    </div>

    </div>

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
<footer class="footer-container-team">
        <div class="footer-grid-team">
            
            <!-- Kolom 1: Brand & Tim -->
            <div class="col-1-team">
                <h1 class="brand-title-team">Hartono Barbershop</h1>
                <p class="brand-desc-team">
                    Where heritage craftsmanship meets academic excellence. A signature identity for the modern individual.
                </p>

                <h2 class="section-subtitle-team">The Creative Team</h2>
                <ul class="team-list-team">
                    <li><span class="team-name-team">Raihan Reditya</span> <span class="team-separator-team">&mdash;</span> 20240801096</li>
                    <li><span class="team-name-team">Rafli Gilang Pasha</span> <span class="team-separator-team">&mdash;</span> 20240801184</li>
                    <li><span class="team-name-team">Ahmad Rifki Pramadhika</span> <span class="team-separator-team">&mdash;</span> 20240801190</li>
                </ul>
            </div>

            <!-- Kolom 2: Info Akademik & Sosial Media -->
            <div class="col-2-team">
                <h2 class="section-subtitle-team">Academic Context</h2>
                
                <div class="academic-section-team">
                    <p class="academic-label-team">Dosen Pengampu MK</p>
                    <p class="academic-value-team">Dewi Setiowati, A.Md., S.Pd., M.Tr.Kom.</p>
                </div>

                <div class="academic-row-team">
                    <div class="academic-section-team">
                        <p class="academic-label-team">Kelas</p>
                        <p class="academic-value-team">KH001</p>
                    </div>
                    <div class="academic-section-team">
                        <p class="academic-label-team">Tahun Akademik</p>
                        <p class="academic-value-team">2025/2026 Genap</p>
                    </div>
                </div>

                <div class="social-links-team">
                    <!-- Icon Dribbble / Web -->
                    <a href="#" class="social-btn-team" aria-label="Website">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M8.56 2.75c4.37 6.03 6.02 9.42 8.03 17.72m2.54-15.38c-3.72 4.35-8.94 5.66-16.88 5.85m19.5 1.9c-3.5-.93-6.63-.82-8.94 0-2.58.92-5.01 2.86-7.44 6.32"></path>
                        </svg>
                    </a>
                    <!-- Icon Globe -->
                    <a href="#" class="social-btn-team" aria-label="Globe">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="2" y1="12" x2="22" y2="12"></line>
                            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                        </svg>
                    </a>
                    <!-- Icon Mail -->
                    <a href="#" class="social-btn-team" aria-label="Email">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Kolom 3: Menu Atelier -->
            <div class="col-3-team">
                <h2 class="section-subtitle-team">Atelier</h2>
                <ul class="nav-links-team">
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Gallery</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>

        </div>
    </footer>
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

    function openLogin(){
        document.getElementById("loginPopup").style.display = "flex";
    }

    function closeLogin(){
        document.getElementById("loginPopup").style.display = "none";
    }

    function openCreate(){
        // Mengubah path menggunakan route Laravel untuk JS
        document.getElementById("popupFrame").src = "{{ route('create') }}";
    }

    function openLoginForm(){
        // Mengubah path menggunakan route Laravel untuk JS
        document.getElementById("popupFrame").src = "{{ route('login') }}";
    }

    window.onclick = function(e){
        const popup = document.getElementById("loginPopup");

        if(e.target === popup){
            popup.style.display = "none";
        }
    }
</script>
</body>
</html>