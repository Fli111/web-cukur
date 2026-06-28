@extends('layouts.main')
@section('title', 'Shop All - MR. HARTONO')

@section('content')
<div class="container">
    
    <!-- Title Section -->
    <div class="title-wrapper" style="display: flex; justify-content: flex-end; gap: 30px; margin-bottom: 40px;">
        <h1 class="page-title" style="margin: 0; text-align: right; white-space: nowrap;">OUR COLLECTIONS</h1>
        <p class="title-desc" style="margin: 0; text-align: left; max-width: 600px;">
            Tiga langkah praktis untuk perawatan rambut esensial. Membersihkan, menutrisi, dan menata rambut secara optimal untuk menunjang aktivitas harian.
        </p>
    </div>

    <!-- Kategori: Hair Powder -->
    <h2 class="section-title">HAIR POWDER</h2>
    <div class="scroll-wrapper">
        @foreach($powder as $barang)
        <a href="/productdetail/{{ $barang->barang_id }}" class="produk-card">
            <img src="{{ asset('uploads/' . $barang->gambar_produk) }}" class="img-produk" alt="{{ $barang->nama_produk }}">
            <div class="nama-produk">{{ $barang->nama_produk }}</div>
            <div class="harga-produk">IDR {{ number_format($barang->harga, 0, ',', '.') }}</div>
        </a>
        @endforeach
    </div>

    <!-- Kategori: Shampoo -->
    <h2 class="section-title">SHAMPOO</h2>
    <div class="scroll-wrapper">
        @foreach($shampoo as $barang)
        <a href="/productdetail/{{ $barang->barang_id }}" class="produk-card">
            <img src="{{ asset('uploads/' . $barang->gambar_produk) }}" class="img-produk" alt="{{ $barang->nama_produk }}">
            <div class="nama-produk">{{ $barang->nama_produk }}</div>
            <div class="harga-produk">IDR {{ number_format($barang->harga, 0, ',', '.') }}</div>
        </a>
        @endforeach
    </div>

</div>

<script>
    // Fitur Live Search 
    const searchInput = document.querySelector('.search-input');
    const produkCards = document.querySelectorAll('.produk-card');

    searchInput.addEventListener('input', function() {
        const keyword = this.value.toLowerCase(); 
        produkCards.forEach(function(card) {
            const namaProduk = card.querySelector('.nama-produk').innerText.toLowerCase();
            if (namaProduk.includes(keyword)) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    });
</script>
@endsection