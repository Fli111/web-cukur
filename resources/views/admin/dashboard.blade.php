<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Hartono Barbershop</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body class="admin-body">

    <div class="admin-header">
        <div class="admin-logo">MR. HARTONO</div>
        <div class="pill-nav">
            <a href="#" class="pill-item" onclick="alert('Sabar cuy, halaman Dashboard Utama masih dalam tahap pengembangan!'); return false;">Dashboard</a>
            <a href="#" class="pill-item active">Produk</a>
            <a href="#" class="pill-item">Transaksi</a>
            <a href="#" class="pill-item">Pelanggan</a>
        </div>
        <div class="pill-nav">
            <a href="/" class="pill-item">Lihat Web</a>
        </div>
    </div>

    <div class="container">
        <div class="page-title" style="margin-top: 20px;">Data Produk</div>
        
        @if(session('success'))
            <div style="background-color: #e6f4ea; color: #1e8e3e; padding: 10px; border-radius: 6px; margin-top: 15px; font-weight: bold;">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <div class="table-controls">
        <a href="/admin/produk/tambah"><button class="btn-kuning">+ Tambah Barang</button></a>
    </div>

    <div class="table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produk as $data)
                <tr>
                    <td>
                        <div class="td-produk">
                            <img src="{{ asset('uploads/' . $data->gambar_produk) }}" class="img-td">
                            {{ $data->nama_produk }}
                        </div>
                    </td>
                    <td style="color: #666;">{{ $data->kategori }}</td>
                    <td style="font-weight: bold;">Rp {{ number_format($data->harga, 0, ',', '.') }}</td>
                    <td>{{ $data->stok }} Pcs</td>
                    <td>
                        @if($data->stok > 0)
                            <span class="badge-status badge-green">Tersedia</span>
                        @else
                            <span class="badge-status badge-red">Habis</span>
                        @endif
                    </td>
                    <td>
                        <a href="/admin/produk/edit/{{ $data->barang_id }}" class="btn-edit">Edit</a>
                        <a href="/admin/produk/hapus/{{ $data->barang_id }}" class="btn-hapus" onclick="return confirm('Yakin mau hapus barang ini cuy?');">Hapus</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>