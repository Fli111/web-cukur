<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mr. Hartono BarberShop</title>
    <link rel="stylesheet" href="{{ asset('style1.css') }}">
    <script src="{{ asset('script.js') }}" defer></script>
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
            <li><a href="/dashboard">MEMBER</a></li>
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

                    <a href="{{ route('book', ['service' => 'The Atelier Haircut', 'price' => '65k']) }}" class="btn-gold-menu">
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

                    <a href="{{ route('book', ['service' => 'Ritual Hot Shave', 'price' => '55k']) }}" class="btn-gold-menu">
                        SERVICE ORDER
                    </a>
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

                    <a href="{{ route('book', ['service' => 'Beard Sculpting', 'price' => '45k']) }}" class="btn-gold-menu">
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

                    <a href="{{ route('book', ['service' => 'The Executive Package', 'price' => '110k']) }}" class="btn-gold-menu">
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