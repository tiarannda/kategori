<!-- resources/views/Akun/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Akun</h2>
    <a href="{{ route('akun.create') }}" class="btn btn-primary mb-3">Tambah Akun</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID User</th>
                <th>Username</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id_user }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <a href="{{ route('akun.edit', $user->id_user) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('akun.destroy', $user->id_user) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus akun ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
