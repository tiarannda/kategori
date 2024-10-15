<!-- resources/views/kategoris/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iCare Service - Kategori</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
    <style>
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

        .custom-title {
            font-family: 'Belgiano Serif 2', Arial, sans-serif;
        }

        .content {
            margin-left: 0px; /* Disesuaikan dengan lebar sidebar */
            padding: 20px;
            padding-top: 70px; 
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
            width: 35px;
            height: auto;
            margin-right: 10px;
        }

        /* Styling Tabel */
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        thead {
            background-color: #6c757d;
            color: white;
        }

        thead th {
            padding: 6px;
            font-weight: bold;
        }

        tbody tr {
            height: 30px;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
        }

        tbody td {
            padding: 6px;
            border-bottom: 1px solid #ddd;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar" data-color="black" data-active-color="danger">
            <div class="logo">
                <a href="#" class="simple-text logo-mini">
                    <div class="logo-image-small">
                        <img src="../assets/img/logo_iCare.png">
                    </div>
                </a>
                <a href="#" class="simple-text logo-normal">
                    iCare Service
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <p>Halaman</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('barang.index') }}">
                            <p>Barang</p>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('kategoris.index') }}">
                            <p>Kategori</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <p>Transaksi</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <p>Laporan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <p>Akun</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <p>Tentang</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- End Sidebar -->

        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <a class="navbar-brand custom-title" href="#">Kategori</a>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->

            <!-- Content -->
            <div class="content">
                <h1 class="custom-title">Kategori</h1>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="mb-3">
                    <a href="{{ route('kategoris.create') }}" class="btn btn-primary">Tambah Kategori</a>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kategoris as $kategori)
                            <tr>
                                <td>{{ $kategori->name }}</td>
                                <td>
                                    <a href="{{ route('kategoris.edit', $kategori->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('kategoris.destroy', $kategori->id) }}" method="POST" style="display:inline;">
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
            <!-- End Content -->

            <footer class="footer footer-black footer-white">
                <div class="container-fluid">
                    <div class="row">
                        
                        
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Script Bootstrap dan jQuery -->
    <script src="../assets/js/core/jquery.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <script src="../assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script>
</body>
</html>
