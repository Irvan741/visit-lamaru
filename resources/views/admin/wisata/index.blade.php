@extends('admin.layout')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Data Wisata</h4>
        <a href="{{ url('/admin/wisata/create') }}" class="btn btn-primary">+ Tambah Wisata</a>
    </div>

    @if(session()->has('flash_notification.message'))
        <div class="alert alert-success">
            {{ session('flash_notification.message') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Slug</th>
                    <th>Alamat</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($datas as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->slug }}</td>
                    <td>{{ $data->address }}</td>
                    <td>{{ $data->latitude }}</td>
                    <td>{{ $data->longtitude }}</td>
                    <td>
                        <a href="{{ url('/admin/wisata/' . $data->id . '/edit') }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ url('/admin/wisata/' . $data->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada data wisata.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
