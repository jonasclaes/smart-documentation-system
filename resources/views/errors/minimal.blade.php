<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <style>
            .pattern {
                background-color: #1c1c1c;
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 40 40'%3E%3Cg fill-rule='evenodd'%3E%3Cg fill='%23ff0000' fill-opacity='0.4'%3E%3Cpath d='M0 38.59l2.83-2.83 1.41 1.41L1.41 40H0v-1.41zM0 1.4l2.83 2.83 1.41-1.41L1.41 0H0v1.41zM38.59 40l-2.83-2.83 1.41-1.41L40 38.59V40h-1.41zM40 1.41l-2.83 2.83-1.41-1.41L38.59 0H40v1.41zM20 18.6l2.83-2.83 1.41 1.41L21.41 20l2.83 2.83-1.41 1.41L20 21.41l-2.83 2.83-1.41-1.41L18.59 20l-2.83-2.83 1.41-1.41L20 18.59z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="flex items-center justify-center min-h-screen sm:items-center sm:pt-0 pattern">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8 bg-black p-6 rounded-lg shadow-lg">
                <div class="flex items-center justify-center">
                    <div class="px-4 text-lg text-gray-200 border-r border-gray-400 tracking-wider">
                        @yield('code')
                    </div>

                    <div class="ml-4 text-lg text-gray-200 uppercase tracking-wider">
                        @yield('message')
                    </div>
                </div>
                <div class="flex items-center justify-center mt-3">
                    <div class="text-lg text-gray-900 uppercase tracking-wider">
                        <a href="{{ url()->previous() }}" class="flex items-center bg-gray-200 py-1 px-3 rounded"><x-heroicon-o-chevron-left class="h-6 w-6" />&nbsp;Back</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
