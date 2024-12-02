@extends('layouts.main')

@section('content')
<h1>Edit User</h1>
<form action="{{ route('users.update', $user) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>Nama</label>
        <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" value="{{ $user->username }}" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Password (Opsional)</label>
        <input type="password" name="password" class="form-control">
    </div>
    <div class="form-group">
        <label>Konfirmasi Password</label>
        <input type="password" name="password_confirmation" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Perbarui</button>
</form>
@endsection
