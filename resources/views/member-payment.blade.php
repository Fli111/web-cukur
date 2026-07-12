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
        {{-- SISI KIRI: Info --}}
        <div class="sisi-kiri">
            <div class="wadah-kiri">
                <h1 class="judul-checkout">CHECKOUT</h1>
                <p class="sub-judul">PENDAFTARAN KEANGGOTAAN</p>

                {{-- Info user otomatis dari session, tidak perlu diisi ulang --}}
                <div class="kepala-bagian">
                    <span class="nomor-langkah">01</span>
                    <span class="label-langkah">INFORMASI KONTAK</span>
                </div>
                <div class="baris-input">
                    <div class="grup-input">
                        <label>NAMA</label>
                        <input type="text" value="{{ Auth::user()->nama }}" readonly style="background:#f5f5f5;">
                    </div>
                </div>
                <div class="grup-input lebar-penuh">
                    <label>ALAMAT EMAIL</label>
                    <input type="email" value="{{ Auth::user()->email }}" readonly style="background:#f5f5f5;">
                </div>

                <div class="kepala-bagian" style="margin-top: 30px;">
                    <span class="nomor-langkah">02</span>
                    <span class="label-langkah">PEMBAYARAN</span>
                </div>
                <p style="color:#666; font-size:14px; margin-top:10px;">
                    Pembayaran dilakukan melalui <strong>Midtrans</strong>. 
                    Klik tombol <em>"Selesaikan Pembelian"</em> untuk memilih metode pembayaran.
                </p>
            </div>
        </div>

        {{-- SISI KANAN: Ringkasan --}}
        <div class="sisi-kanan">
            <div class="wadah-kanan">
                <p class="label-ringkasan">RINGKASAN PESANAN</p>

                <h2 class="tipe-member">{{ strtoupper($paket) }} Member</h2>
                <p class="jangka-member">KEANGGOTAAN BULANAN</p>

                <div class="detail-harga">
                    <div class="baris-harga">
                        <span>TARIF PAKET</span>
                        <span>IDR {{ number_format($harga, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="bagian-total">
                    <p>TOTAL PEMBAYARAN</p>
                    <div class="jumlah-total">
                        IDR {{ number_format($harga, 0, ',', '.') }}
                    </div>
                </div>

                {{-- Flash message error --}}
                @if(session('error'))
                    <div style="color:red; margin-bottom:10px;">{{ session('error') }}</div>
                @endif

                {{-- Tombol trigger Midtrans Snap --}}
                <button id="btn-bayar" class="tombol-selesai">SELESAIKAN PEMBELIAN</button>
            </div>
        </div>
    </div>

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
            // Buka popup Midtrans Snap
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    // Pembayaran berhasil — redirect ke halaman finish
                    window.location.href = "{{ route('member.finish') }}?order_id=" + result.order_id + "&transaction_status=" + result.transaction_status;
                },
                onPending: function(result) {
                    window.location.href = "{{ route('member.finish') }}?order_id=" + result.order_id + "&transaction_status=pending";
                },
                onError: function(result) {
                    alert('Pembayaran gagal. Silakan coba lagi.');
                },
                onClose: function() {
                    // User menutup popup tanpa bayar — tidak redirect
                    console.log('Popup Midtrans ditutup.');
                }
            });
        });
    </script>
</body>
</html>