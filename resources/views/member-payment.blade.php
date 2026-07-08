<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/member-payment.css') }}">

    <title>Mr. Hartono - Checkout</title>
</head>
<body>
    <header>
        <p class="judul-utama">Mr. Hartono</p>
    </header>
    <div class="layar-pemisah">
        <div class="sisi-kiri">
            <div class="wadah-kiri">
                <h1 class="judul-checkout">CHECKOUT</h1>
                <p class="sub-judul">PENDAFTARAN KEANGGOTAAN</p>

                <form>
                    <div class="kepala-bagian">
                        <span class="nomor-langkah">01</span>
                        <span class="label-langkah">INFORMASI KONTAK</span>
                    </div>
                    <div class="baris-input">
                        <div class="grup-input">
                            <label>NAMA</label>
                            <input type="text" placeholder="Udin Malakawapai">
                        </div>
                    </div>
                    <div class="grup-input lebar-penuh">
                        <label>ALAMAT EMAIL</label>
                        <input type="email" placeholder="udinkampang@gmail.com">
                    </div>

                    <div class="kepala-bagian">
                        <span class="nomor-langkah">02</span>
                        <span class="label-langkah">DETAIL PEMBAYARAN</span>
                    </div>

                    <div class="bar-metode-pembayaran" id="tombol-metode">
                        <span>PILIH METODE PEMBAYARAN</span>
                        <span class="ikon-panah">></span>
                    </div>

                    <div class="wadah-metode-online" id="konten-metode">
                        <div class="opsi-pembayaran">
                            <label class="kartu-metode">
                                <input type="radio" name="metode" value="kartu">
                                <span class="nama-metode">KARTU KREDIT</span>
                            </label>
                            <label class="kartu-metode">
                                <input type="radio" name="metode" value="dana">
                                <span class="nama-metode">DANA</span>
                            </label>
                            <label class="kartu-metode">
                                <input type="radio" name="metode" value="gopay">
                                <span class="nama-metode">GOPAY</span>
                            </label>
                            <label class="kartu-metode">
                                <input type="radio" name="metode" value="ovo">
                                <span class="nama-metode">OVO</span>
                            </label>
                        </div>

                        <div id="area-input-pembayaran" style="margin-top: 20px; display: none;">
                            <div id="form-kartu" style="display: none;">
                                <div class="grup-input lebar-penuh">
                                    <label>NOMOR KARTU</label>
                                    <input type="text" placeholder="0000 0000 0000 0000">
                                </div>
                                <div class="baris-input">
                                    <div class="grup-input">
                                        <label>TANGGAL KADALUARSA</label>
                                        <input type="text" placeholder="MM/YY">
                                    </div>
                                    <div class="grup-input">
                                        <label>CVV</label>
                                        <input type="text" placeholder="000">
                                    </div>
                                </div>
                            </div>

                            <div id="form-online" style="display: none;">
                                <div class="grup-input lebar-penuh">
                                    <label id="label-nomor-hp">NOMOR TELEPON</label>
                                    <input type="text" placeholder="0812 XXXX XXXX">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="kepala-bagian" style="margin-top: 40px;">
                        <span class="nomor-langkah">03</span>
                        <span class="label-langkah">ALAMAT</span>
                    </div>
                    <div class="grup-input lebar-penuh">
                        <label>ALAMAT JALAN</label>
                        <input type="text" placeholder="Jalan Durian Runtuh RT 20/009 No.92B">
                    </div>
                    <div class="baris-input">
                        <div class="grup-input">
                            <label>KOTA</label>
                            <input type="text" placeholder="Bekasi Barat">
                        </div>
                        <div class="grup-input">
                            <label>KODE POS</label>
                            <input type="text" placeholder="17134">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="sisi-kanan">
            <div class="wadah-kanan">
                <p class="label-ringkasan">RINGKASAN PESANAN</p>
                <h2 class="tipe-member">Platinum Member</h2>
                <p class="jangka-member">KEANGGOTAAN BULANAN</p>

                <div class="detail-harga">
                    <div class="baris-harga">
                        <span>TARIF DASAR</span>
                        <span>IDR 20.000</span>
                    </div>
                    <div class="baris-harga">
                        <span>BIAYA AWAL</span>
                        <span>IDR 20.000</span>
                    </div>
                </div>

                <div class="bagian-total">
                    <p>TOTAL PEMBAYARAN</p>
                    <div class="jumlah-total">
                        IDR 20.000
                    </div>
                </div>

                <button class="tombol-selesai">SELESAIKAN PEMBELIAN</button>
            </div>
        </div>
    </div>

    <div id="modal-verifikasi" class="layar-modal">
    <div class="konten-modal">
        <h3 id="teks-pertanyaan">APAKAH SEMUA DATA SUDAH BENAR?</h3>
        <div class="grup-tombol-modal">
            <button id="tombol-ya" class="tombol-modal-hitam">YA</button>
            <button id="tombol-tidak" class="tombol-modal-putih">TIDAK</button>
        </div>
    </div>
