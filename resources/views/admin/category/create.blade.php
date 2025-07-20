@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Tambah Kategori</h2>

    <form action="{{ url('/admin/category/store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Kategori</label>
            <input type="text" class="form-control" id="name" name="name" required placeholder="Masukkan nama kategori">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ url('/admin/category') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
