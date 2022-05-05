<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title style="">Curhatku</title>

        <!-- Scripts -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <script type="text/javascript">
            const urlParams = new URLSearchParams(window.location.search);
            if(urlParams.has('login')){
                $(window).on('load', function() {
                    $('#loginModal').modal('show');
                });
            }
        </script>

        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Inter" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lobster+Two" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/curhat.css') }}" rel="stylesheet">
        {{-- <link href="{{ asset('storage/asset/IKukku.png') }}" rel="icon"> --}}
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item dropdown MenuDropDown" style="margin-right: 20px;">
                                <a id="navbarDropdown"
                                    class="nav-link navbar-toggler-icon"
                                    href="#"
                                    role="button"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    v-pre> </a>
                                <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                                    {{-- <a href="{{ url('/') }}">
                                        <img class="img-fluid" src="{{asset('storage/asset/IKukkuLogo.jpg')}}">
                                    </a> --}}

                                    <a class="dropdown-item" href="{{ route('TulisCurhat') }}">+ Tulis Curhat</a>

                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="navbar-brand mb-0 h1" href="{{ url('/') }}" style="color: #ff6f3d;margin-top: -5px;">
                                    <b>
                                        Curhatku
                                    </b>
                                </a>
                            </li>
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">
                            {{-- <div class="container-fluid" style="margin-top: 10px;">
                                <form action="/search" method="GET" class="d-flex">
                                    <input class="form-control me-2"
                                        type="text"
                                        name="search"
                                        placeholder="Search"
                                        aria-label="Search">
                                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                                </form>
                            </div> --}}

                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item" style="margin-top: 10px;">
                                    <a class="nav-link"
                                        style="cursor: pointer"
                                        data-bs-toggle="modal"
                                        data-bs-target="#loginModal">{{ __('Login') }}</a>
                                </li>
                            @else
                                <li class="nav-item dropdown" style="margin-top: 10px;">

                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                        <a class="dropdown-item" href="{{ route('Profile') }}">Profile</a>

                                        {{-- <a class="dropdown-item"
                                            data-bs-toggle="modal"
                                            data-bs-target="#gantiPassword">Ganti Password</a> --}}
                                        
                                        <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>

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
        @yield('scripts')
    </body>
</html>

<style>

    @media only screen and (max-width: 800px) {
        .MenuDropDown{
            visibility: hidden;
        }
    }

</style>

@guest
    @include('partials.login')
    @include('partials.register')
@endguest