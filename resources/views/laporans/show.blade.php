@extends('layouts.main')

@section('title', 'Detail Laporan')
@section('page-title', 'Detail Laporan')

@section('content')
<div class="container">
    <h1>Detail Laporan</h1>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <td>{{ $laporan->id_laporan }}</td>
        </tr>
        <tr>
            <th>Tanggal Laporan</th>
            <td>{{ $laporan->tanggal_laporan }}</td>
        </tr>
        <tr>
            <th>Total Pemasukan</th>
            <td>{{ $laporan->total_pemasukan }}</td>
        </tr>
        <tr>
            <th>Total Penjualan</th>
            <td>{{ $laporan->total_penjualan }}</td>
        </tr>
        <tr>
            <th>Total Barang Keluar</th>
            <td>{{ $laporan->total_barang_keluar }}</td>
        </tr>
        <tr>
            <th>Total Barang Masuk</th>
            <td>{{ $laporan->total_barang_masuk }}</td>
        </tr>
        <tr>
            <th>Barang</th>
            <td>{{ $laporan->barang->nama_barang }}</td>
        </tr>
    </table>

    <a href="{{ route('laporans.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
