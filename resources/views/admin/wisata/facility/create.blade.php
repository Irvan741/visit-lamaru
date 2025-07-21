@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h4>Tambah Fasilitas</h4>
    
    <form action="{{ url('/admin/wisata/'.$wisata->id.'/facility/store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="wisata_id" value="{{ $wisata->id }}">

        <div class="mb-3">
            <label for="name" class="form-label">Nama Fasilitas</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="image_path" class="form-label">Gambar</label>
            <input type="file" class="form-control" id="image_path" name="image_path" accept="image/*">
        </div>

        <div class="mb-3">
            <label for="caption" class="form-label">Keterangan</label>
            <textarea class="form-control" id="caption" name="caption" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ url('/admin/wisata/'.$wisata->id.'/facility') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
