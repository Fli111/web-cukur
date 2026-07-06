<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/dashboard.css') }}">
    <title>Dashboard - Mr. Hartono</title>
</head>
<body>
    <div class="wadah-dashboard">
        <aside class="sidebar">
            <h2 class="logo">MR. HARTONO</h2>
            <nav class="menu-nav">
                <a href="#" class="menu-item aktif" onclick="pindahTab(event, 'beranda')">Beranda</a>
                <a href="#" class="menu-item" onclick="pindahTab(event, 'profil')">Profil Saya</a>
                <a href="#" class="menu-item" onclick="pindahTab(event, 'riwayat')">Riwayat Pembelian</a>
                <a href="#" class="menu-item menu-keluar" onclick="tampilModalLogout(event)">Keluar</a>
            </nav>
        </aside>

        <main class="konten-utama">
            
            <section id="beranda" class="seksi-konten aktif">
                <header>
                    <h1>Halo, <span id="nama-user">Pelanggan</span>!</h1>
                    <p>Selamat datang kembali di barbershop eksklusif kami.</p>
                </header>

                <div class="grid-beranda">
                    <div class="kartu-status">
                        <div class="kartu-member-aktif" id="warna-paket">
                            <p>Status Membership</p>
                            <h2 id="status-paket">Platinum</h2>
                            <p class="tgl-kadaluarsa">Berlaku hingga: 10 Juni 2026</p>
                        </div>

                        <div class="info-benefit">
                            <h3>Keuntungan Kamu:</h3>
                            <ul id="daftar-benefit">
                                <li>Potongan harga standar 20%</li>
                                <li>Potongan produk 15%</li>
                                <li>Update promo eksklusif via email</li>
                            </ul>
                        </div>
                    </div>

                    <div class="qr-section">
                        <h3>QR Code Member</h3>
                        <p>Tunjukkan QR ini ke kasir saat melakukan transaksi untuk identifikasi member otomatis</p>
                        <div class="qr-box">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=MemberHartono123" alt="QR Code">
                        </div>
                        <span class="id-member">ID: MH-2026-009A</span>
                    </div>
                </div>
            </section>

            <section id="profil" class="seksi-konten">
                <header>
                    <h1>Profil Saya</h1>
                    <p>Detail data keanggotaan dan akun kamu di Mr. Hartono Barbershop.</p>
                </header>

                <div class="kartu-profil">
                    <div class="avatar-profil">
                        <div class="foto-placeholder">MH</div>
                    </div>
                    <div class="detail-data">
                        <div class="grup-info">
                            <label>Nama Lengkap</label>
                            <p class="nilai-info">Rian Hartono</p>
                        </div>
                        <div class="grup-info">
                            <label>Email Resmi</label>
                            <p class="nilai-info">rian.hartono@gmail.com</p>
                        </div>
                        <div class="grup-info">
                            <label>Tingkat Membership</label>
                            <p class="nilai-info badge-platinum">Member Platinum</p>
                        </div>
                        <div class="grup-info-tanggal">
                            <div class="tgl-item">
                                <label>Tanggal Pembelian</label>
                                <p class="nilai-tgl">10 Mei 2026</p>
                            </div>
                            <div class="tgl-item">
                                <label>Tanggal Habis / Kadaluarsa</label>
                                <p class="nilai-tgl teks-merah">10 Juni 2026</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="riwayat" class="seksi-konten">
                <header>
                    <h1>Riwayat Pembelian</h1>
                    <p>Daftar riwayat pembelian produk, treatment, dan paket yang sudah kamu selesaikan.</p>
                </header>

                <div class="tabel-responsif">
                    <table class="tabel-riwayat">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang / Layanan</th>
                                <th>Harga</th>
                                <th>Tanggal Beli</th>
                                <th>Tanggal Sampai / Selesai</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><strong>Premium Pomade (Strong Hold)</strong></td>
                                <td>IDR 120.000</td>
                                <td>12 Mei 2026</td>
                                <td>15 Mei 2026</td>
                                <td><span class="status-selesai">Sampai</span></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><strong>Hair Tonic Anti-Dandruff</strong></td>
                                <td>IDR 85.000</td>
                                <td>20 Mei 2026</td>
                                <td>23 Mei 2026</td>
                                <td><span class="status-selesai">Sampai</span></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td><strong>Haircut & Shaving Service (Platinum Treatment)</strong></td>
                                <td>IDR 50.000</td>
                                <td>01 Juni 2026</td>
                                <td>01 Juni 2026</td>
                                <td><span class="status-selesai">Selesai</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

        </main>
    </div>

    <div id="modalLogout" class="modal-bg">
        <div class="konten-modal">
            <h2>Yakin ingin keluar?</h2>
            <p>Sesi Anda akan diakhiri dan Anda harus login kembali untuk masuk ke dashboard.</p>
            <div class="grup-tombol">
                <button onclick="tutupModalLogout()" class="tombol-batal">Batal</button>
                <button onclick="konfirmasiLogout()" class="tombol-yakin">Ya, Keluar</button>
            </div>
        </div>
    </div>

    <script>
        // Fungsi Pindah Tab Navigasi
function pindahTab(event, idSeksi) {
    // 1. Mencegah reload halaman bawaan tag <a href="#">
    event.preventDefault();

    // 2. Ambil semua elemen seksi konten dan sembunyikan semuanya
    const semuaSeksi = document.querySelectorAll('.seksi-konten');
    semuaSeksi.forEach(seksi => {
        seksi.classList.remove('aktif');
    });

    // 3. Ambil semua tombol menu navigasi di sidebar dan hapus class 'aktif'
    const semuaMenu = document.querySelectorAll('.menu-item');
    semuaMenu.forEach(menu => {
        menu.classList.remove('aktif');
    });

    // 4. Munculkan seksi yang sedang dipilih
    document.getElementById(idSeksi).classList.add('aktif');

    // 5. Tambahkan efek class 'aktif' ke menu sidebar yang baru diklik
    event.currentTarget.classList.add('aktif');
}

// Fungsi Memunculkan Pop-up Logout
function tampilModalLogout(event) {
    event.preventDefault(); 
    document.getElementById('modalLogout').style.display = 'flex';
}

// Fungsi Menutup Pop-up (Jika pilih Batal)
function tutupModalLogout() {
    document.getElementById('modalLogout').style.display = 'none';
}

// Fungsi Eksekusi Pindah Halaman (Jika pilih Ya, Keluar)
function konfirmasiLogout() {
    // Arahkan kembali ke halaman pilih member / halaman utama
    window.location.href = "../pilih member/pilih-member.html";
}
    </script>
</body>
</html>