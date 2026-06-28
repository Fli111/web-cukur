<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Tambah Produk Baru</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body class="admin-body">
    <div class="form-container">
        <div class="header-form">
            <h2 style="margin: 0;">Tambah Produk</h2>
            <a href="/admin/dashboard" class="btn-back">← Kembali</a>
        </div>

        <form action="/admin/produk/simpan" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label>Nama Barang:</label>
                <input type="text" name="nama_produk" class="form-input" placeholder="Contoh: Smith Men Supply Powder" required>
            </div>

            <div class="form-group">
                <label>Kategori:</label>
                <select name="kategori" class="form-input" required>
                    <option value="" disabled selected>Pilih Kategori</option>
                    <option value="Powder">Powder</option>
                    <option value="Shampoo">Shampoo</option>
                    <option value="Tools">Tools</option>
                </select>
            </div>

            <div class="form-group">
                <label>Harga (IDR):</label>
                <input type="number" name="harga" class="form-input" placeholder="Contoh: 100000" required>
            </div>

            <div class="form-group">
                <label>Stok Awal:</label>
                <input type="number" name="stok" class="form-input" placeholder="0" required>
            </div>

            <div class="form-group">
                <label>Foto Produk:</label>
                <input type="file" name="gambar_produk" class="form-input" accept="image/*" required>
            </div>

            <div class="form-group">
                <label>Deskripsi Produk</label>
                <textarea name="deskripsi" class="form-input" rows="5" placeholder="Tulis deskripsi produk di sini..." required></textarea>
            </div>

            <button type="submit" class="btn-hitam" style="margin-top: 20px;">SIMPAN KE ETALASE</button>
        </form>
    </div>
</body>
</html>