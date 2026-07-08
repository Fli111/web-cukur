{{-- Simpan sebagai: resources/views/history.blade.php --}}
{{-- Anda bisa menyesuaikan @extends dengan layout utama aplikasi Anda --}}
@extends('layouts.ecommercemain')
@section('title', 'Riwayat Belanja - MR. HARTONO')

@section('content')
<div class="history-container">
    <h1 class="section-title" style="text-align: left; margin-bottom: 30px;">Riwayat Belanja Saya</h1>

    @forelse($transaksis as $transaksi)
        @php
            $statusClass = '';
            switch (strtolower($transaksi->status_pesanan)) {
                case 'pending':
                    $statusClass = 'badge-pending';
                    break;
                case 'completed':
                case 'selesai':
                case 'sampai':
                    $statusClass = 'badge-completed';
                    break;
                case 'cancelled':
                case 'dibatalkan':
                    $statusClass = 'badge-cancelled';
                    break;
            }
        @endphp
        <div class="history-card">
            <div class="history-card-header">
                <div>
                    <strong>Transaksi ID:</strong> {{ $transaksi->transaksi_id }} <br>
                    <small class="text-muted">Tanggal: {{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d F Y, H:i') }}</small>
                </div>
                <div>
                    <span class="badge-status {{ $statusClass }}">{{ ucfirst($transaksi->status_pesanan) }}</span>
                </div>
            </div>
            <div class="history-card-body">
                @foreach($transaksi->detailItems as $item)
                    <div class="history-item">
                        <img src="{{ asset('uploads/' . $item->produk->gambar_produk) }}" alt="{{ $item->produk->nama_produk }}" class="history-item-img">
                        <div style="flex-grow: 1;">
                            <h6 class="my-0">{{ $item->produk->nama_produk }}</h6>
                            <small class="text-muted">{{ $item->qty }} x Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</small>
                        </div>
                        <div class="harga-produk">
                            Rp {{ number_format($item->qty * $item->harga_satuan, 0, ',', '.') }}
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="history-card-footer">
                <span>Total Pesanan: Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
            </div>
        </div>
    @empty
        <div style="text-align: center; padding: 80px 20px; background-color: #fff; border-radius: 8px;">
            <h2>Riwayat belanja Anda masih kosong.</h2>
            <p>Sepertinya Anda belum pernah melakukan transaksi. Mari kita perbaiki itu!</p>
            <button class="btn-hitam auto-width" style="margin-top:20px;" onclick="window.location.href='/ecommerceProductPage'">Mulai Belanja</button>
        </div>
    @endforelse
</div>
@endsection
