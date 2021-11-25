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
    <div class="min-h-screen w-screen bg-gray-200">
        @if($topnav ?? false)
            <nav class="bg-white shadow-md flex justify-center md:justify-start h-12 p-3">
                <div class="container mx-auto">
                    <div class="h-full flex items-center gap-2">
                        <!-- Logo Section -->
                        <img class="h-full"
                             src="{{ asset('assets/delta-technics-small.png') }}"
                             alt="Delta Technics"/>
                        <h1 class="text-xl capitalize">Delta technics</h1>
                    </div>
                </div>
            </nav>
        @endif

        <main class="p-3 overflow-y-auto">
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
