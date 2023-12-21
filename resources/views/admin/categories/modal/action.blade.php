<div class="modal fade" id="delete-category-{{ $category->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h3 class="h5 modal-title text-danger">
                    <i class="fa-solid fa-eye-slash me-1"></i>Delete Category
                </h3>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <span class="fw-bold">{{ $category->name }}</span> category?</p>
                <p class="fw-light">This action will affect all the post under this category. Post without a category
                    will fall under Uncategorized.</p>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-category-{{ $category->id }}">
    <div class="modal-dialog">
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="modal-content border-warning">
                <div class="modal-header border-waning">
                    <h3 class="h5 modal-title">
                        <i class="fa-regular fa-pen-to-square me-1"></i>Edit Category
                    </h3>
                </div>
                <div class="modal-body">
                    <input type="text" name="new_name" class="form-control" placeholder="Category Name"
                        value="{{ $category->name }}">
                </div>
                <div class="modal-footer border-0">
                    <button type="button" data-bs-dismiss="modal" class="btn btn-outline-warning btn-sm">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-warning btn-sm">
                        Update</i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
