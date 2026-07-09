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

        {{-- Blok untuk menampilkan semua error validasi --}}
        @if ($errors->any())
            <div style="background-color: #fce8e6; color: #d93025; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                <strong>Waduh, ada yang salah:</strong>
                <ul style="margin-top: 10px; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/admin/produk/simpan" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label>Nama Barang:</label>
                <input type="text" name="nama_produk" class="form-input" placeholder="Contoh: Smith Men Supply Powder" value="{{ old('nama_produk') }}" required>
            </div>

            <div class="form-group">
                <label>Kategori:</label>
                <select name="kategori" class="form-input" required>
                    {{-- 
                        Fungsi `old('kategori')`untuk "mengingat" input yang sudah dipilih pengguna.
                        Jika validasi gagal dan halaman me-refresh, kategori yang sebelumnya dipilih akan otomatis terpilih kembali,
                        sehingga pengguna tidak perlu mengisi ulang semua data dari awal.
                    --}}
                    <option value="" disabled selected>Pilih Kategori</option>
                    <option value="Powder" {{ old('kategori') == 'Powder' ? 'selected' : '' }}>Powder</option> 
                    <option value="Shampoo" {{ old('kategori') == 'Shampoo' ? 'selected' : '' }}>Shampoo</option>
                    <option value="Tools" {{ old('kategori') == 'Tools' ? 'selected' : '' }}>Tools</option>
                </select>
            </div>

            <div class="form-group">
                <label>Harga (IDR):</label>
                <input type="number" name="harga" class="form-input" placeholder="Contoh: 100000" value="{{ old('harga') }}" required>
            </div>

            <div class="form-group">
                <label>Stok Awal:</label>
                <input type="number" name="stok" class="form-input" placeholder="0" value="{{ old('stok') }}" required>
            </div>

            <div class="form-group">
                <label>Foto Produk:</label>
                <input type="file" name="gambar_produk" class="form-input" accept="image/*" required>
            </div>

            <div class="form-group">
                <label>Deskripsi Produk</label>
                {{-- PERBAIKAN: Nama input diubah dari 'deskripsi' menjadi 'deskripsi_produk' agar sesuai dengan controller --}}
                <textarea name="deskripsi_produk" class="form-input" rows="5" placeholder="Tulis deskripsi produk di sini..." required>{{ old('deskripsi_produk') }}</textarea>
            </div>

            <button type="submit" class="btn-hitam" style="margin-top: 20px;">SIMPAN KE ETALASE</button>
        </form>
    </div>
</body>
</html>