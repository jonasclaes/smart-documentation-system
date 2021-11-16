<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Delta Technics Smart Docs') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
{{--    <link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <!-- Component -->
    <div class="h-screen w-screen flex bg-gray-200">
        <!-- Container -->
        <aside class="flex flex-col items-center bg-white text-gray-700 shadow">
            <!-- Side Nav Bar-->
            <div class="h-16 flex items-center w-full">
                <!-- Logo Section -->
                <a class="h-6 w-6 mx-auto" href="{{ url('/') }}">
                    <img class="h-6 w-6 mx-auto"
                         src="{{ asset('assets/delta-technics-small.png') }}"
                         alt="Delta Technics"/>
                </a>
            </div>

            <ul>
                <!-- Items Section -->
                <li class="hover:bg-gray-100">
                    <a
                        href="{{ route('files.index') }}"
                        class="h-16 px-6 flex justify-center items-center w-full
					focus:text-orange-500">
                        <x-heroicon-o-document-duplicate class="h-6 w-6"/>
                    </a>
                </li>
                <li class="hover:bg-gray-100">
                    <a
                        href="{{ route('users.index') }}"
                        class="h-16 px-6 flex justify-center items-center w-full
					focus:text-orange-500">
                        <x-heroicon-s-user-group class="h-6 w-6"/>
                    </a>
                </li>
            </ul>

            <div class="mt-auto h-16 flex items-center w-full">
                <!-- Action Section -->
                <!-- Authentication Links -->
                <!-- {{--                        @guest--}}
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
                {{--                        @endguest--}} -->
                @guest
                    <a
                        href="{{ route('login') }}"
                        class="h-16 mx-auto flex justify-center items-center
				        w-full focus:text-orange-500 hover:bg-red-200 focus:outline-none">
                        <x-heroicon-o-login class="h-6 w-6"/>
                    </a>
<!-- {{--                    <a--}}
{{--                        href="{{ route('register') }}"--}}
{{--                        class="h-16 w-10 mx-auto flex justify-center items-center--}}
{{--				        w-full focus:text-orange-500 hover:bg-red-200 focus:outline-none">--}}
{{--                        {{ __('Register') }}--}}
{{--                    </a>--}} -->
                @else
                    <a
                        href="{{ route('logout') }}"
                        class="h-16 mx-auto flex justify-center items-center
				w-full focus:text-orange-500 hover:bg-red-200 focus:outline-none"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <x-heroicon-o-logout class="h-6 w-6"/>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endguest

            </div>

        </aside>

        <main class="py-5 w-full overflow-y-scroll">
            @include('components.Alerts')
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
