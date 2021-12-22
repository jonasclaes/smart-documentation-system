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
                        href="{{ route('users.index') }}"
                        class="h-16 px-6 flex justify-center items-center w-full
					focus:text-orange-500">
                        <x-heroicon-o-users class="h-6 w-6"/>
                    </a>
                </li>
                <li class="hover:bg-gray-100">
                    <a
                        href="{{ route('clients.index') }}"
                        class="h-16 px-6 flex justify-center items-center w-full
					focus:text-orange-500">
                        <x-heroicon-o-office-building class="h-6 w-6"/>
                    </a>
                </li>
                <li class="hover:bg-gray-100">
                    <a
                        href="{{ route('files.index') }}"
                        class="h-16 px-6 flex justify-center items-center w-full
					focus:text-orange-500">
                        <x-heroicon-o-folder class="h-6 w-6"/>
                    </a>
                </li>
                <li class="hover:bg-gray-100">
                    <a
                        href="{{ route('logs') }}"
                        class="h-16 px-6 flex justify-center items-center w-full
					focus:text-orange-500">
                        <x-heroicon-o-menu-alt-1 class="h-6 w-6"/>
                    </a>
                </li>
            </ul>

            <ul class="mt-auto">
                <!-- Items Section -->
                @guest
                <li class="focus:text-orange-500 hover:bg-red-200 focus:outline-none">
                    <a href="{{ route('login') }}" class="h-16 px-6 flex justify-center items-center w-full">
                        <x-heroicon-o-login class="h-6 w-6"/>
                    </a>
                </li>
                @else
                <li class="focus:text-orange-500 hover:bg-red-200 focus:outline-none">
                    <a
                        href="{{ route('logout') }}"
                        class="h-16 px-6 flex justify-center items-center w-full"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <x-heroicon-o-logout class="h-6 w-6"/>
                    </a>
                </li>
                @endguest
            </ul>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </aside>

        <main class="py-5 w-full overflow-y-scroll">
            @include('components.Alerts')
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
