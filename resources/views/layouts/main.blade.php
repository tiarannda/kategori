<!-- resources/views/layouts/main.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @if (!Request::is('transaksis/*/edit'))
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
                        <li class="nav-item @yield('dashboard_active')">
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                <p>Halaman</p>
                            </a>
                        </li>
                        <li class="nav-item @yield('barang_active')">
                            <a class="nav-link" href="{{ route('barang.index') }}">
                                <p>Barang</p>
                            </a>
                        </li>
                        <li class="nav-item @yield('kategori_active')">
                            <a class="nav-link" href="{{ route('kategoris.index') }}">
                                <p>Kategori</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('transaksis.index') }}">
                                <p>Transaksi</p>
                            </a>
                        </li>
                        <li class="nav-item @yield('laporans_active')">
                            <a class="nav-link" href="{{ route('laporans.index') }}">
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
        @endif
        <!-- End Sidebar -->

        <div class="main-panel">
            <!-- Navbar -->
            @if (!Request::is('transaksis/*/edit'))
                <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
                    <div class="container-fluid">
                        <div class="navbar-wrapper">
                            <a class="navbar-brand" href="#">@yield('page-title')</a>
                        </div>
                    </div>
                </nav>
            @endif
            <!-- End Navbar -->

            <!-- Content -->
            <div class="content">
                @yield('content')
            </div>
            <!-- End Content -->

            <footer class="footer footer-black footer-white">
                <div class="container-fluid">
                    <div class="row"></div>
                </div>
            </footer>
        </div>
    </div>

    <script src="../assets/js/core/jquery.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <script src="../assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script>
</body>
</html>

