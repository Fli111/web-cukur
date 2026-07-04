@extends('layouts.ecommercemain')
@section('title', 'MR.HARTONO BARBERSHOP - HOME')

@section('content')

    <div class="hero-banner">
        <div class="hero-text">
            <div class="hero-title">Best+ Powder</div>
            <div class="hero-desc">
                Tingkatkan volume dan tekstur rambut seketika. Hair powder bertekstur ringan dengan hasil akhir matte (tidak mengkilap). Bikin rambut anti-lepek, tahan lama, dan mudah ditata ulang kapan saja pakai tangan.
            </div>
            <button class="btn-hitam auto-width" onclick="window.location.href='/ecommerceProductPage'">SHOP NOW</button>
        </div>
        <img src="{{ asset('uploads/bestplusPowder.jpg') }}" class="hero-img" alt="Best Plus Powder">
    </div>

    <div class="container">
        <div class="grid-wrapper">
            
            @foreach($produk as $barang)
            <div class="produk-card" onclick="window.location.href='/ecommerceProductDetail/{{ $barang->barang_id }}'">
                <img src="{{ asset('uploads/' . $barang->gambar_produk) }}" class="img-produk" alt="{{ $barang->nama_produk }}">
                <div class="nama-produk">{{ $barang->nama_produk }}</div>
                <div class="harga-produk">IDR {{ number_format($barang->harga, 0, ',', '.') }}</div>
            </div>
            @endforeach

        </div>
    </div>

@endsection