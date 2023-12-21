<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}|</title> @yield('title')</title>

    {{-- <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet"> --}}

    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- custom css --}}
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    {{-- search bar SOON --}}
                    @auth
                     @if (!request()->is('admin/*'))
                        <ul class="navbar-nav ms-auto">
                            <form action="{{route('search')}}" style="width:300px">
                            <input type="search" class="form-control form-control-sm" placeholder="Search..." name="search">
                            </form>
                        </ul>
                     @endif
                    @endauth


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            {{-- home --}}
                            <li class="nav-item">
                                <a href="{{ route('index') }}" class="nav-link">
                                    <i class="fa-solid fa-house text-dark icon-sm"></i>
                                </a>
                            </li>

                            {{-- create post --}}
                            <li class="nav-item">
                                <a href="{{route('post.create')}}" class="nav-link">
                                    <i class="fa-solid fa-circle-plus text-dark icon-sm"></i>
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="account-dropdown" class="nav-link" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @if (Auth::user()->avatar)
                                        <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}"
                                            class="rounded-circle avatar-sm">
                                    @else
                                        <i class="fa-solid fa-circle-user text-dark icon-sm"></i>
                                    @endif
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="account-dropdown">
                                    {{-- admin control Soon --}}
                                    @if (Auth::user()->role_id == 1)
                                    <a href="{{route('admin.users.index')}}" class="dropdown-item">
                                        <i class="fa-solid fa-user-gear me-1"></i>Admin
                                    </a>
                                    @endif

                                    {{-- profile --}}
                                    <a href="{{route('profile.show',Auth::user()->id)}}" class="dropdown-item">
                                        <i class="fa-solid fa-circle-user me-1"></i>Profile
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                                        <i class="fa-solid fa-right-from-bracket-me-1"></i>Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    {{--for admin--}}
                    @if (request()->is('admin/*'))
                        {{--request() = url --}}
                        {{--admin/* = anything follows admin url --}}
                        <div class="col-3">
                            <div class="list-group">
                                <a href="{{route('admin.users.index')}}" class="list-group-item {{request()->is('admin/users')? 'active': ''}}">
                                    <i class="fa-solid fa-users me-1"></i>Users
                                </a>
                                <a href="{{route('admin.posts.index')}}" class="list-group-item {{request()->is('admin/posts')? 'active': ''}}">
                                    <i class="fa-solid fa-newspaper me-1"></i>Posts
                                </a>
                                <a href="{{route('admin.categories.index')}}" class="list-group-item {{request()->is('admin/categories')? 'active': ''}}">
                                    <i class="fa-solid fa-tags me-1"></i>Cateories
                                </a>
                            </div>
                        </div>
                    @endif

                    <div class="col-9">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
