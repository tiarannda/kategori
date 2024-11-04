@extends('layouts.main')

@section('title', 'Tambah Laporan')

@section('content')
<div class="container">
    <h1>Tambah Laporan</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('laporans.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="tanggal_laporan" class="form-label">Tanggal Laporan</label>
            <input type="date" name="tanggal_laporan" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="total_pemasukan" class="form-label">Total Pemasukan</label>
            <input type="number" name="total_pemasukan" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="total_penjualan" class="form-label">Total Penjualan</label>
            <input type="number" name="total_penjualan" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="total_barang_keluar" class="form-label">Total Barang Keluar</label>
            <input type="number" name="total_barang_keluar" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="total_barang_masuk" class="form-label">Total Barang Masuk</label>
            <input type="number" name="total_barang_masuk" class="form-control" required>
        </div>
       
        <div class="mb-3">
            <label for="id_barang" class="form-label">Barang</label>
            <select name="id_barang" class="form-control" required>
                @foreach($barangs as $barang)
                    <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Laporan</button>
        <a href="{{ route('laporans.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
