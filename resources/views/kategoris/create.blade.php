<!-- resources/views/kategoris/create.blade.php -->
@extends('layouts.main')

@section('title', 'Tambah Kategori')



@section('content')
<div class="container mt-5">
    <h1>Tambah Kategori</h1>

    <!-- Error messages -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form to add category -->
    <form action="{{ route('kategoris.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nama Kategori</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Masukkan nama kategori" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        <a href="{{ route('kategoris.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </form>
</div>
@endsection
