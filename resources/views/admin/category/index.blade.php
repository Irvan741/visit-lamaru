@extends('admin.layout')

@section('title', 'Category List')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">🗂️ Category List</h3>
        <a href="{{ url('/admin/category/create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Add Category</a>
    </div>

    @if (session('flash_notification'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('flash_notification')->first()->message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th style="width: 60px;">#</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th style="width: 160px;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $index => $category)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->slug }}</td>
                    <td>
                        <a href="{{ url('/admin/category/'.$category->id.'/edit') }}" class="btn btn-sm btn-warning">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                        <button class="btn btn-sm btn-danger" onclick="confirmDelete({{ $category->id }})">
                            <i class="fa fa-trash"></i> Delete
                        </button>
                        <form id="delete-form-{{ $category->id }}" action="{{ url('/admin/category/'.$category->id.'/delete') }}" method="POST" class="d-none">
                            @csrf
                            @method("DELETE")
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">No categories found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function confirmDelete(id) {
        if (confirm('Are you sure you want to delete this category?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>
@endpush
