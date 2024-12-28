@extends('layouts.main')

@section('page-title', 'Detail Akun')

@section('user_active', 'active')

@section('content')
<div class="container">
    <!-- Tampilkan data diri jika yang login adalah karyawan -->
    @if (Auth::user()->role == 'karyawan' && Auth::user()->id_user == $user->id_user)
        <p><strong>Nama:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Username:</strong> {{ $user->username }}</p>
    @elseif (Auth::user()->role == 'admin')
        <!-- Admin bisa melihat detail akun siapapun -->
        <h3>Detail Akun</h3>
        <p><strong>Nama:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Username:</strong> {{ $user->username }}</p>
        <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">Edit</a>

        <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus akun ini?')">Hapus</button>
        </form>
    @endif
</div>
@endsection
