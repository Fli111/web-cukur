<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('/pilmember.css') }}">
    <title>Membership Mr. Hartono</title>
</head>
<body>
    
    <div class="pil">
        <p class="judul">Mr. Hartono</p>
        <nav>
            <a href="{{ route('home') }}">HOME</a>
            <a href="#">BOOK</a>
            <a href="#">PRODUCT</a>
            <a class="navi" href="">MEMBER</a>
        </nav>
    </div> 

    <div class="gambar">
        <div class="tulisan">MR. HARTONO<br>MEMBERSHIP</div>
    </div>

    <div class="member">
        <div class="member-gold">
            <h2>Member <br> Gold</h2>
            <h3>Potongan Cukur 10%<br>Potongan Produk 10%<br></h3>
            <a href="{{ route('payment', ['paket' => 'gold']) }}" onclick="return cekLogin(event)">
                <button class="tombol">JOIN <br> IDR 20K / bln</button>
            </a>
        </div>

        <div class="member-platinum">
            <h2>Member Platinum</h2>
            <h3>Potongan Cukur 20%<br>Potongan Produk 15%<br></h3>
            <a href="{{ url('/payment?paket=platinum') }}" onclick="return cekLogin(event)">
                <button class="tombol">JOIN <br> IDR 25K / bln</button>
            </a>
        </div>

        <div class="member-diamond">
            <h2>Member <br> Diamond</h2>
            <h3>Potongan Cukur 25%<br>Potongan Produk 20%<br></h3>
            <a href="{{ url('/payment?paket=diamond') }}" onclick="return cekLogin(event)">
                <button class="tombol">JOIN <br> IDR 30K / bln</button>
            </a>
        </div>
    </div>

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
</script>
</body>
</html>