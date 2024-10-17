@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Tambah Transaksi</h2>
    
    {{-- Tampilkan pesan kesalahan jika ada --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form untuk menyimpan transaksi --}}
    <form action="{{ route('transaksis.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="id_barang" class="form-label">Barang</label>
            <select class="form-control" id="id_barang" name="id_barang" required>
                @foreach($barangs as $barang)
                    <option value="{{ $barang->id_barang }}">{{ $barang->nama_barang }} {{ $barang->harga }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="jumlah_barang" class="form-label">Jumlah Barang</label>
            <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang" min="1" required>
        </div>

        <div class="mb-3">
            <label for="tipe_transaksi" class="form-label">Tipe Transaksi</label>
            <select class="form-control" id="tipe_transaksi" name="tipe_transaksi" required>
                <option value="jual">Jual</option>
                <option value="beli">Beli</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
