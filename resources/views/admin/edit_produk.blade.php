<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body class="admin-body">
    <div class="form-container">
        <div class="header-form">
            <h2>Edit Data Barang</h2>
            <a href="/admin/dashboard" class="btn-back">← Kembali</a>
        </div>

        <form action="/admin/produk/update/{{ $data->barang_id }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label>Nama Produk:</label>
                <input type="text" name="nama_produk" class="form-input" value="{{ $data->nama_produk }}" required>
            </div>

            <div class="form-group">
                <label>Kategori:</label>
                <input type="text" name="kategori" class="form-input" value="{{ $data->kategori }}" required>
            </div>

            <div class="form-group">
                <label>Harga (IDR):</label>
                <input type="number" name="harga" class="form-input" value="{{ $data->harga }}" required>
            </div>

            <div class="form-group">
                <label>Stok:</label>
                <input type="number" name="stok" class="form-input" value="{{ $data->stok }}" required>
            </div>

            <div class="form-group">
                <label>Ganti Foto Produk (Kosongkan jika tidak ingin ganti):</label>
                <input type="file" name="gambar_produk" class="form-input" accept="image/*">
            </div>
            
            <div class="form-group">
                <label>Deskripsi Produk</label>
                <textarea name="deskripsi_produk" class="form-input" rows="5" required>{{ $data->deskripsi_produk }}</textarea>
            </div>
            
            <button type="submit" class="btn-hitam">UPDATE DATA BARANG</button>
        </form>
    </div>
</body>
</html>