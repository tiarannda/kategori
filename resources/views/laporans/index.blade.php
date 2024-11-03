@extends('layouts.main')

@section('title', 'Daftar Laporan')
@section('page-title', 'Daftar Laporan')

@section('content')
<div class="container">
    

    <!-- Tombol untuk menambah laporan baru -->
    <a href="{{ route('laporans.create') }}" class="btn btn-primary mb-3">Tambah Laporan</a>

    <!-- Menampilkan pesan sukses -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabel Daftar Laporan -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tanggal Laporan</th>
                <th>Total Pemasukan</th>
                <th>Total Penjualan</th>
                <th>Total Barang Keluar</th>
                <th>Total Barang Masuk</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laporans as $laporan)
            <tr>
                <td>{{ $laporan->id }}</td>
                <td>{{ $laporan->tanggal_laporan }}</td>
                <td>{{ $laporan->total_pemasukan }}</td>
                <td>{{ $laporan->total_penjualan }}</td>
                <td>{{ $laporan->total_barang_keluar }}</td>
                <td>{{ $laporan->total_barang_masuk }}</td>
                <td>
                    <!-- Tombol Detail -->
                    <a href="{{ route('laporans.show', $laporan->id) }}" class="btn btn-info btn-sm">Detail</a>
                    
                    <!-- Tombol Hapus -->
                    <form action="{{ route('laporans.destroy', $laporan->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Tidak ada data laporan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
