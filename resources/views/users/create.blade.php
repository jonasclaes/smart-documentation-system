@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-3">
        <!-- Menu bar -->
        <div class="bg-white rounded-xl p-4 w-full mb-3">
            <h1 class="text-xl font-semibold">Create user</h1>
        </div>

        <div class="bg-white rounded-xl p-4">
            <form method="POST" action="{{ route('users.store') }}" id="createForm">
                {{ csrf_field() }}
                {{ method_field('POST') }}
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label
                            for="firstName"
                            class="text-gray-700">
                            {{ __('First Name') }}</label>
                        <input
                            type="text"
                            autofocus
                            required
                            autocomplete="firstName"
                            name="firstName"
                            id="firstName"
                            value="{{ old('firstName') }}"
                            class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full
                                 @error('firstName') ring ring-red-500 ring-opacity-50 @enderror">

                        @error('firstName')
                        <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label
                            for="lastName"
                            class="text-gray-700">
                            {{ __('Last Name') }}</label>
                        <input
                            type="text"
                            required
                            autocomplete="lastName"
                            name="lastName"
                            id="lastName"
                            value="{{ old('lastName') }}"
                            class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full
                                @error('lastName') ring ring-red-500 ring-opacity-50 @enderror">

                        @error('lastName')
                        <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-span-2">
                        <label
                            for="email"
                            class="text-gray-700">
                            {{ __('E-Mail Address') }}</label>
                        <input
                            type="email"
                            required
                            autocomplete="email"
                            name="email"
                            id="email"
                            value="{{ old('email')}}"
                            class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full
                                @error('email') ring ring-red-500 ring-opacity-50 @enderror">

                        @error('email')
                        <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label
                            for="phoneNumber"
                            class="text-gray-700">
                            {{ __('Phone Number') }}</label>
                        <input
                            type="tel"
                            autocomplete="phoneNumber"
                            name="phoneNumber"
                            id="phoneNumber"
                            value="{{ old('phoneNumber') }}"
                            class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full
                                @error('phoneNumber') ring ring-red-500 ring-opacity-50 @enderror">
                        @error('phoneNumber')
                        <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label
                            for="username"
                            class="text-gray-700">
                            {{ __('Username') }}</label>
                        <input
                            type="text"
                            autofocus
                            required
                            autocomplete="Username"
                            name="username"
                            id="username"
                            value="{{ old('username') }}"
                            class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full
                                @error('username') ring ring-red-500 ring-opacity-50 @enderror">
                        @error('username')
                        <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label
                            for="password"
                            class="text-gray-700">
                            {{ __('Password') }}</label>
                        <input
                            type="password"
                            required
                            autocomplete="new-password"
                            name="password"
                            id="password"
                            class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full
                                @error('password') ring ring-red-500 ring-opacity-50 @enderror">

                        @error('password')
                        <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label
                            for="password-confirm"
                            class="text-gray-700">
                            {{ __('Confirm Password') }}</label>
                        <input
                            type="password"
                            required
                            autocomplete="new-password"
                            name="password_confirmation"
                            id="password-confirm"
                            class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full
                                @error('password') ring ring-red-500 ring-opacity-50 @enderror">

                        @error('password')
                        <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </form>
        </div>

        <div class="flex justify-end flex-grow gap-2 w-full md:w-auto mt-3">
            <a href="{{ route('users.index') }}"
               class="bg-red-600 hover:bg-red-700 px-9 py-3 mb-3 text-white rounded inline-flex justify-center items-center">
                <x-heroicon-s-trash class="h-4 w-4 mr-1"/>
                <span>Discard</span>
            </a>
            <a href="javascript:$('#createForm').submit();"
               class="bg-green-600 hover:bg-green-700 md:px-9 py-3 mb-3 text-white rounded flex-grow md:flex-grow-0
                flex justify-center items-center">
                <x-heroicon-s-pencil class="h-4 w-4 mr-1"/>
                <span>{{ __('Create User') }}</span>
            </a>
        </div>
    </div>
@endsection
