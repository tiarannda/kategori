@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Detail Transaksi</h1>

    <table class="table">
        <tr>
            <th>ID</th>
            <td>{{ $transaksi->id_transaksi }}</td>
        </tr>
        <tr>
            <th>Nama Barang</th>
            <td>{{ $transaksi->barang->nama_barang }}</td>
        </tr>
        <tr>
            <th>Jumlah Barang</th>
            <td>{{ $transaksi->jumlah_barang }}</td>
        </tr>
        <tr>
            <th>Total Harga</th>
            <td>Rp {{ number_format($transaksi->total_harga, 3, '.', ',') }}</td>
        </tr>
        <tr>
            <th>Tipe Transaksi</th>
            <td>{{ ucfirst($transaksi->tipe_transaksi) }}</td>
        </tr>
        <tr>
            <th>Tanggal Transaksi</th>
            <td>{{ $transaksi->tanggal->format('d M Y') }}</td>
        </tr>
    </table>

    <a href="{{ route('transaksis.index') }}" class="btn btn-primary">Kembali</a>
</div>
@endsection
