@extends('layouts.ecommercemain')
@section('title', $data->nama_produk . ' - MR. HARTONO')

@section('content')
<div class="container">
    <div class="product-detail-wrapper">
        
        <!-- Kolom Kiri: Gambar Produk -->
        <div class="product-gallery">
            <div class="main-image-container">
                <img src="{{ asset('uploads/' . $data->gambar_produk) }}" class="main-img" alt="{{ $data->nama_produk }}">
            </div>
        </div>
        
        <!-- Kolom Kanan: Detail Informasi -->
        <div class="product-info">
            <div>
                <div class="info-subtitle">{{ $data->kategori }}</div>
                <h1 class="info-title">{{ $data->nama_produk }}</h1>
                <div class="info-price">IDR {{ number_format($data->harga, 0, ',', '.') }}</div>
                
                <div class="info-desc">
                    <strong>Deskripsi Produk:</strong><br>
                    {!! nl2br(e($data->deskripsi_produk)) !!}
                </div>
                <br>
                <div class="info-desc">
                    Stok Tersedia: <strong>{{ $data->stok }} Pcs</strong>
                </div>
            </div>

            <!-- Form Add to Cart -->
            <form action="/cart/add/{{ $data->barang_id }}" method="POST">
                @csrf
                <div class="action-group">
                    <div>
                        <label style="display:block; font-size:12px; font-weight:bold; margin-bottom:5px;">QTY</label>
                        <input type="number" name="qty" class="form-input" value="1" min="1" max="{{ $data->stok }}" style="width: 80px; text-align:center;">
                    </div>
                    <button type="submit" class="btn-hitam" style="margin-top: 20px;">ADD TO CART</button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection