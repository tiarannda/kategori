@extends('layouts.main')

@section('page-title', 'Detail Laporan')

@section('laporan_active', 'active')

@section('content')
<div class="container">

    <p><strong>Tanggal Laporan:</strong> {{ $laporan->tanggal_laporan }}</p>
    <p><strong>Total Pemasukan:</strong> {{ $laporan->total_pemasukan }}</p>
    <p><strong>Total Pengeluaran:</strong> {{ $laporan->total_pengeluaran }}</p>
    <p><strong>Total Barang Keluar:</strong> {{ $laporan->total_barang_keluar }}</p>
    <p><strong>Total Barang Masuk:</strong> {{ $laporan->total_barang_masuk }}</p>
</div>
@endsection
