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
                <a class="h-6 w-6 mx-auto" href=".">
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
                <button
                    class="h-16 w-10 mx-auto flex flex justify-center items-center
				w-full focus:text-orange-500 hover:bg-red-200 focus:outline-none">
                    <outline-logout-icon class="h-6 w-6"/>
                </button>
            </div>

        </aside>

        <example-component test="{{config('app.name', 'Laravel')}}"></example-component>
    </div>
    {{--        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">--}}
    {{--            <div class="container">--}}
    {{--                <a class="navbar-brand" href="{{ url('/') }}">--}}
    {{--                    {{ config('app.name', 'Laravel') }}--}}
    {{--                </a>--}}
    {{--                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">--}}
    {{--                    <span class="navbar-toggler-icon"></span>--}}
    {{--                </button>--}}

    {{--                <div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
    {{--                    <!-- Left Side Of Navbar -->--}}
    {{--                    <ul class="navbar-nav mr-auto">--}}

    {{--                    </ul>--}}

    {{--                    <!-- Right Side Of Navbar -->--}}
    {{--                    <ul class="navbar-nav ml-auto">--}}
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
    {{--                    </ul>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </nav>--}}

    {{--        <main class="py-4">--}}
    {{--            @yield('content')--}}
    {{--        </main>--}}
</div>
{{--<script type="module">--}}
{{--    import ExampleComponent from './components/ExampleComponent.vue';--}}

{{--    export default {--}}
{{--        components: {--}}
{{--            ExampleComponent--}}
{{--        }--}}
{{--    }--}}
{{--</script>--}}
</body>
</html>
