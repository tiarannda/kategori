@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Tambah Laporan</h1>
    <form action="{{ route('laporans.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="tanggal_laporan">Tanggal Laporan</label>
            <input type="date" name="tanggal_laporan" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
