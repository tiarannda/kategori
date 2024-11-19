@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Detail Laporan</h1>
    <p><strong>Tanggal Laporan:</strong> {{ $laporan->tanggal_laporan }}</p>
    <p><strong>Total Pemasukan:</strong> {{ $laporan->total_pemasukan }}</p>
    <p><strong>Total Pengeluaran:</strong> {{ $laporan->total_pengeluaran }}</p>
    <p><strong>Total Barang Keluar:</strong> {{ $laporan->total_barang_keluar }}</p>
    <p><strong>Total Barang Masuk:</strong> {{ $laporan->total_barang_masuk }}</p>
</div>
@endsection
