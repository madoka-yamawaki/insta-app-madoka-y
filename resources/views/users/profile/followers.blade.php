@extends('layouts.app')

@section('followiers', 'Followers Profile')
@section('content')
    {{-- profile header --}}
    @include('users.profile.header')

    {{-- followers list --}}

    <div class="container align-items-center ">
        <h3 class="text-secondary text-center">Followers</h3>
        <div class="row justify-content-center">
            <div class="col-4">
                    {{-- {{dd($user->followers->followers)}} --}}
                    @forelse ($user->followers as $follower)
                        {{-- {{ $following->following->avatar}} --}}
                            <div class="row justify-content-center">
                                <div class="col-auto">
                                    @if ($follower->follower->avatar)
                                        <img src="{{ $follower->follower->avatar }}" alt="{{ $follower->follower->name }}"
                                            class="img-thumbnail rounded-circle d-block mx-auto avatar-sm">
                                    @else
                                        <i class="fa-solid fa-circle-user text-secondary d-block text-center icon-sm"></i>
                                    @endif
                                </div>
                                <div class="col">
                                    <p class=" mb-0">{{ $follower->follower->name }}</p>
                                </div>
                                <div class="col-auto text-end">
                                    {{-- check if user follow the person --}}
                                    @if ($follower->follower->isfollowed())
                                        {{-- unfollow btn --}}
                                        <form action="{{ route('follow.destroy', $follower->follower->id) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-primary btn-sm fw-bold">Unfollow</button>
                                        </form>
                                    @elseif($follower->follower->id === Auth::user()->id)
                                    @else
                                        {{-- follow btn --}}
                                        <form action="{{ route('follow.store', $follower->follower->id) }}" method="post">
                                            @csrf
                                            <button class="btn btn-primary btn-sm fw-bold">Follow</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                    @empty
                        <h4 class="text-center">No Followings Yet</h4>
                    @endforelse
            </div>
        </div>
    </div>


@endsection
