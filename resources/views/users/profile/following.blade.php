@extends('layouts.app')

@section('following', 'Following Profile')
@section('content')
    {{-- profile header --}}
    @include('users.profile.header')

    {{-- following list --}}

    <div class="container align-center ">
        <h3 class="text-secondary text-center">Following</h3>
        <div class="row justify-content-center">
            <div class="col-4">
                {{-- {{dd($user->followings)}} --}}
                @forelse ($user->followings as $following)
                    {{-- {{ $following->following->avatar}} --}}
                    <div class="row justify-content-center">
                        <div class="col-auto">
                            @if ($following->following->avatar)
                                <img src="{{ $following->following->avatar }}" alt="{{ $following->following->name }}"
                                    class="img-thumbnail rounded-circle d-block mx-auto avatar-sm">
                            @else
                                <i class="fa-solid fa-circle-user text-secondary d-block text-center icon-sm"></i>
                            @endif
                        </div>
                        <div class="col ">
                            <p class=" mb-0">{{ $following->following->name }}</p>
                        </div>
                        <div class=" col-auto text-end">
                            {{-- check if user follow the person --}}
                            @if ($following->following->isfollowed())
                                {{-- unfollow btn --}}
                                <form action="{{ route('follow.destroy', $following->following->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-primary btn-sm fw-bold">Unfollow</button>
                                </form>
                            @elseif($following->following->id === Auth::user()->id)
                            @else
                                {{-- follow btn --}}
                                <form action="{{ route('follow.store', $following->following->id) }}" method="post">
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
