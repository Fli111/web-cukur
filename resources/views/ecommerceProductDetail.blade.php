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
            </div>

            @if ($data->stok > 0)
                <div class="info-desc">
                    Stok Tersedia: <strong>{{ $data->stok }} Pcs</strong>
                </div>
                <!-- Form Add to Cart -->
                <form id="addToCartForm" action="/cart/add/{{ $data->barang_id }}" method="POST">
                    @csrf
                    <div class="action-group">
                        <div>
                            <label style="display:block; font-size:12px; font-weight:bold; margin-bottom:5px;">QTY</label>
                            <input type="number" name="qty" class="form-input" value="1" min="1" max="{{ $data->stok }}" style="width: 80px; text-align:center;">
                        </div>
                        <button type="submit" class="btn-hitam" style="margin-top: 20px;">ADD TO CART</button>
                    </div>
                </form>
            @else
                <div class="info-desc">Stok: <strong style="color: #dc3545;">Habis</strong></div>
                <div class="action-group">
                    <button type="button" class="btn-hitam" disabled style="margin-top: 20px; background-color: #6c757d; cursor: not-allowed;">STOK HABIS</button>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const addToCartForm = document.getElementById('addToCartForm');
    if (addToCartForm) {
        addToCartForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah reload halaman

            const form = event.target;
            const formData = new FormData(form);
            const url = form.action;
            const button = form.querySelector('button[type="submit"]');
            const originalButtonText = button.innerHTML;
            button.disabled = true;
            button.innerHTML = 'MENAMBAHKAN...';

            fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json', // Memberitahu Laravel kita mau response JSON
                }
            })
            .then(response => response.json().then(data => ({ status: response.status, body: data })))
            .then(({ status, body }) => {
                // Tampilkan notifikasi dari server, sukses atau gagal
                showAjaxNotification(body.message, status < 400);

                if (status >= 400 && body.redirect) {
                    // Jika ada error dan server menyarankan redirect (misal: ke halaman login)
                    setTimeout(() => { window.location.href = body.redirect; }, 2000);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAjaxNotification('Terjadi kesalahan. Silakan coba lagi.', false);
            })
            .finally(() => {
                button.disabled = false;
                button.innerHTML = originalButtonText;
            });
        });
    }
});
</script>
@endpush