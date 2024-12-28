@extends('layouts.main')

@section('page-title', 'Tambah User')

@section('user_active', 'active')

@section('content')
<form action="{{ route('users.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Nama</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Konfirmasi Password</label>
        <input type="password" name="password_confirmation" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Role</label>
        <select name="role" class="form-control" required>
            <option value="admin">Admin</option>
            <option value="karyawan">Karyawan</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection
