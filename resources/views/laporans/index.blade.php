@extends('layouts.main')

@section('title', 'iCare Service - Data Laporan')

@section('page-title', 'Data Laporan')

@section('laporan_active', 'active')

@section('content')
    <div class="container">
        <!-- Tombol Tambah Laporan -->
        <div class="d-flex justify-content-between align-items-center mt-4">
            <a href="{{ route('laporans.create') }}" class="btn btn-primary">Tambah Laporan</a>
        </div>

        <!-- Form Kirim Laporan ke Dropbox -->
        <h4 class="mt-4">Kirim Data Laporan ke Dropbox</h4>
        <form action="{{ route('laporans.sendToDropbox') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="tanggal">Pilih Tanggal:</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Kirim Laporan</button>
        </form>

        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger mt-3">
                {{ session('error') }}
            </div>
        @endif

        <!-- Garis Pemisah -->
        <hr class="mt-5 mb-4">

        <!-- Daftar Laporan Bulanan -->
        @foreach ($laporans as $bulan => $laporanPerBulan)
            <h3 class="mt-5">{{ $bulan }}</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tanggal</th>
                        <th>Pemasukan</th>
                        <th>Pengeluaran</th>
                        <th>Barang Keluar</th>
                        <th>Barang Masuk</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($laporanPerBulan as $laporan)
                        <tr>
                            <td>{{ $laporan->id_laporan }}</td>
                            <td>{{ $laporan->tanggal_laporan }}</td>
                            <td>{{ number_format($laporan->total_pemasukan, 2, ',', '.') }}</td>
                            <td>{{ number_format($laporan->total_pengeluaran, 2, ',', '.') }}</td>
                            <td>{{ $laporan->total_barang_keluar }}</td>
                            <td>{{ $laporan->total_barang_masuk }}</td>
                            <td>
                                <a href="{{ route('laporans.show', $laporan->id_laporan) }}"
                                    class="btn btn-info btn-sm">Detail</a>
                                <form action="{{ route('laporans.destroy', $laporan->id_laporan) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Hapus laporan ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
    </div>
@endsection
