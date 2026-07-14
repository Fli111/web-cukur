@extends('layouts.admin')

@section('title', 'Edit Produk')
@section('page-title', 'Edit Produk')
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
textarea.form-input { resize: vertical; min-height: 120px; }
.preview-img {
    width: 80px; height: 80px;
    border-radius: 4px;
    object-fit: cover;
    border: 1px solid var(--border-color);
    margin-bottom: 10px;
    display: block;
}
.hint {
    color: var(--text-muted);
    font-size: 11px;
    margin-top: 6px;
}
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
    <h3>Edit Data Produk</h3>

    <form action="{{ route('admin.produk.update', $data->barang_id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Nama Produk</label>
            <input type="text" name="nama_produk" class="form-input"
                   value="{{ $data->nama_produk }}" required>
        </div>

        <div class="form-group">
            <label>Kategori</label>
            <input type="text" name="kategori" class="form-input"
                   value="{{ $data->kategori }}" required>
        </div>

        <div class="form-group">
            <label>Harga (IDR)</label>
            <input type="number" name="harga" class="form-input"
                   value="{{ $data->harga }}" required>
        </div>

        <div class="form-group">
            <label>Stok</label>
            <input type="number" name="stok" class="form-input"
                   value="{{ $data->stok }}" required>
        </div>

        <div class="form-group">
            <label>Ganti Foto Produk</label>
            {{-- Preview foto saat ini --}}
            @if($data->gambar_produk)
                <img src="{{ asset('uploads/' . $data->gambar_produk) }}"
                     class="preview-img" alt="Foto saat ini">
            @endif
            <input type="file" name="gambar_produk" class="form-input" accept="image/*">
            <p class="hint">Kosongkan jika tidak ingin mengganti foto.</p>
        </div>

        <div class="form-group">
            <label>Deskripsi Produk</label>
            <textarea name="deskripsi_produk" class="form-input" required>{{ $data->deskripsi_produk }}</textarea>
        </div>

        <button type="submit" class="btn-submit">
            <i class="ph ph-check"></i> Update Data Produk
        </button>
    </form>
</div>

@endsection