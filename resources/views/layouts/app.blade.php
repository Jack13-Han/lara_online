<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @auth
                        <li class="nav-item">
                            <x-nav-link route-name="{{route('home')}}">Home</x-nav-link>
                        </li>

                        <li class="nav-item dropdown">
                            <x-nav-link route-name="{{route('post.create')}}">Post Create</x-nav-link>
{{--                            <x-nav-link route-name="post.create">Post Create</x-nav-link>--}}
{{--                            <x-nav-link route-name="post.index">Post List</x-nav-link>--}}


{{--                            <a class="nav-link dropdown-toggle {{route('post.create') == request()->url()? 'active':'' }} {{route('post.index') == request()->url()? 'active':'' }}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                                Post--}}
{{--                            </a>--}}
{{--                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">--}}
{{--                                <li><a class="dropdown-item" href="{{route('post.create')}}">Create Post</a></li>--}}
{{--                                <li><a class="dropdown-item" href="{{route('post.index')}}">Posts List</a></li>--}}
{{--                                <li><hr class="dropdown-divider"></li>--}}
{{--                                <li><a class="dropdown-item" href="#">Something else here</a></li>--}}
{{--                            </ul>--}}
                        </li>
                        <li class="nav-item">
                            <x-nav-link route-name="{{route('post.index')}}">Post List</x-nav-link>
                        </li>



                       @onlyAdmin
                        <li class="nav-item">
                            <x-nav-link route-name="{{route('category.create')}}">Category Create</x-nav-link>
                        </li>

                        <li class="nav-item">
                            <x-nav-link route-name="{{route('category.index')}}">Category List</x-nav-link>
                        </li>
                           @endonlyAdmin


{{--                        <li class="nav-item dropdown">--}}
{{--                            <a class="nav-link dropdown-toggle {{route('category.create') == request()->url()? 'active':'' }} {{route('category.index') == request()->url()? 'active':'' }}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                                Category--}}
{{--                            </a>--}}
{{--                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">--}}
{{--                                <li><a class="dropdown-item" href="{{route('category.create')}}">Create Category</a></li>--}}
{{--                                <li><a class="dropdown-item" href="{{route('category.index')}}">Category List</a></li>--}}
{{--                                <li><hr class="dropdown-divider"></li>--}}
{{--                                <li><a class="dropdown-item" href="#">Something else here</a></li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}

                            <li class="nav-item">
                                <x-nav-link route-name="{{route('photo.index')}}">My Photo Gallery</x-nav-link>
{{--                                <a class="nav-link {{route('photo.index') == request()->url()? 'active':'' }}" aria-current="page" href="{{route('photo.index')}}">My Photo Gallery</a>--}}
                            </li>
                        @endauth
                    </ul>

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
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        new VenoBox({
            selector: '.venobox',
        });
    </script>
</body>
</html>
