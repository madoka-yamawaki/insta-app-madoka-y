@extends('layouts.app')

@section('title', 'Create Post')
@section('content')

    <div class="container">
        <form action="{{ route('post.store') }}" method='post' enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                {{-- {{dd($all_categories)}} --}}
                <label class="form-label fw-bold d-block">Category <span class="text-muted fw-normal">(up to 3)</span></label>

                @foreach ($all_categories as $category)
                    <div class="form-check form-check-inline">
                        <input type="checkbox" id="{{ $category->name }}" name="category[]" value="{{ $category->id }}"
                            class="form-check-input">
                        <label for="{{ route('post.create', $category->id) }}"
                            class="form-check-label">{{ $category->name }}</label>
                    </div>
                @endforeach
            </div>
            @error('category')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
            <br>
            <div class="mb-3">
                <label for="description" class="form-label fw-bold">Description</label>
                <textarea name="description" id="description" rows="3" class="form-control" placeholder="What's on your mind">{{ old('description','Write here...') }}</textarea>
                @error('description')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <input type="file" class="form-control " name="image" id="image" aria-describedby="image-info">
                <div class="form-text" id="image-info">
                    The acceptable formats are jpeg.jpg.png.and gif only.<br>
                    Max file size is 1048kb.
                </div>
                @error('image')
                    <div class="small text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary px-5">Post</button>
        </form>

    </div>

    </div>

@endsection
