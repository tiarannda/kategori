<!-- resources/views/kategoris/index.blade.php -->
@extends('layouts.main')

@section('title', 'iCare Service - Data Kategori')

@section('page-title', 'Data Kategori')

@section('kategori_active', 'active')

@section('content')
    <h1>Data Kategori</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3">
        <a href="{{ route('kategoris.create') }}" class="btn btn-primary">Tambah Kategori</a>
    </div>

    <table class="table">
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
@endsection
