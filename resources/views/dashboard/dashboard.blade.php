    @extends('dashboard.tampilan')

    @section('content')
    <div class="content">
        <div class="row">
            <!-- Total Stok Semua Barang -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-globe text-warning"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Total Stok Semua Barang</p>
                                    <p class="card-title" style="font-size: smaller !important;">{{ $totalStock }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-refresh"></i> Update Now
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pendapatan Bulan Ini -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-money-coins text-success"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Pendapatan Bulan Ini</p>
                                    <p class="card-title" style="font-size: smaller !important;">
                                        {{ number_format($pendapatanBulanIni, 3, '.', ',') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-calendar-o"></i> Last month
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pengeluaran Bulan Ini -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-vector text-danger"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Pengeluaran Bulan Ini</p>
                                    <p class="card-title" style="font-size: smaller !important;">
                                        {{ number_format($pengeluaranBulanIni, 3, '.', ',') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-clock-o"></i> In the last month
                        </div>
                    </div>
                </div>
            </div>

            <!-- Untung Bulan Ini -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-favourite-28 text-primary"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Untung Bulan ini</p>
                                    <p class="card-title" style="font-size: smaller !important;">{{ number_format($untungBulanIni, 3, '.', ',') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-refresh"></i> Update now
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik Penjualan 7 Hari Terakhir -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Grafik Penjualan 7 Hari Terakhir</h5>

                    </div>
                    <div class="card-body">
                        <canvas id="chartHours" width="400" height="100"></canvas>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-history"></i> Last updated: {{ now()->format('d M Y') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- perhitungan TPK -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Lihat Barang Terlaris !</h5>
                        <p>Barang Terlaris saat ini adalah : </p>
    @if ($hasilTertinggi)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Skor</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $hasilTertinggi['nama'] }}</td>

                    <td>{{ number_format($hasilTertinggi['score'], 2) }}</td>
                </tr>
            </tbody>
        </table>
    @else
        <p>Tidak ada data untuk ditampilkan.</p>
    @endif

        </div>
    </div>

    @endsection

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var ctx = document.getElementById('chartHours').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($labels),
                    datasets: [
                        {
                            label: 'Total Pemasukan',
                            data: @json($dataPemasukan),
                            borderColor: 'green',
                            fill: false,
                        },
                        {
                            label: 'Total Pengeluaran',
                            data: @json($dataPengeluaran),
                            borderColor: 'red',
                            fill: false,
                        },
                        {
                            label: 'Total Barang Keluar',
                            data: @json($dataBarangKeluar),
                            borderColor: 'blue',
                            fill: false,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Tanggal'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Jumlah'
                            }
                        }
                    }
                }
            });
        });
    </script>
    @endpush

    @stack('scripts')



