<!-- resources/views/laporans/index.blade.php -->
@extends('layouts.main')  <!-- Jika Anda menggunakan layout -->

@section('content')
    <div class="container">
        <h1>Daftar Laporan</h1>

        <!-- Flash message untuk sukses/error -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <table border="1" class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tanggal Laporan</th>
                    <th>Total Pemasukan</th>
                    <th>Total Penjualan</th>
                    <th>Total Barang Keluar</th>
                    <th>Total Barang Masuk</th>
                    <th>User</th>
                    <th>Barang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($laporans as $laporan)
                    <tr>
                        <td>{{ $laporan->id_laporan }}</td>
                        <td>{{ $laporan->tanggal_laporan }}</td>
                        <td>{{ $laporan->total_pemasukan }}</td>
                        <td>{{ $laporan->total_penjualan }}</td>
                        <td>{{ $laporan->total_barang_keluar }}</td>
                        <td>{{ $laporan->total_barang_masuk }}</td>
                        <td>{{ $laporan->user->name }}</td>  <!-- Pastikan field name ada di model user -->
                        <td>{{ $laporan->barang->nama_barang }}</td>  <!-- Pastikan nama_barang ada di model barang -->
                        <td>
                            <a href="{{ route('laporans.show', $laporan->id_laporan) }}" class="btn btn-info">Detail</a>
                            <a href="{{ route('laporans.edit', $laporan->id_laporan) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('laporans.destroy', $laporan->id_laporan) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
