@extends('layouts.main')

@section('title', 'iCare Service - Data Laporan')

@section('page-title', 'Data Transaksi')

@section('transaksi_active', 'active')

@section('content')
<div class="container">
    
    <a href="{{ route('laporans.create') }}" class="btn btn-primary mb-3">Tambah Laporan</a>

    @foreach($laporans as $bulan => $laporanPerBulan)
        <!-- Menampilkan bulan dan tahun (contoh: Januari 2024) -->
        <h3 style="margin-top: 30px;">{{ $bulan }}</h3> 

        <table class="table table-bordered" style="margin-bottom: 30px;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tanggal Laporan</th>
                    <th>Total Pemasukan</th>
                    <th>Total Pengeluaran</th>
                    <th>Total Barang Keluar</th>
                    <th>Total Barang Masuk</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            
            <tbody>
                @foreach($laporanPerBulan as $laporan)
                    <tr>
                        <td>{{ $laporan->id_laporan }}</td>
                        <td>{{ $laporan->tanggal_laporan }}</td>
                        <td>{{ number_format($laporan->total_pemasukan, 3, ',', '.') }}</td>
                        <td>{{ number_format($laporan->total_pengeluaran, 3, ',', '.') }}</td>
                        <td>{{ number_format($laporan->total_barang_keluar, 0, ',', '.') }}</td>
                        <td>{{ number_format($laporan->total_barang_masuk, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('laporans.show', $laporan->id_laporan) }}" class="btn btn-info btn-sm">Detail</a>
                            <form action="{{ route('laporans.destroy', $laporan->id_laporan) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">Total</td>
                    <td>{{ number_format($laporanPerBulan->sum('total_pemasukan'), 3, ',', '.') }}</td>
                    <td>{{ number_format($laporanPerBulan->sum('total_pengeluaran'), 3, ',', '.') }}</td>
                    <td>{{ number_format($laporanPerBulan->sum('total_barang_keluar'), 0, ',', '.') }}</td>
                    <td>{{ number_format($laporanPerBulan->sum('total_barang_masuk'), 0, ',', '.') }}</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    @endforeach
</div>
@endsection
