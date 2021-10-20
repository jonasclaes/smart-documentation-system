<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <!-- Component -->
    <div class="h-screen w-screen flex bg-gray-200">
        <!-- Container -->
        <aside class="flex flex-col items-center bg-white text-gray-700 shadow h-full">
            <!-- Side Nav Bar-->
            <div class="h-16 flex items-center w-full">
                <!-- Logo Section -->
                <a class="h-6 w-6 mx-auto" href="{{ url('/') }}">
                    <img class="h-6 w-6 mx-auto"
                         src="https://www.deltatechnics.be/wp-content/uploads/2017/08/cropped-delta-technics-logo-dark-1.png"
                         alt="Delta Technics"/>
                </a>
            </div>

            <ul>
                <!-- Items Section -->
                <li class="hover:bg-gray-100">
                    <a
                        href="."
                        class="h-16 px-6 flex flex justify-center items-center w-full
					focus:text-orange-500">
                        <outline-cog-icon class="h-6 w-6"/>
                    </a>
                </li>
            </ul>

            <div class="mt-auto h-16 flex items-center w-full">
                <!-- Action Section -->
                {{--                        <!-- Authentication Links -->--}}
                {{--                        @guest--}}
                {{--                            @if (Route::has('login'))--}}
                {{--                                <li class="nav-item">--}}
                {{--                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
                {{--                                </li>--}}
                {{--                            @endif--}}

                {{--                            @if (Route::has('register'))--}}
                {{--                                <li class="nav-item">--}}
                {{--                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
                {{--                                </li>--}}
                {{--                            @endif--}}
                {{--                        @else--}}
                {{--                            <li class="nav-item dropdown">--}}
                {{--                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
                {{--                                    {{ Auth::user()->username }}--}}
                {{--                                </a>--}}

                {{--                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">--}}
                {{--                                    <a class="dropdown-item" href="{{ route('logout') }}"--}}
                {{--                                       onclick="event.preventDefault();--}}
                {{--                                                     document.getElementById('logout-form').submit();">--}}
                {{--                                        {{ __('Logout') }}--}}
                {{--                                    </a>--}}

                {{--                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">--}}
                {{--                                        @csrf--}}
                {{--                                    </form>--}}
                {{--                                </div>--}}
                {{--                            </li>--}}
                {{--                        @endguest--}}
                @guest
                    <a
                        href="{{ route('login') }}"
                        class="h-16 w-10 mx-auto flex flex justify-center items-center
				        w-full focus:text-orange-500 hover:bg-red-200 focus:outline-none">
                        <outline-login-icon class="h-6 w-6"/>
                    </a>
{{--                    <a--}}
{{--                        href="{{ route('register') }}"--}}
{{--                        class="h-16 w-10 mx-auto flex flex justify-center items-center--}}
{{--				        w-full focus:text-orange-500 hover:bg-red-200 focus:outline-none">--}}
{{--                        {{ __('Register') }}--}}
{{--                    </a>--}}
                @else
                    <a
                        href="{{ route('logout') }}"
                        class="h-16 w-10 mx-auto flex flex justify-center items-center
				w-full focus:text-orange-500 hover:bg-red-200 focus:outline-none"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <outline-logout-icon class="h-6 w-6"/>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endguest

            </div>

        </aside>

        <main class="py-5 w-full">
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
