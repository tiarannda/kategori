<!-- resources/views/barang/index.blade.php -->
@extends('layouts.main')

@section('title', 'iCare Service - Data Barang')

@section('page-title', 'Data Barang')

@section('barang_active', 'active')

@section('content')

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3">
        <a href="{{ route('barang.create') }}" class="btn btn-primary" style="font-family: 'Montserrat', sans-serif;">Tambah Barang</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="card-title" style="font-family: 'Montserrat', sans-serif;">Tabel Barang</h4>
        </div>
        <div class="card-body">
            <table class="table table-hover" style="font-family: 'Montserrat', sans-serif;">
                <thead class="thead-light">
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
                                <a href="{{ route('barang.show', $barang->id_barang) }}" class="btn btn-info btn-sm" style="font-family: 'Montserrat', sans-serif;">Detail</a>
                                <a href="{{ route('barang.edit', $barang->id_barang) }}" class="btn btn-warning btn-sm" style="font-family: 'Montserrat', sans-serif;">Edit</a>
                                <form action="{{ route('barang.destroy', $barang->id_barang) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" style="font-family: 'Montserrat', sans-serif;" onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
