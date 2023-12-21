@extends('layouts.app')

@section('title', 'Home')
@section('content')

    <div class="row gx-5">
        <div class="col-8 ">
            @forelse ($all_posts as $post)
                <div class="card mb-4">
                    {{-- title --}}
                    @include('users.posts.contents.title')
                    {{-- body --}}
                    @include('users.posts.contents.body')
                </div>
            @empty
                {{-- if the site don't have amu posts yet --}}
                <div class="text-center">
                    <h2>Share Photo</h2>
                    <p class="text-muted">
                        When you share photos.They'll appear on your profile
                    </p>
                    <a href="{{ route('post.create') }}" class="text-decoration-none">
                        Share your first photo.
                    </a>
                </div>
            @endforelse
        </div>
        <div class="col ">
            <div class="row align-imte-center mb-5 bg-white shadow-sm rounded-3">
                <div class="col-auto">
                    <a href="{{ route('profile.show', Auth::user()->id) }}">
                        @if (Auth::user()->avatar)
                            <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->avatar }}"
                                class="rounded-circle acatar-md">
                        @else
                            <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                        @endif
                    </a>
                </div>
                <div class="col ps-0">
                    <a href="{{ route('profile.show', Auth::user()->id) }}"
                        class="text-decoration-none text-dark fw-bold">{{ Auth::user()->name }}</a>
                    <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
                </div>
            </div>

            {{-- SUGGESTIONS --}}
            <div class="row">
                <div class="col-auto">
                    <p class="fw-bold text-secondary">Suggestions For you</p>
                </div>
                <div class="col text-end">
                    <a href="#" class="fw-bold text-dark text-decoration-none">See all</a>
                </div>
            </div>
            @foreach (array_slice($suggestedUsers, 0, 5) as $user)
                {{-- array_slice(a,b,c)
                a - array
                b - starting index
                c - length --}}
                <div class="row align-items-center mb-3">
                    <div class="col-auto">
                        <a href="{{ route('profile.show', $user->id) }}">
                            @if ( $user->avatar)
                                <img src="{{ $user->avatar }}" alt="{{  $user->avatar }}"
                                    class="rounded-circle avatar-md">
                            @else
                                <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                            @endif
                        </a>
                    </div>
                    <div class="col ps-0 text-truncate">
                        <a href="{{ route('profile.show',  $user->id) }}"
                            class="text-decoration-none text-dark fw-bold">{{  $user->name }}</a>
                    </div>
                    <div class="col-auto">
                        <form action="{{ route('follow.store', $user->id) }}" method="POST">
                            @csrf
                            <button class="border-0 bg-transparent o-0 text-primary btn-sm">Follow</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
