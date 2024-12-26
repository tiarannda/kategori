<!-- resources/views/Akun/show.blade.php -->
@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Detail Akun</h2>

    <!-- Card untuk menampilkan informasi akun -->
    <div class="card">
        <div class="card-header">
            <h4>Informasi Pengguna</h4>
        </div>
        <div class="card-body">
            <h5 class="card-title">ID User: {{ $user->id_user }}</h5>

            <div class="row">
                <div class="col-md-6">
                    <p class="card-text"><strong>Username:</strong> {{ $user->username }}</p>
                    <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
                    <p class="card-text"><strong>Role:</strong> {{ $user->role }}</p>
                </div>

            </div>
        </div>
    </div>

    <!-- Tombol untuk kembali dan edit akun -->
    <div class="mt-3">
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali ke Daftar Akun</a>
    
    </div>
</div>
@endsection
