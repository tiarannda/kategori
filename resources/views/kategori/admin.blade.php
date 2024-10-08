<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="sidebar">
        <!-- Konten sidebar -->
        <h2>Menu</h2>
        <ul>
            <li><a href="{{ route('kategori.index') }}">Kategori</a></li>
            <!-- Tambahkan menu lain di sini -->
        </ul>
    </div>
    
    <div class="content">
        @yield('content') <!-- Tempat untuk konten dari halaman lain -->
    </div>

    <script src="{{ asset('js/app.js') }}"></script> <!-- Link ke JS jika ada -->
    <!-- Tambahkan link JS lain di sini -->
</body>
</html>
