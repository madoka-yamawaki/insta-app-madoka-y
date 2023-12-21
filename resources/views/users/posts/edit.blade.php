@extends('layouts.app')

@section('title', 'Edit Post')
@section('content')
    {{-- {{dd($selected_categories)}} --}}

    <div class="container">
        <form action="{{route('post.update',$post->id)}}" method='post' enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                {{-- {{dd($all_categories)}} --}}
                <label class="form-label fw-bold d-block">Category <span class="text-muted fw-normal">(up to 3)</span></label>

                @foreach ($all_categories as $category)
                    <div class="form-check form-check-inline">
                        {{-- {{ dd($selected_categories)}} --}}
                        {{-- @if ($category->id === $selected_categories[0])

                            <input type="checkbox" id="{{ $category->name }}" name="category[]" value="{{ $category->id }}"
                            class="form-check-input" checked>

                        @elseif($category->id === $selected_categories[1])

                            <input type="checkbox" id="{{ $category->name }}" name="category[]" value="{{ $category->id }}"
                            class="form-check-input" checked>

                        @elseif($category->id === $selected_categories[2])

                            <input type="checkbox" id="{{ $category->name }}" name="category[]" value="{{ $category->id }}"
                            class="form-check-input" checked>

                        @else()

                            <input type="checkbox" id="{{ $category->name }}" name="category[]" value="{{ $category->id }}"
                            class="form-check-input" >

                        @endif --}}

                        @if (in_array($category->id, $selected_categories))
                            <input type="checkbox" id="{{ $category->name }}" name="category[]" value="{{ $category->id }}"
                                class="form-check-input" checked>
                        @else
                            <input type="checkbox" id="{{ $category->name }}" name="category[]" value="{{ $category->id }}"
                                class="form-check-input">
                        @endif

                        {{-- in_array(a,b) --}}
                            {{-- in_array() it will check if value a is inside value b (array) --}}

                            {{-- a = value you want to check --}}
                           {{-- b = array that you want to see if a is inside  --}}



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
                <textarea name="description" id="description" rows="3" class="form-control"
                   >{{ old('description',$post->description) }}</textarea>
                @error('description')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <div class="col p-0 border-end">
                    <img src="{{ $post->image }}" alt="{{ $post->id }}" class="w-100">
                </div>
                <label for="image" class="form-label fw-bold">Image</label>

                <input type="file" class="form-control " name="image" id="image" aria-describedby="image-info">
                <div class="form-text" id="image-info">
                    The acceptable formats are jpeg.jpg.png.and gif only.<br>
                    Max file size is 1048kb.
                </div>
                @error('image')
                    <div class="small text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-warning px-5">Save</button>
        </form>

    </div>

    </div>

@endsection
