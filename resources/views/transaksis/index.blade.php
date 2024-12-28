@extends('layouts.main')

@section('title', 'iCare Service - Data Transaksi')

@section('page-title', 'Data Transaksi')

@section('transaksi_active', 'active')

@section('content')
<div class="container">
    <!-- Tombol Tambah Transaksi -->
    <div class="d-flex justify-content-between align-items-center mt-4">
        <a href="{{ route('transaksis.create') }}" class="btn btn-primary">Tambah Transaksi</a>
    </div>

    <!-- Pesan Sukses -->
    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabel Data Transaksi -->
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Tipe Transaksi</th>
                <th>Tanggal Transaksi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksis as $transaksi)
                <tr>
                    <td>{{ $transaksi->id }}</td>
                    <td>{{ $transaksi->barang->nama_barang }}</td>
                    <td>{{ $transaksi->jumlah_barang }}</td>
                    <td>Rp. {{ number_format($transaksi->total_harga, 3, '.', ',') }}</td>
                    <td>{{ ucfirst($transaksi->tipe_transaksi) }}</td>
                    <td>{{ $transaksi->tanggal->format('d M Y') }}</td>
                    <td>
                        <!-- Tombol Aksi -->
                        <a href="{{ route('transaksis.show', $transaksi->id) }}" class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ route('transaksis.edit', $transaksi->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('transaksis.destroy', $transaksi->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus transaksi ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
