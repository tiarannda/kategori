@extends('layouts.main')

@section('page-title', 'Edit User')

@section('user_active', 'active')

@section('content')
<form action="{{ route('users.update', $user->id_user) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')<!-- Method spoofing to simulate PUT request for update -->

    <div class="form-group">
        <label>Nama</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
    </div>

    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
    </div>

    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" class="form-control" value="{{ old('username', $user->username) }}" required>
    </div>

    <div class="form-group">
        <label>Password (Kosongkan jika tidak ingin mengganti)</label>
        <input type="password" name="password" class="form-control">
    </div>

    <div class="form-group">
        <label>Konfirmasi Password</label>
        <input type="password" name="password_confirmation" class="form-control">
    </div>

    <div class="form-group">
        <label>Role</label>
        <select name="role" class="form-control" required>
            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="karyawan" {{ old('role', $user->role) == 'karyawan' ? 'selected' : '' }}>Karyawan</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
