@extends('layouts.main')

@section('page-title', 'Tambah Transaksi')

@section('transaksi_active', 'active')

@section('content')
<div class="container">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('transaksis.store') }}" method="post">
        @csrf

        <div class="form-group">
            <label for="id_barang">Barang</label>
            <select name="id_barang" id_barang="id_barang" class="form-control">
                <option value="">Pilih Barang</option>
                @foreach($barangs as $barang)
                    <option value="{{ $barang->id_barang }}">{{ $barang->nama_barang }} - Rp. {{ number_format($barang->harga, 3, '.', ',') }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="jumlah_barang">Jumlah</label>
            <input type="number" name="jumlah_barang" id_barang="jumlah_barang" class="form-control" min="1" value="{{ old('jumlah_barang') }}">
        </div>

        <div class="form-group">
            <label for="tipe_transaksi">Tipe Transaksi</label>
            <select name="tipe_transaksi" id_barang="tipe_transaksi" class="form-control">
                <option value="">Pilih Tipe Transaksi</option>
                <option value="jual">Jual</option>
                <option value="beli">Beli</option>
            </select>
        </div>

        <!-- Input untuk Tanggal Transaksi -->
        <div class="form-group">
            <label for="tanggal">Tanggal Transaksi</label>
            <input type="date" name="tanggal" id_barang="tanggal" class="form-control" value="{{ old('tanggal', date('Y-m-d')) }}">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
