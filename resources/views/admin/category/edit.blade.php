@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Kategori</h2>

    <form action="{{ url('/admin/category/' . $category->id .'/update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nama Kategori</label>
            <input type="text" class="form-control" id="name" name="name" required value="{{ $category->name }}">
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ url('/admin/category') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
