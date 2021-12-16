@extends('layouts.app')

@section('content')

    <div class="container mx-auto px-3">
        <div class="max-w-3xl mx-auto">
            <!-- Menu bar -->
            <div class="bg-white rounded-xl shadow-md p-4 mb-3">
                <h1 class="text-xl font-bold">{{ __('Login') }}</h1>
            </div>

            <!-- Login form -->
            <div class="bg-white rounded-xl shadow-md p-4">
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 gap-3">
                        <div>
                            <label for="email">{{ __('E-mail') }}:</label>
                            <input
                                type="email"
                                autofocus
                                autocomplete="email"
                                name="email"
                                id="email"
                                value="{{ old('email') }}"
                                class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full">
                            @error('email')
                                <span class="text-red-600">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div>
                            <label for="password">{{ __('Password') }}:</label>
                            <input
                                type="password"
                                autocomplete="password"
                                name="password"
                                id="password"
                                class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full">
                            @error('password')
                            <span class="text-red-600">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div>
                            <label for="remember">
                                <input
                                    type="checkbox"
                                    name="remember"
                                    id="remember"
                                    {{ old('remember') ? 'checked' : '' }}
                                    class="rounded-md text-blue-600 border-gray-300 focus:border-blue-300 focus:ring-0 focus:ring-offset-0">
                                <span>{{ __('Remember me') }}</span>
                            </label>

                        </div>
                        <div class="col-span-full">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 px-9 py-3 text-white rounded w-full">{{ __('Login') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
