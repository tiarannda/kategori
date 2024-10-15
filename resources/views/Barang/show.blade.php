<!-- resources/views/barang/show.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Barang</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Detail Barang</h1>

        <p><strong>Nama Barang:</strong> {{ $barang->nama_barang }}</p>
        <p><strong>Harga:</strong> {{ $barang->harga }}</p>
        <p><strong>Stok Saat Ini:</strong> {{ $barang->stok_saat_ini }}</p>
        <p><strong>Kategori:</strong> {{ $barang->kategori->nama_kategori }}</p>

        <a href="{{ route('barang.index') }}" class="btn btn-primary">Kembali</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
