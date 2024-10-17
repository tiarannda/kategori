@extends('layouts.main')

@section('title', 'iCare Service - Daftar Transaksi')

@section('page-title', 'Daftar Transaksi')

@section('transaksi_active', 'active') <!-- Aktifkan tab transaksi jika ada -->

@section('content')
    <h1 class="font-weight-bold" style="font-family: 'Montserrat', sans-serif;">Daftar Transaksi</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3">
        <a href="{{ route('transaksis.create') }}" class="btn btn-primary" style="font-family: 'Montserrat', sans-serif;">Tambah Transaksi</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="card-title" style="font-family: 'Montserrat', sans-serif;">Tabel Transaksi</h4>
        </div>
        <div class="card-body">
            <table class="table table-hover" style="font-family: 'Montserrat', sans-serif;">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Barang</th>
                        <th>Jumlah Barang</th>
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
                            <td>{{ number_format($transaksi->total_harga, 2, '.', ',') }}</td>
                            <td>{{ ucfirst($transaksi->tipe_transaksi) }}</td>
                            <td>{{ $transaksi->tanggal_transaksi->format('d-m-Y') }}</td>
                            <td>
                                <a href="{{ route('transaksis.edit', $transaksi->id) }}" class="btn btn-warning btn-sm" style="font-family: 'Montserrat', sans-serif;">Edit</a>
                                <form action="{{ route('transaksis.destroy', $transaksi->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" style="font-family: 'Montserrat', sans-serif;" onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?');">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
