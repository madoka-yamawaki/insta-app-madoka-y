@extends('layouts.app')

@section('title', 'Admin: Posts')
@section('content')
    <table class="table table-hovor align-middle bg-white border text-secondary">
        <thead class="small table-primary text-secondary">
            <tr>
                <th></th>
                <th>CATEGORY</th>
                <th>OWNER</th>
                <th>CREATED AT</th>
                <th>STATUS</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($all_posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td><a href="{{ route('post.show', $post->id) }}">
                            <img src="{{ $post->image }}" alt="" class="d-block mx-auto image-lg"></a></td>
                    <td>
                        @foreach ($post->categoryPost as $category_post)
                            <span class="badge bg-secondary bg-opacity-50">{{ $category_post->category->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('profile.show', $post->user->id) }}"
                            class="text-decoration-none text-dark">{{ $post->user->name }}</a>
                    </td>
                    <td>
                        @if ($post->trashed())
                            {{-- check if user is softdeleted --}}
                            <i class="fa-solid fa-circle-minus text-secondary me-1"></i>Hidden
                        @else
                            <i class="fa-solid fa-circle text-primary me-1"></i>Visible
                        @endif
                    </td>
                    <td>

                        <div class="dropdown">
                            <button class="btn btn-sm" data-bs-toggle="dropdown">
                                <i class="fa-solid fa-ellipsis"></i>
                            </button>
                            <div class="dropdown-menu">
                                @if ($post->trashed())
                                    <button class="dropdown-item text-success" data-bs-toggle="modal"
                                        data-bs-target="#unhide-post-{{ $post->id }}"><i
                                            class="fa-solid fa-user-check me-1"></i>Unhide{{ $post->id }}</button>
                                @else
                                    <button class="dropdown-item text-danger" data-bs-toggle="modal"
                                        data-bs-target="#hide-post-{{ $post->id }}"><i
                                            class="fa-solid fa-eyes-slash me-1"></i>Hide{{ $post->id }}</button>
                                @endif

                            </div>
                        </div>

                        {{-- modals --}}
                        @include('admin.posts.modal.status')

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $all_posts->links() }}
    </div>

@endsection
