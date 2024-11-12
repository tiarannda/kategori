<!-- resources/views/Akun/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Akun</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">ID User: {{ $user->id_user }}</h5>
            <p class="card-text"><strong>Username:</strong> {{ $user->username }}</p>
            <p class="card-text"><strong>Role:</strong> {{ $user->role }}</p>
        </div>
    </div>
    <a href="{{ route('akun.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Akun</a>
    <a href="{{ route('akun.edit', $user->id_user) }}" class="btn btn-warning mt-3">Edit Akun</a>
</div>
@endsection
