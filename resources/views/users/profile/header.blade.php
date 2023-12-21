<div class="row">
    <div class="col-4">
        @if ($user->avatar)
            <img src="{{ $user->avatar }}" alt="{{ $user->name }}"
                class="img-thumbnail rounded-circle d-block mx-auto avatar-lg">
        @else
            <i class="fa-solid fa-circle-user text-secondary d-block text-center icon-lg"></i>
        @endif
    </div>
    <div class="col">
        <div class="row mb-3">
            <div class="col-auto">
                <h2 class="display-6 mb-0">{{ $user->name }}</h2>
            </div>
            <div class="col-auto p-2">
                @if (Auth::user()->id === $user->id)
                    <a href="{{ route('profile.edit', $user->id) }}"
                        class="btn btn-outline-secondary btn-sm fw-bold">Edit profile
                    </a>
                @else
                    @csrf
                    {{-- check if user follow the person --}}
                    @if ($user->isfollowed())
                        {{-- unfollow btn --}}
                        <form action="{{ route('follow.destroy', $user->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-primary btn-sm fw-bold">Unfollow</button>
                        </form>
                    @else
                        {{-- follow btn --}}
                        <form action="{{ route('follow.store', $user->id) }}" method="post">
                            @csrf
                            <button class="btn btn-primary btn-sm fw-bold">Follow</button>
                        </form>
                    @endif
                @endif
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-auto">
                <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-dark"><Strong
                        class="me-1">{{ $user->posts->count() }}</Strong>{{ $user->posts->count() > 1 ? 'posts' : 'post' }}</a>
            </div>
            <div class="col-auto">
                <a href="{{route('profile.followers',$user->id)}}" class="text-decoration-none text-dark"><Strong
                        class="me-1">{{ $user->followers->count() }}</Strong>
                    @if ($user->followers->count() <= 1)
                        follower
                    @else
                        followers
                    @endif
                </a>
                {{-- <a href="#" class="text-decoration-none text-dark"><Strong
                        class="me-1">{{ $user->followers->count() }}
                    </Strong>{{ $user->followers->count() > 1 ? 'followers' : 'follower' }} </a> --}}

            </div>
            <div class="col-auto">
                {{-- @if ($user->following <= 1)
                    <a href="#" class="text-decoration-none text-dark"><strong class="me-1">{{$user->followings->count()}}</strong>following</a>
                @else
                    <a href="#" class="text-decoration-none text-dark"><strong class="me-1">{{$user->followings->count()}}</strong>followings</a>
                @endif --}}
                <a href="{{route('profile.following',$user->id)}}" class="text-decoration-none text-dark"><strong
                        class="me-1">{{ $user->followings->count() }} </strong>
                    {{ $user->followings->count() > 1 ? 'followings' : 'following' }}</a>
            </div>
        </div>
        <p class="fw-bold">{{ $user->introduction }}</p>
    </div>
</div>
