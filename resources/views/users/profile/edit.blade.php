@extends('layouts.app')

@section('edit', 'Edit Profile')
@section('content')
    <div class="row justify-content-center">
        <div class="col-8">
            <form action="{{route('profile.update',$user->id)}}" method="POST" enctype="multipart/form-data" class="bg-white shadow rounded-3 p-5">
                @csrf
                @method('PATCH')
                <h2 class="h3 mb-3 fw-light">Update Profile</h2>

                <div class="row mb-3">
                    <div class="col-4">
                        @if ($user->avatar)
                            <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="rouded-circle d-block mx-auto avatar-lg">
                        @else
                            <i class="fa-solid fa-circle-user text-secondary d-block text-center icon-lg"></i>
                        @endif
                    </div>
                    <div class="col-auto align-self-end">
                        <input type="file" class="form-control form-select-sm mt-1 " name="avatar" id="avatar"
                            aria-describedby="avatar-info">
                        <div class="form-text" id="abvatar-info">
                            The acceptable formats are jpeg.jpg.png.and gif only.<br>
                            Max file size is 1048kb.
                        </div>
                        @error('avatar')
                            <div class="small text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control"
                        value="{{ old('name', $user->name) }}">
                    @error('name')
                        <div class="text-danger xsmall">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" name="email" id="email" class="form-control"
                        value="{{ old('email', $user->email) }}">
                    @error('email')
                    <div class="text-danger xsmall">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="introduction" class="form-label">Introduction</label>
                    <textarea name="introduction" id="introduction" rows="10" class="form-control">{{ old('introduction', $user->introduction) }}</textarea>
                    @error('introduction')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-warning px-5">Save</button>
            </form>
        </div>
    </div>

@endsection
