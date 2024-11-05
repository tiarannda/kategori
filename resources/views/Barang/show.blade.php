<!-- resources/views/barang/show.blade.php -->
@extends('layouts.main')

@section('title', 'Detail Barang')

@section('page-title', 'Detail Barang')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title" style="font-family: 'Montserrat', sans-serif;">Detail Barang</h4>
        </div>
        <div class="card-body" style="font-family: 'Montserrat', sans-serif;">
            <p><strong>Nama Barang:</strong> {{ $barang->nama_barang }}</p>
            <p><strong>Harga:</strong> Rp. {{ number_format($barang->harga, 3, '.', ',') }}</p>
            <p><strong>Stok Saat Ini:</strong> {{ $barang->stok_saat_ini }}</p>
            <p><strong>Kategori:</strong> {{ $barang->kategori ? $barang->kategori->name : 'Tidak ada kategori' }}</p>

            <a href="{{ route('barang.index') }}" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    </div>
</div>
@endsection
