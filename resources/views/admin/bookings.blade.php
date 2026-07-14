@extends('layouts.admin')

@section('title', 'Jadwal Booking')
@section('page-title', 'Jadwal Booking Masuk')
@section('page-subtitle', 'Live Dashboard — Administrator')

@section('extra-css')
/* Table Grid Booking */
.table-header-grid, .table-row-grid {
    display: grid;
    grid-template-columns: 0.8fr 1.5fr 1.5fr 1fr 1.2fr 1.2fr 1fr 1fr;
    padding: 20px 30px;
    gap: 15px;
    align-items: center;
}
.table-header-grid {
    border-bottom: 1px solid var(--border-color);
    background-color: rgba(255,255,255,0.01);
}
.table-header-grid div {
    color: var(--text-secondary);
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 1.5px;
    text-transform: uppercase;
}
.table-row-grid {
    border-bottom: 1px solid var(--border-color);
    font-size: 13px;
    color: #e0e0e0;
    transition: background 0.2s ease;
}
.table-row-grid:hover { background-color: var(--bg-hover); }
.table-row-grid .booking-id {
    color: var(--accent-gold);
    font-weight: 600;
}

/* Badge status booking */
.badge {
    padding: 5px 12px;
    border-radius: 4px;
    font-size: 10px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: inline-block;
}
.badge.pending   { background: rgba(245,158,11,0.1); color: #f59e0b; border: 1px solid rgba(245,158,11,0.2); }
.badge.confirmed { background: rgba(59,130,246,0.1); color: #3b82f6; border: 1px solid rgba(59,130,246,0.2); }
.badge.done      { background: rgba(16,185,129,0.1); color: #10b981; border: 1px solid rgba(16,185,129,0.2); }
.badge.cancelled { background: rgba(239,68,68,0.1);  color: #ef4444; border: 1px solid rgba(239,68,68,0.2); }

/* Empty State */
.empty-state-container {
    position: relative;
    height: 380px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    overflow: hidden;
    border-bottom: 1px solid var(--border-color);
}
.empty-state-container::before {
    content: '';
    position: absolute;
    top: 50%; left: 50%;
    transform: translate(-50%, -50%);
    width: 600px; height: 600px;
    background: radial-gradient(circle, var(--accent-glow) 0%, transparent 65%);
    z-index: 1;
    pointer-events: none;
}
.empty-content { position: relative; z-index: 2; }
.empty-icon {
    width: 60px; height: 60px;
    background-color: var(--bg-hover);
    border: 1px solid #333;
    transform: rotate(45deg);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 25px;
}
.empty-icon i { transform: rotate(-45deg); font-size: 24px; color: var(--accent-gold); }
.empty-content h4 {
    font-family: var(--font-serif);
    font-size: 24px;
    font-style: italic;
    margin-bottom: 10px;
}
.empty-content p {
    color: var(--text-muted);
    font-size: 11px;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 25px;
}
.btn-reload {
    background-color: transparent;
    border: 1px solid var(--accent-gold);
    color: var(--accent-gold);
    padding: 12px 30px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 1px;
    text-transform: uppercase;
    transition: 0.3s;
    cursor: pointer;
}
.btn-reload:hover { background-color: var(--accent-gold); color: #000; }

/* Bottom Widgets */
.bottom-widgets {
    display: grid;
    grid-template-columns: 1fr 1.5fr;
    gap: 20px;
    margin-top: 30px;
}
.widget-card {
    background-color: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 4px;
    padding: 30px;
    position: relative;
    overflow: hidden;
}
.widget-label {
    color: var(--text-muted);
    font-size: 10px;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    margin-bottom: 20px;
    font-weight: 700;
}
.insight-widget h4 {
    font-size: 18px;
    line-height: 1.5;
    font-weight: 500;
    max-width: 80%;
}
.insight-icon {
    position: absolute;
    top: 30px; right: 30px;
    color: var(--text-muted);
    font-size: 24px;
}
.insight-progress {
    margin-top: 30px;
    height: 4px;
    width: 100px;
    background-color: var(--border-color);
}
.insight-progress-bar {
    height: 100%;
    width: 35%;
    background-color: var(--accent-gold);
}
.quote-widget {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.quote-content { flex: 1; padding-right: 30px; }
.quote-content .widget-label { color: var(--accent-gold); }
.quote-content h3 {
    font-family: var(--font-serif);
    font-size: 21px;
    font-style: italic;
    line-height: 1.4;
    color: #d1d1d1;
}
.quote-image {
    width: 120px; height: 120px;
    background-image: url('https://images.unsplash.com/photo-1503951914875-452162b0f3f1?auto=format&fit=crop&w=300&q=80');
    background-size: cover;
    background-position: center;
    border-radius: 4px;
    filter: grayscale(100%) contrast(1.2);
    opacity: 0.7;
}

/* Responsive */
@media (max-width: 1100px) {
    .table-header-grid, .table-row-grid {
        /* Menampilkan: ID, Nama, Tanggal, Jam, Status */
        grid-template-columns: 0.8fr 1.5fr 1.2fr 1fr 1fr;
    }
    /* Menyembunyikan kolom ke-3 (Layanan), ke-4 (Harga), dan ke-5 (Barber) */
    .table-header-grid div:nth-child(3),
    .table-row-grid div:nth-child(3),
    .table-header-grid div:nth-child(4),
    .table-row-grid div:nth-child(4),
    .table-header-grid div:nth-child(5),
    .table-row-grid div:nth-child(5) {
        display: none;
    }
}
@media (max-width: 850px) {
    .bottom-widgets { grid-template-columns: 1fr; }
}
@endsection

@section('content')

{{-- Main Booking Table --}}
<section class="dashboard-card">

    <div class="card-header">
        <div class="card-title">
            <p>Inventory Log</p>
            <h3>Overview Antrean</h3>
        </div>
        <div class="card-actions">
            <button class="btn-outline">
                <i class="ph ph-faders"></i> Filter
            </button>
        </div>
    </div>

    {{-- Table Header --}}
    <div class="table-header-grid">
        <div>ID Booking</div>
        <div>Nama Pelanggan</div>
        <div>Layanan (Service)</div>
        <div>Harga</div> <div>Artisan (Barber)</div>
        <div>Tanggal</div>
        <div>Waktu / Jam</div>
        <div>Status</div>
    </div>

    {{-- Table Rows --}}
    @forelse($bookings as $booking)
        <div class="table-row-grid">
            <div class="booking-id">#{{ $booking->book_id }}</div>
            <div>{{ optional($booking->user)->nama ?? 'Tamu/User Dihapus' }}</div>
            <div>{{ optional($booking->service)->nama_service ?? 'Layanan Tidak Diketahui' }}</div>
            
            <div>Rp {{ number_format(optional($booking->service)->harga ?? 0, 0, ',', '.') }}</div>
            
            <div>{{ optional($booking->barber)->nama ?? 'Belum Pilih Barber' }}</div>
            <div>{{ \Carbon\Carbon::parse($booking->tanggal)->format('d M Y') }}</div>
            <div>{{ \Carbon\Carbon::parse($booking->waktu)->format('H:i') }} WIB</div>
            <div>
                <span class="badge {{ strtolower($booking->status) }}">
                    {{ $booking->status }}
                </span>
            </div>
        </div>
    @empty
        <div class="empty-state-container">
            <div class="empty-content">
                <div class="empty-icon">
                    <i class="ph ph-calendar-x"></i>
                </div>
                <h4>Belum ada jadwal booking yang masuk.</h4>
                <p>Semua data antrean baru akan muncul di sini secara otomatis.</p>
                <button onclick="window.location.reload();" class="btn-reload">
                    Muat Ulang Dashboard
                </button>
            </div>
        </div>
    @endforelse

    <div class="card-footer">
        <div class="footer-stats">
            <div class="stat-item">
                <p>Total Bookings</p>
                <h5>{{ $bookings->count() }}</h5>
            </div>
            <div class="stat-item">
                <p>Revenue Forecast</p>
                <h5 class="gold">IDR {{ number_format($bookings->count() * 65000, 0, ',', '.') }}</h5>
            </div>
        </div>
        <div class="footer-entries">
            Showing {{ $bookings->count() }} entries
        </div>
    </div>

</section>

{{-- Bottom Widgets --}}
<section class="bottom-widgets">
    <div class="widget-card insight-widget">
        <p class="widget-label">Daily Insight</p>
        <h4>Trend pelanggan meningkat 0% dari minggu lalu.</h4>
        <i class="ph ph-trend-up insight-icon"></i>
        <div class="insight-progress">
            <div class="insight-progress-bar"></div>
        </div>
    </div>

    <div class="widget-card quote-widget">
        <div class="quote-content">
            <p class="widget-label">The Artisan Voice</p>
            <h3>"Precision is not just about the cut; it's about the timing of the experience."</h3>
        </div>
        <div class="quote-image"></div>
    </div>
</section>
@endsection