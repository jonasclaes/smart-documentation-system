@extends('layouts.app')

@section('content')

    <div class="container mx-auto px-3">
        <div class="max-w-3xl mx-auto">
            <!-- Menu bar -->
            <div class="bg-white rounded-xl shadow-md p-4 mb-3">
                <h1 class="text-xl font-bold">{{ __('Reset password') }}</h1>
            </div>

            <!-- Login form -->
            <div class="bg-white rounded-xl shadow-md p-4">
                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="grid grid-cols-1 gap-3">
                        <div>
                            <label for="email">{{ __('E-mail') }}:</label>
                            <input
                                type="email"
                                autofocus
                                autocomplete="email"
                                name="email"
                                id="email"
                                value="{{ old('email', $email) }}"
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
                                value="{{ old('password') }}"
                                required
                                class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full">
                            @error('password')
                            <span class="text-red-600">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div>
                            <label for="password-confirm">{{ __('Confirm password') }}:</label>
                            <input
                                type="password"
                                name="password_confirmation"
                                id="password-confirm"
                                required
                                class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full">
                        </div>
                        <div class="col-span-full">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 px-9 py-3 text-white rounded w-full">{{ __('Reset password') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
