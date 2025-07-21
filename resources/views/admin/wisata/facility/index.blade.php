@extends('admin.layout') {{-- Sesuaikan dengan layout yang kamu pakai --}}

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Daftar Fasilitas</h4>
        <a href="{{ url('/admin/facility/create') }}" class="btn btn-primary">+ Tambah Fasilitas</a>
    </div>

    @if($datas->isEmpty())
        <div class="alert alert-info">Belum ada fasilitas.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Gambar</th>
                        <th>Caption</th>
                        <th>ID Wisata</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($datas as $index => $facility)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $facility->name }}</td>
                            <td>
                                @if($facility->image_path)
                                    <img src="{{ asset('storage/' . $facility->image_path) }}" alt="Gambar" width="100">
                                @else
                                    <span class="text-muted">Tidak ada gambar</span>
                                @endif
                            </td>
                            <td>{{ $facility->caption }}</td>
                            <td>{{ $facility->wisata_id }}</td>
                            <td>
                                <a href="{{ url('/admin/facility/' . $facility->id . '/edit') }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ url('/admin/facility/' . $facility->id . '/delete') }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
