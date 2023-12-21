@extends('layouts.app')

@section('title', 'Admin: Post')
@section('content')
    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <div class="row gx-2 mb-4">
            <div class="col-4">
                <input type="text" name="name" class="form-control" placeholder="Add a category...">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary ">
                    <i class="fa-solid fa-plus me-1"></i>Add
                </button>
            </div>
            @error('name')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
        </div>
    </form>
    <div class="row">
        <div class="col-12">
            <table class="table table-hoer align-middle bg-white border table-sm">
                <thead class="table-warning small text-secondary">
                    <th>#</th>
                    <th>NAME</th>
                    <th>COUNT</th>
                    <th>LAST UPDATED</th>
                    <th></th>
                </thead>
                <tbody>
                    @forelse ($all_categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td class="text-dark">{{ $category->name }}</td>
                            <td>{{ $category->categoryPost->count() }}</td>
                            <td>{{ $category->updated_at }}</td>
                            <td>
                                <button class="btn btn-outline-warning btn-sm me-2" data-bs-toggle="modal"
                                    data-bs-target="#edit-category-{{ $category->id }}" title="Edit">
                                    <i class="fa-solid fa-pen me-1"></i>
                                </button>

                                <button class="btn btn-outline-danger btn-sm me-2" data-bs-toggle="modal"
                                    data-bs-target="#delete-category-{{ $category->id }}" title="Delete">
                                    <i class="fa-solid fa-trash-can me-1"></i>
                                </button>
                            </td>
                        </tr>
                        @include('admin.categories.modal.action')
                    @empty
                        <td colspan="5" class="lead text-muted text-center">
                            No categories found.
                        </td>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{-- {{ $all_categories->links() }} --}}
@endsection
