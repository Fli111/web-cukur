@extends('layouts.admin')

@section('title', 'Kelola Produk')
@section('page-title', 'Kelola Produk')
@section('page-subtitle', 'Inventory Management — Administrator')

@section('extra-css')
/* Table Grid untuk Produk */
.table-header-grid, .table-row-grid {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 0.8fr 0.8fr 1fr;
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

/* Produk cell dengan gambar */
.td-produk {
    display: flex;
    align-items: center;
    gap: 15px;
    font-weight: 600;
}
.img-td {
    width: 40px; height: 40px;
    border-radius: 50%;
    object-fit: cover;
    border: 1px solid var(--border-color);
}

/* Action buttons */
.btn-aksi {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 14px;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    transition: 0.2s;
    margin-right: 6px;
}
.btn-edit-dark {
    background: transparent;
    border: 1px solid var(--border-color);
    color: var(--text-secondary);
}
.btn-edit-dark:hover { border-color: var(--accent-gold); color: var(--accent-gold); }
.btn-hapus-dark {
    background: transparent;
    border: 1px solid rgba(239,68,68,0.3);
    color: #ef4444;
}
.btn-hapus-dark:hover { background: rgba(239,68,68,0.1); }
@endsection

@section('content')

<section class="dashboard-card">

    <div class="card-header">
        <div class="card-title">
            <p>Inventory Log</p>
            <h3>Data Produk</h3>
        </div>
        <div class="card-actions">
            <a href="{{ route('admin.produk.tambah') }}" class="btn-gold">
                <i class="ph ph-plus"></i> Tambah Produk
            </a>
        </div>
    </div>

    {{-- Table Header --}}
    <div class="table-header-grid">
        <div>Nama Produk</div>
        <div>Kategori</div>
        <div>Harga</div>
        <div>Stok</div>
        <div>Status</div>
        <div>Aksi</div>
    </div>

    {{-- Table Rows --}}
    @forelse($produk as $data)
        <div class="table-row-grid">
            <div class="td-produk">
                <img src="{{ asset('uploads/' . $data->gambar_produk) }}" class="img-td" alt="{{ $data->nama_produk }}">
                {{ $data->nama_produk }}
            </div>
            <div style="color: var(--text-secondary);">{{ $data->kategori }}</div>
            <div style="color: var(--accent-gold); font-weight: 600;">
                Rp {{ number_format($data->harga, 0, ',', '.') }}
            </div>
            <div>{{ $data->stok }} Pcs</div>
            <div>
                @if($data->stok > 0)
                    <span class="badge tersedia">Tersedia</span>
                @else
                    <span class="badge habis">Habis</span>
                @endif
            </div>
            <div>
                <a href="{{ route('admin.produk.edit', $data->barang_id) }}" class="btn-aksi btn-edit-dark">
                    <i class="ph ph-pencil-simple"></i> Edit
                </a>
                <a href="{{ route('admin.produk.hapus', $data->barang_id) }}"
                   class="btn-aksi btn-hapus-dark"
                   onclick="return confirm('Yakin mau hapus produk ini?')">
                    <i class="ph ph-trash"></i> Hapus
                </a>
            </div>
        </div>
    @empty
        <div class="empty-state-container">
            <div class="empty-content">
                <div class="empty-icon">
                    <i class="ph ph-package"></i>
                </div>
                <h4>Belum ada produk di etalase.</h4>
                <p>Tambahkan produk pertama untuk mulai berjualan.</p>
            </div>
        </div>
    @endforelse

    <div class="card-footer">
        <div class="footer-stats">
            <div class="stat-item">
                <p>Total Produk</p>
                <h5>{{ $produk->count() }}</h5>
            </div>
            <div class="stat-item">
                <p>Total Stok</p>
                <h5 class="gold">{{ $produk->sum('stok') }} Pcs</h5>
            </div>
        </div>
        <div class="footer-entries">
            Showing {{ $produk->count() }} entries
        </div>
    </div>

</section>

@endsection