@extends('layouts.main')

@section('title', 'iCare Service - Data Transaksi')

@section('page-title', 'Data Transaksi')

@section('transaksi_active', 'active')

@section('content')
<div class="container">
    

    <a href="{{ route('transaksis.create') }}" class="btn btn-primary mb-3">Tambah Transaksi</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
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
                    <td class="kontainer-aksi">
                        <a href="{{ route('transaksis.show', $transaksi->id) }}" class="btn btn-info">Detail</a>
                        <a href="{{ route('transaksis.edit', $transaksi->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('transaksis.destroy', $transaksi->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus transaksi ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