</div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
    // === 1. LOGIKA ACCORDION & METODE PEMBAYARAN ===
    const tombolMetode = document.getElementById("tombol-metode");
    const kontenMetode = document.getElementById("konten-metode");
    const ikonPanah = tombolMetode.querySelector(".ikon-panah");
    
    // Buka/tutup daftar metode pembayaran
    tombolMetode.addEventListener("click", function() {
        kontenMetode.classList.toggle("aktif");
        ikonPanah.classList.toggle("putar");
    });

    const radioMetode = document.querySelectorAll('input[name="metode"]');
    const areaInput = document.getElementById("area-input-pembayaran");
    const formKartu = document.getElementById("form-kartu");
    const formOnline = document.getElementById("form-online");
    const labelNomorHp = document.getElementById("label-nomor-hp");

    radioMetode.forEach(radio => {
        radio.addEventListener("change", function() {
            areaInput.style.display = "block";
            
            if (this.value === "kartu") {
                formKartu.style.display = "block";
                formOnline.style.display = "none";
            } else {
                formKartu.style.display = "none";
                formOnline.style.display = "block";
                labelNomorHp.innerText = "NOMOR " + this.value.toUpperCase();
                labelNomorHp.style.color = "#555";
            }
        });
    });

    // === 2. LOGIKA POP-UP VERIFIKASI BERTINGKAT ===
    const btnSelesai = document.querySelector(".tombol-selesai");
    const modal = document.getElementById("modal-verifikasi");
    const teksPertanyaan = document.getElementById("teks-pertanyaan");
    const btnYa = document.getElementById("tombol-ya");
    const btnTidak = document.getElementById("tombol-tidak");

    let tahapVerifikasi = 1;

    // Trigger saat tombol "Selesaikan Pembelian" diklik
    btnSelesai.addEventListener("click", function(e) {
        e.preventDefault(); // Mencegah form reload otomatis
        tahapVerifikasi = 1;
        teksPertanyaan.innerText = "APAKAH SEMUA DATA SUDAH BENAR?";
        btnYa.style.display = "inline-block"; 
        btnTidak.innerText = "TIDAK";
        modal.style.display = "flex";
    });

    // Tombol TIDAK (Tutup Modal)
    btnTidak.addEventListener("click", function() {
        modal.style.display = "none";
    });

    // Tombol YA (Logika Alur Verifikasi)
    btnYa.addEventListener("click", function() {
        if (tahapVerifikasi === 1) {
            // Lanjut ke pertanyaan kedua
            teksPertanyaan.innerText = "APAKAH ANDA SUDAH YAKIN?";
            tahapVerifikasi = 2;
        } else if (tahapVerifikasi === 2) {
            // Tampilkan pesan sukses akhir
            teksPertanyaan.innerText = "PEMBAYARAN ANDA SEGERA DI PROSES";
            btnYa.style.display = "none"; // Sembunyikan tombol YA
            btnTidak.innerText = "TUTUP"; // Ganti teks tombol TIDAK jadi TUTUP
            tahapVerifikasi = 3;
        }
    });

    // Tutup modal jika user klik area gelap di luar kotak putih
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };
});
    </script>
</body>
</html> 