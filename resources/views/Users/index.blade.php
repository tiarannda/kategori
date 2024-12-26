@extends('layouts.main')

@section('page-title', 'Data Akun')

@section('user_active', 'active')

@section('content')
<div class="container">
    <!-- Tombol Tambah Akun -->
    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Tambah Akun</a>

    <!-- Tabel Data Akun -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Username</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->username }}</td>
                <td>
                    <a href="{{ route('users.show', $user) }}" class="btn btn-info">Lihat</a>
                 
                    <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
