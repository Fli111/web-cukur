@extends('layouts.admin')

@section('title', 'Tambah Produk')
@section('page-title', 'Tambah Produk')
@section('page-subtitle', 'Product Management — Administrator')

@section('extra-css')
.form-card {
    background-color: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 4px;
    padding: 40px;
    max-width: 700px;
}
.form-card h3 {
    font-family: var(--font-serif);
    font-size: 24px;
    font-style: italic;
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 1px solid var(--border-color);
}
.form-group {
    margin-bottom: 22px;
}
.form-group label {
    display: block;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: var(--text-secondary);
    margin-bottom: 10px;
}
.form-input {
    width: 100%;
    padding: 12px 16px;
    background-color: var(--bg-hover);
    border: 1px solid var(--border-color);
    border-radius: 4px;
    color: var(--text-primary);
    font-family: var(--font-sans);
    font-size: 13px;
    box-sizing: border-box;
    transition: 0.2s;
}
.form-input:focus {
    outline: none;
    border-color: var(--accent-gold);
}
.form-input option { background-color: var(--bg-card); }
textarea.form-input { resize: vertical; min-height: 120px; }
.error-box {
    background: rgba(239,68,68,0.1);
    border: 1px solid rgba(239,68,68,0.2);
    color: #ef4444;
    padding: 15px 20px;
    border-radius: 4px;
    margin-bottom: 25px;
    font-size: 13px;
}
.error-box ul { padding-left: 20px; margin-top: 8px; }
.btn-submit {
    background-color: var(--accent-gold);
    color: #000;
    padding: 14px 30px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    border: none;
    cursor: pointer;
    transition: 0.3s;
    margin-top: 10px;
}
.btn-submit:hover { background-color: var(--accent-gold-hover); }
.btn-back-link {
    color: var(--text-muted);
    font-size: 11px;
    letter-spacing: 1px;
    text-transform: uppercase;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-bottom: 25px;
    transition: 0.2s;
}
.btn-back-link:hover { color: var(--text-secondary); }
@endsection

@section('content')

<a href="{{ url('/admin/dashboard') }}" class="btn-back-link">
    <i class="ph ph-arrow-left"></i> Kembali ke Dashboard
</a>

<div class="form-card">
    <h3>Tambah Produk Baru</h3>

    @if ($errors->any())
        <div class="error-box">
            <strong>Ada yang salah:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.produk.simpan') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" name="nama_produk" class="form-input"
                   placeholder="Contoh: Smith Men Supply Powder"
                   value="{{ old('nama_produk') }}" required>
        </div>

        <div class="form-group">
            <label>Kategori</label>
            <select name="kategori" class="form-input" required>
                <option value="" disabled selected>Pilih Kategori</option>
                <option value="Powder"  {{ old('kategori') == 'Powder'  ? 'selected' : '' }}>Powder</option>
                <option value="Shampoo" {{ old('kategori') == 'Shampoo' ? 'selected' : '' }}>Shampoo</option>
                <option value="Tools"   {{ old('kategori') == 'Tools'   ? 'selected' : '' }}>Tools</option>
            </select>
        </div>

        <div class="form-group">
            <label>Harga (IDR)</label>
            <input type="number" name="harga" class="form-input"
                   placeholder="Contoh: 100000"
                   value="{{ old('harga') }}" required>
        </div>

        <div class="form-group">
            <label>Stok Awal</label>
            <input type="number" name="stok" class="form-input"
                   placeholder="0"
                   value="{{ old('stok') }}" required>
        </div>

        <div class="form-group">
            <label>Foto Produk</label>
            <input type="file" name="gambar_produk" class="form-input"
                   accept="image/*" required>
        </div>

        <div class="form-group">
            <label>Deskripsi Produk</label>
            <textarea name="deskripsi_produk" class="form-input"
                      placeholder="Tulis deskripsi produk di sini..." required>{{ old('deskripsi_produk') }}</textarea>
        </div>

        <button type="submit" class="btn-submit">
            <i class="ph ph-check"></i> Simpan ke Etalase
        </button>
    </form>
</div>

@endsection