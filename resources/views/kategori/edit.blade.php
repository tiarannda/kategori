<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori</title>
</head>
<body>
    <h1>Edit Kategori</h1>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Menambahkan method PUT untuk update -->
        <label for="nama">Nama Kategori:</label>
        <input type="text" name="nama" value="{{ $kategori->nama }}" required>
        <button type="submit">Update</button>
    </form>

    <a href="{{ route('kategori.index') }}">Kembali</a>
</body>
</html>
