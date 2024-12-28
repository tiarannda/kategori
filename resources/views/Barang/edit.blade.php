@extends('layouts.main')

@section('page-title', 'Edit Data Barang')

@section('kategori_active', 'active')

@section('content')
<div class="container mt-5">
    <!-- Menampilkan error jika ada -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form untuk mengedit barang -->
    <form action="{{ route('barang.update', $barang->id_barang) }}" method="POST"> <!-- Pastikan id_barang digunakan -->
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" value="{{ old('nama_barang', $barang->nama_barang) }}" required>
        </div>

        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="number" name="harga" class="form-control" value="{{ old('harga', $barang->harga) }}" required>
        </div>

        <div class="form-group">
            <label for="stok_saat_ini">Stok Saat Ini</label>
            <input type="number" name="stok_saat_ini" class="form-control" value="{{ old('stok_saat_ini', $barang->stok_saat_ini) }}" required>
        </div>

        <div class="form-group">
            <label for="id">Kategori</label>
            <select name="id" class="form-control" required>
                <option value="">Pilih Kategori</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ $barang->id == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Perbarui</button>
    </form>
</div>
@endsection
