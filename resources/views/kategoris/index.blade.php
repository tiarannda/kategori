@extends('layouts.main')

@section('title', 'iCare Service - Data Kategori')

@section('page-title', 'Data Kategori')

@section('kategori_active', 'active')

@section('content')
<div class="container">
    <!-- Tombol Tambah Kategori -->
    <div class="d-flex justify-content-between align-items-center mt-4">
        <a href="{{ route('kategoris.create') }}" class="btn btn-primary">Tambah Kategori</a>
    </div>

    <!-- Pesan Sukses -->
    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabel Data Kategori -->
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Nama Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kategoris as $kategori)
                <tr>
                    <td>{{ $kategori->name }}</td>
                    <td>
                        <!-- Tombol Aksi -->
                        <a href="{{ route('kategoris.edit', $kategori->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('kategoris.destroy', $kategori->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
