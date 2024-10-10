<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iCare Service - Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Langkah 1: Definisikan font kustom */
        @font-face {
            font-family: 'Belgiano Serif 2';
            src: url('{{ asset('font/Belgiano Serif 2.ttf') }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        /* Terapkan font kustom ke judul */
        .custom-title {
            font-family: 'Belgiano Serif 2', Arial, sans-serif;
        }

        .sidebar {
            height: 100vh;
            width: 200px; /* Lebar sidebar */
            background-color: #343a40;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
            display: flex;
            flex-direction: column;
            z-index: 1000;
        }

        .sidebar a {
            text-decoration: none;
            color: white;
            padding: 5px 8px; /* Padding tombol lebih kecil */
            display: block;
            font-size: 14px;
            border-radius: 8px; /* Sudut tombol melengkung */
            margin: 5px 10px;
            border: 1px solid rgba(255, 255, 255, 0.3); /* Border lebih tipis dan transparan */
            transition: color 0.3s ease, border-color 0.3s ease, background-color 0.3s ease; /* Tambahkan transisi untuk background */
            background-color: transparent; /* Background transparan */
        }

        .sidebar a:hover {
            color: #6c757d; /* Warna teks saat hover */
            border-color: #6c757d; /* Ubah warna border saat hover */
        }

        .sidebar a:active {
            background-color: #007bff; /* Warna biru saat diklik */
            color: white; /* Ubah warna teks menjadi putih */
        }

        .sidebar .search-box {
            padding: 10px;
            margin-bottom: 20px;
        }

        .sidebar .search-box input {
            width: 100%;
            padding: 5px;
            border-radius: 5px;
            border: none;
        }

        .nav-section {
            margin-top: 20px;
        }

        .nav-section h5 {
            color: #adb5bd;
            font-size: 12px; /* Ukuran font lebih kecil untuk pengaturan */
            margin-left: 15px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .content {
            margin-left: 200px; /* Sesuaikan dengan lebar sidebar baru */
            padding: 20px;
            padding-top: 76px; /* Agar konten dimulai dari bawah navbar */
        }

        .navbar {
            background-color: #6c757d;
            z-index: 1100;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            color: white;
        }

        .logo {
            width: 35px; /* Ukuran logo lebih kecil */
            height: auto;
            margin-right: 10px;
        }

        .navbar .admin-info {
            display: flex;
            align-items: center;
            color: white;
        }

        .navbar .admin-info img {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            margin-right: 10px;
        }

        /* Styling Tabel */
        table {
            width: 100%;
            border-collapse: collapse; /* Menghilangkan jarak antara border */
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Shadow transparan */
            margin-top: 20px;
        }

        thead {
            background-color: #6c757d;
            color: white;
        }

        thead th {
            padding: 6px; /* Padding lebih kecil untuk header */
            font-weight: bold;
        }

        tbody tr {
            height: 30px; /* Tinggi baris lebih kecil */
        }

        tbody tr:hover {
            background-color: #f1f1f1;
        }

        tbody td {
            padding: 6px; /* Padding lebih kecil untuk sel */
            border-bottom: 1px solid #ddd;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        /* CSS tambahan untuk efek blur saat modal aktif */
        body.modal-open .content {
            filter: blur(5px); /* Blur halaman saat modal aktif */
            background-color: rgba(0, 0, 0, 0.2); /* Halaman menjadi lebih gelap */
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand custom-title" href="#">
            <img src="{{ asset('images/logo_iCare.png') }}" alt="Logo iCare" class="logo"> <!-- Ganti dengan logo iCare Anda -->
            iCare Service
        </a>
        <div class="ml-auto admin-info">
            <img src="https://via.placeholder.com/40" alt="User Image">
            <span>Admin</span>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="search-box">
            <input type="text" placeholder="Search">
        </div>

        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-home"></i> Halaman</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-box"></i> Barang</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('kategori.index') }}"><i class="fas fa-th-list"></i> Kategori</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-exchange-alt"></i> Transaksi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-chart-bar"></i> Laporan</a>
            </li>
        </ul>

        <div class="nav-section">
            <h5>Pengaturan</h5>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-user-cog"></i> Pengaturan Akun</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-info-circle"></i> Tentang Kami</a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Content -->
    <div class="content">
        <h1 class="custom-title">Data Kategori</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="mb-3">
            <!-- Tombol yang membuka modal -->
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahKategoriModal">Tambah Kategori</button>
        </div>

        <!-- Tabel dengan border mengambang dan shadow -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kategori as $kategoris)
                    <tr>
                        <td>{{ $kategoris->id }}</td>
                        <td>{{ $kategoris->nama }}</td>
                        <td>
                            <a href="{{ route('kategori.edit', $kategoris->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('kategori.destroy', $kategoris->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah Kategori -->
    <div class="modal fade" id="tambahKategoriModal" tabindex="-1" role="dialog" aria-labelledby="tambahKategoriLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahKategoriLabel">Tambah Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Isi form dari create.blade.php -->
                    <form action="{{ route('kategori.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Kategori:</label>
                            <input type="text" name="nama" class="form-control" placeholder="Masukkan nama kategori" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Bootstrap dan jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
