@extends('layouts.app')

@section('title','profile')
@section('content')
    {{--profile header--}}
    @include('users.profile.header')

    {{--all post later--}}
    <div style="margin-top:100px">
        @if ($user->posts->isNotEmpty())
            <div class="row">
                @foreach ($user->posts as $post)
                    <div class="col-4">
                        <a href="{{route('post.show',$post->id)}}">
                        <img src="{{$post->image}}" alt="{{$post->id}}" class="grid-img"></a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

@endsection
