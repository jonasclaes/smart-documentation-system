@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-3">
        <!-- Menu bar -->
        <div class="bg-white rounded-xl p-4 w-full mb-3">
            <h1 class="text-xl font-semibold">{{ __('Create user') }}</h1>
        </div>

        <div class="bg-white rounded-xl p-4">
            <form method="POST" action="{{ route('users.store') }}" id="createForm">
                @csrf
                @method("POST")
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label
                            for="firstName"
                            class="text-gray-700">
                            {{ __('First name') }} ({{ __('required') }}):</label>
                        <input
                            type="text"
                            autofocus
                            required
                            autocomplete="firstName"
                            name="firstName"
                            id="firstName"
                            value="{{ old('firstName') }}"
                            class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full">
                        <small class="text-gray-400">{{ __('Fill in the persons first name here.') }}</small>
                        @error('firstName')
                        <br>
                        <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label
                            for="lastName"
                            class="text-gray-700">
                            {{ __('Last name') }} ({{ __('required') }}):</label>
                        <input
                            type="text"
                            required
                            autocomplete="lastName"
                            name="lastName"
                            id="lastName"
                            value="{{ old('lastName') }}"
                            class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full">
                        <small class="text-gray-400">{{ __('Fill in the persons last name here.') }}</small>
                        @error('lastName')
                        <br>
                        <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label
                            for="email"
                            class="text-gray-700">
                            {{ __('E-mail address') }} ({{ __('required') }}):</label>
                        <input
                            type="email"
                            required
                            autocomplete="email"
                            name="email"
                            id="email"
                            value="{{ old('email')}}"
                            class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full">
                        <small class="text-gray-400">{{ __('Fill in the persons e-mail address here.') }}</small>
                        @error('email')
                        <br>
                        <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label
                            for="phoneNumber"
                            class="text-gray-700">
                            {{ __('Phone number') }} ({{ __('optional') }}):</label>
                        <input
                            type="tel"
                            autocomplete="phoneNumber"
                            name="phoneNumber"
                            id="phoneNumber"
                            value="{{ old('phoneNumber') }}"
                            class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full">
                        <small class="text-gray-400">{{ __('Fill in the persons phone number here.') }}</small>
                        @error('phoneNumber')
                        <br>
                        <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label
                            for="username"
                            class="text-gray-700">
                            {{ __('Username') }} ({{ __('optional') }}):</label>
                        <input
                            type="text"
                            autofocus
                            required
                            autocomplete="Username"
                            name="username"
                            id="username"
                            value="{{ old('username') }}"
                            class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full">
                        <small class="text-gray-400">{{ __('Fill in the persons username here.') }}</small>
                        <br>
                        <small class="text-gray-400">{{ __('Attention: if you do not fill in this field, it will generate a username in the format of {firstName}.{lastName}.') }}</small>
                        @error('username')
                        <br>
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
                <span>{{ __('Discard') }}</span>
            </a>
            <a href="javascript:$('#createForm').submit();"
               class="bg-green-600 hover:bg-green-700 md:px-9 py-3 mb-3 text-white rounded flex-grow md:flex-grow-0
                flex justify-center items-center">
                <x-heroicon-s-plus class="h-4 w-4 mr-1"/>
                <span>{{ __('Create') }}</span>
            </a>
        </div>
    </div>
@endsection
