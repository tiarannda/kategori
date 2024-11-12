<!-- resources/views/kategoris/edit.blade.php -->
@extends('layouts.main')

@section('title', 'Edit Kategori')

@section('page-title', 'Edit Kategori')

@section('content')
<div class="container mt-5">
    <h1>Edit Kategori</h1>

    <!-- Success message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

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

    <!-- Form to edit category -->
    <form action="{{ route('kategoris.update', $kategori->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nama Kategori</label>
            <input type="text" name="name" class="form-control" value="{{ $kategori->name }}" placeholder="Masukkan nama kategori" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Update</button>
        <a href="{{ route('kategoris.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </form>
</div>
@endsection
