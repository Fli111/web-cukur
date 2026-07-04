@extends('layouts.ecommercemain')
@section('title', 'Checkout Keranjang - MR. HARTONO')

@section('content')
<div class="container-cart-page">
    
    <h1 class="section-title">Shopping Cart & Checkout</h1>

    @if(session('success'))
        <div style="background-color: #e6f4ea; color: #1e8e3e; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div style="background-color: #fce8e6; color: #d93025; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('error') }}
        </div>
    @endif

    @if(count($cart) > 0)
        <div class="grid-belah-dua">
            
            <!-- Kolom Kiri: Daftar Cart -->
            <div class="cart-list">
                @foreach($cart as $item)
                <div class="cart-item">
                    <div class="cart-info">
                        <img src="{{ asset('uploads/' . $item['gambar_produk']) }}" class="img-keranjang" alt="{{ $item['nama_produk'] }}">
                        <div>
                            <div class="nama-produk">{{ $item['nama_produk'] }}</div>
                            <div class="harga-produk" style="margin-top: 10px; font-weight:normal;">
                                IDR {{ number_format($item['harga'], 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                    
                    <div style="text-align: center;">
                        <span style="font-size: 12px; font-weight:bold; display:block; margin-bottom:5px;">QTY</span>
                        <input type="text" class="input-qty" value="{{ $item['jumlah'] }}" readonly>
                    </div>

                    <div class="harga-produk" style="font-size: 18px;">
                        IDR {{ number_format($item['harga'] * $item['jumlah'], 0, ',', '.') }}
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Kolom Kanan: Summary & Form Checkout -->
            <div class="summary-card">
                <h2 style="margin-top:0; font-size: 22px;">Informasi Pengiriman</h2>
                <hr style="border: 0; border-bottom: 1px solid #ddd; margin: 20px 0;">
                
                <form action="/checkout" method="POST" onsubmit="return cekAlamat()">
                    @csrf
                    
                    <div class="form-group">
                        <label>Alamat Pengiriman</label>
                        <textarea id="address" name="alamat_pengiriman" rows="3" class="form-input" placeholder="Tulis alamat lengkap rumah lu..." required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Metode Pembayaran</label>
                        <select name="metode_pembayaran" class="form-input">
                            <option value="BCA" selected>Transfer Bank BCA</option>
                            <option value="BNI">Transfer Bank BNI</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Opsi Pengiriman</label>
                        <div class="radio-group">
                            <label><input type="radio" name="opsi_pengiriman" value="Fast" checked required> Fast Delivery</label>
                            <label><input type="radio" name="opsi_pengiriman" value="Regular"> Regular</label>
                        </div>
                    </div>

                    <input type="hidden" name="total_harga" value="{{ $total }}">

                    <div style="display:flex; justify-content:space-between; align-items:center; margin: 30px 0 20px 0;">
                        <span style="font-weight:bold; color:#666;">Total Pembayaran:</span>
                        <span class="harga-produk" style="font-size: 24px; color:#000;">IDR {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <button type="submit" class="btn-hitam">PROCESS CHECKOUT</button>
                </form>
            </div>

        </div>
    @else
        <div style="text-align: center; padding: 100px 0;">
            <h2>Keranjang belanja kamu masih kosong cuy.</h2>
            <button class="btn-hitam auto-width" style="margin-top:20px;" onclick="window.location.href='/ecommerceProductPage'">Lihat Produk</button>
        </div>
    @endif
</div>

<script>
    function cekAlamat() {
        const alamat = document.getElementById('address').value.trim();
        if(alamat === "") {
            alert("Waduh! alamat pengiriman belum diisi.");
            document.getElementById('address').focus();
            return false;
        }
        return true;
    }
</script>
@endsection