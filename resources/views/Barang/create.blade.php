<!-- resources/views/barang/create.blade.php -->
@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <h1>Tambah Barang</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('barang.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" value="{{ old('nama_barang') }}" required>
        </div>
        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="number" name="harga" class="form-control" value="{{ old('harga') }}" required>
        </div>
        <div class="form-group">
            <label for="stok_saat_ini">Stok Saat Ini</label>
            <input type="number" name="stok_saat_ini" class="form-control" value="{{ old('stok_saat_ini') }}" required>
        </div>
        <div class="form-group">
            <label for="id">Kategori</label>
            <select name="id" class="form-control" required>
                <option value="">Pilih Kategori</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
