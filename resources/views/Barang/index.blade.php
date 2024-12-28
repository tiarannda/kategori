@extends('layouts.main')

@section('title', 'iCare Service - Data Barang')

@section('page-title', 'Data Barang')

@section('barang_active', 'active')

@section('content')
<div class="container">
    <!-- Tombol Tambah Barang -->
    <div class="d-flex justify-content-between align-items-center mt-4">
        <a href="{{ route('barang.create') }}" class="btn btn-primary">Tambah Barang</a>
    </div>

    <!-- Pesan Sukses -->
    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabel Data Barang -->
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barangs as $barang)
                <tr>
                    <td>{{ $barang->nama_barang }}</td>
                    <td>Rp. {{ number_format($barang->harga, 3, '.', ',') }}</td>
                    <td>{{ $barang->stok_saat_ini }}</td>
                    <td>{{ $barang->kategori ? $barang->kategori->name : 'Tidak ada kategori' }}</td>
                    <td>
                        <!-- Tombol Aksi -->
                        <a href="{{ route('barang.show', $barang->id_barang) }}" class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ route('barang.edit', $barang->id_barang) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('barang.destroy', $barang->id_barang) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
