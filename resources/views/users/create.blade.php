@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div
            class="mt-6 bg-white rounded-xl shadow-md p-4 mx-auto lg:w-8/12 flex-row justify-center align-middle">
            <h1 class="text-2xl font-extrabold">User Creation Page</h1>
            <h2 class="text-xl font-bold text-gray-600">{{ __('Please enter user information') }}</h2>
            <br>
            <hr>
            <div class="flex-auto">
                <form method="POST" action="{{ route('users.store') }}">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    <div class="grid grid-cols-2">
                        <div class="mt-2 mx-1">
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
                                class="block w-full rounded-md shadow-sm border-gray-300 focus:ring
                                 focus:ring-indigo-200 focus:ring-opacity-50
                                 @error('firstName') ring ring-red-500 ring-opacity-50 @enderror" disabled>

                            @error('firstName')
                            <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                        <div class="mt-2 mx-1">
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
                                class="block w-full rounded-md shadow-sm border-gray-300 focus:ring focus:ring-indigo-200
             focus:ring-opacity-50 @error('lastName') ring ring-red-500 ring-opacity-50 @enderror"
                                disabled>

                            @error('lastName')
                            <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                        <div class="mt-2 cols-span-2 lg:col-span-6 mx-1">
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
                                class="block w-full rounded-md shadow-sm border-gray-300 focus:ring focus:ring-indigo-200
             focus:ring-opacity-50 @error('email') ring ring-red-500 ring-opacity-50 @enderror"
                                disabled>

                            @error('email')
                            <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                        <div class="mt-2 cols-span-12 lg:col-span-6 mx-1">
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
                                class="block w-full rounded-md shadow-sm border-gray-300 focus:ring focus:ring-indigo-200
             focus:ring-opacity-50 @error('phoneNumber') ring ring-red-500 ring-opacity-50 @enderror"
                                disabled>
                            @error('phoneNumber')
                            <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                        <div class="mt-2">
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
                                class="block w-full rounded-md shadow-sm border-gray-300 focus:ring focus:ring-indigo-200
         focus:ring-opacity-50 @error('username') ring ring-red-500 ring-opacity-50 @enderror"
                                disabled>
                            @error('username')
                            <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-2">
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
                            class="block w-full rounded-md shadow-sm border-gray-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('password') ring ring-red-500 ring-opacity-50 @enderror"
                            disabled>

                        @error('password')
                        <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mt-2">
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
                            class="block w-full rounded-md shadow-sm border-gray-300 focus:ring focus:ring-indigo-200
             focus:ring-opacity-50 @error('password') ring ring-red-500 ring-opacity-50 @enderror"
                            disabled>

                        @error('password')
                        <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        <div class="grid grid-cols-8 gap-4 mt-4 justify-end align-bottom">
                            <button
                                type="submit"
                                class="col-end-9 col-span-2 text-base font-medium rounded-lg p-3 text-white bg-gray-600">
                                {{ __('Create User') }}
                            </button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        var fields = document.querySelectorAll('input');
        fields.forEach(function (field) {
            field.disabled = false;
        })
    </script>
    {{--<div class="container">--}}
    {{--    <div class="row justify-content-center">--}}
    {{--        <div class="col-md-8">--}}
    {{--            <div class="card">--}}
    {{--                <div class="card-header">{{ __('Register') }}</div>--}}

    {{--                <div class="card-body">--}}
    {{--                    <form method="POST" action="{{ route('register') }}">--}}
    {{--                        @csrf--}}

    {{--                        <div class="form-group row">--}}
    {{--                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>--}}

    {{--                            <div class="col-md-6">--}}
    {{--                                <input id="name" type="text" class="form-control @error('firstName') is-invalid @enderror" name="firstName" value="{{ old('firstName') }}" required autocomplete="firstName" autofocus>--}}

    {{--                                @error('firstName')--}}
    {{--                                <span class="invalid-feedback" role="alert">--}}
    {{--                                        <strong>{{ $message }}</strong>--}}
    {{--                                    </span>--}}
    {{--                                @enderror--}}
    {{--                            </div>--}}
    {{--                        </div>--}}

    {{--                        <div class="form-group row">--}}
    {{--                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>--}}

    {{--                            <div class="col-md-6">--}}
    {{--                                <input id="name" type="text" class="form-control @error('lastName') is-invalid @enderror" name="lastName" value="{{ old('lastName') }}" required autocomplete="lastName" autofocus>--}}

    {{--                                @error('lastName')--}}
    {{--                                    <span class="invalid-feedback" role="alert">--}}
    {{--                                        <strong>{{ $message }}</strong>--}}
    {{--                                    </span>--}}
    {{--                                @enderror--}}
    {{--                            </div>--}}
    {{--                        </div>--}}

    {{--                        <div class="form-group row">--}}
    {{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

    {{--                            <div class="col-md-6">--}}
    {{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">--}}

    {{--                                @error('email')--}}
    {{--                                    <span class="invalid-feedback" role="alert">--}}
    {{--                                        <strong>{{ $message }}</strong>--}}
    {{--                                    </span>--}}
    {{--                                @enderror--}}
    {{--                            </div>--}}
    {{--                        </div>--}}

    {{--                        <div class="form-group row">--}}
    {{--                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

    {{--                            <div class="col-md-6">--}}
    {{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">--}}

    {{--                                @error('password')--}}
    {{--                                    <span class="invalid-feedback" role="alert">--}}
    {{--                                        <strong>{{ $message }}</strong>--}}
    {{--                                    </span>--}}
    {{--                                @enderror--}}
    {{--                            </div>--}}
    {{--                        </div>--}}

    {{--                        <div class="form-group row">--}}
    {{--                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>--}}

    {{--                            <div class="col-md-6">--}}
    {{--                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">--}}
    {{--                            </div>--}}
    {{--                        </div>--}}

    {{--                        <div class="form-group row mb-0">--}}
    {{--                            <div class="col-md-6 offset-md-4">--}}
    {{--                                <button type="submit" class="btn btn-primary">--}}
    {{--                                    {{ __('Register') }}--}}
    {{--                                </button>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </form>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    {{--</div>--}}
@endsection
