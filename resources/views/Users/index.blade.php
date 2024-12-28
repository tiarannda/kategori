@extends('layouts.main')

@section('page-title', 'Data Akun')

@section('user_active', 'active')

@section('content')
<div class="container">
    <!-- Tombol Tambah Akun hanya untuk admin -->
    @if (Auth::user()->role == 'admin')
        <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Tambah Akun</a>
    @endif

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
                @if (Auth::user()->role == 'admin' || Auth::user()->id_user == $user->id_user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->username }}</td>
                        <td>
                            <!-- Lihat hanya untuk admin dan akun yang sedang login -->
                            <a href="{{ route('users.show', $user) }}" class="btn btn-info">Lihat</a>

                            <!-- Tombol Hapus dan Edit hanya untuk admin -->
                            @if (Auth::user()->role == 'admin' && Auth::user()->id_user != $user->id_user)
                                <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                 
                                </form>
                            @endif
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
@endsection
