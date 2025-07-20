{{-- resources/views/admin/account/permissions/index.blade.php --}}
@extends('admin.layout')

@section('title', 'Daftar Permissions')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Daftar Permissions</h1>
    <div class="card mt-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Permissions</span>
            <a href="{{ route('admin.permissions.create') }}" class="btn btn-sm btn-primary">+ Tambah Permission</a>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama Permission</th>
                        <th>Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($permissions as $permission)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->created_at->diffForHumans() }}</td>
                            <td>
                                <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus permission ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Belum ada data permission.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
