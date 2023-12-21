@extends('layouts.app')

@section('title', 'Show Post')
@section('content')
<style>
    .col-4{
        overflow-y:scroll;
    }
    .card-body{
        position:absolute;
        top:65px;
    }
</style>

    <div class="row border shadow">
        <div class="col p-0 border-end">
            <img src="{{ $post->image }}" alt="{{ $post->id }}" class="w-100">
        </div>
        <div class="col-4 px-0 bg-white">
            <div class="card border-0">
                <div class="card-header bg-white py-3">
                    <div class="row align-items center">
                        <div class="col-auto">
                            <a href="{{route('profile.show',$post->user->id)}}">
                                @if ($post->user->avatar)
                                    <img src="{{ $post->user->avatar }}" alt="{{ $post->user->name }}"
                                        class="rouded-circle avatar-sm">
                                @else
                                    <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                @endif
                            </a>
                        </div>
                        <div class="col ps-0">
                            <a href="{{route('profile.show',$post->user->id)}}" class="text-decoration-none text-dark">
                                {{ $post->user->name }}
                            </a>
                        </div>
                        <div class="col-auto">
                            @if (Auth::user()->id === $post->user->id)
                                <div class="dropdown">
                                    <button class="btn btn-sm shadow-none" data-bs-toggle="dropdown">
                                        <i class="fa-solid fa-ellipsis"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="{{route('post.edit',$post->id)}}" class="dropdown-item">
                                            <i class="fa-solid fa-pen-to-square me-1"></i>Edit
                                        </a>
                                        <button class="dropdown-item text-danger" data-bs-toggle="modal"
                                            data-bs-target="#delete-post-{{ $post->id }}">
                                            <i class="fa-regular fa-trash-can me-1"></i>Delete
                                        </button>
                                    </div>
                                    {{-- modal later --}}
                                    @include('users.posts.contents.modals.delete')
                                </div>
                            @else
                                <form action="#" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">Follow</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body w-100">
                    {{-- hert btn + no.of likes + categories --}}
                    <div class="row align-items-center">
                        <div class="col-auto">
            {{--check if user liked the post--}}
            @if ($post->isliked())
                {{--unlike btn--}}
                <form action="{{route('like.destroy',$post->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm shadow-none p-0">
                    <i class="fa-solid fa-heart text-danger"></i>
                </button>
            </form>
            @else
                {{--like btn--}}
                <form action="{{route('like.store',$post->id)}}" method="post">
                    @csrf
                    <button class="btn btn-sm shadow-none p-0">
                        <i class="fa-regular fa-heart"></i>
                    </button>
                </form>
            @endif
                        </div>
                        <div class="col-auto px-0">
                            <span>
                                  {{--count of likes--}}
                                 {{ $post->likes->count() }}
                            </span>
                        </div>
                        <div class="col text-end">
                            @forelse ($post->categoryPost as $category_post)
                                <div class="badge bg-secondary bg-opacity-50">
                                    {{ $category_post->category->name }}
                                </div>
                            @empty
                                <div class="badge bg-dark bg-opacity-50">Uncatagorized</div>
                            @endforelse
                        </div>
                    </div>

                    {{-- owner + description --}}
                    <a href="" class="text-decoration-none text-dark fw-bold">{{ $post->user->name }}</a>
                    &nbsp;
                    <p class="d-inline fw-light">{{ $post->description}}</p>
                    <p class="text-upprtcase text-muted xsmall">{{ date('M d,y', strtotime($post->created_at)) }}</p>
                    {{-- comments later --}}

                    @include('users.posts.contents.comment')
                </div>
            </div>
        </div>
    </div>
@endsection
