@extends('layouts.app')

@section('content')
    <div class="container mx-auto ">
        <div class="mx-auto lg:w-10/12 justify-center text-center">Please Register New User Information</div>
        <div class="mt-6 bg-blue-200 rounded-xl shadow-md p-4 mx-auto lg:w-8/12 flex-row justify-center align-middle">
            <h1 class="text-xl">{{ __('Register') }}</h1>
            <div class="flex-auto">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mt-2">
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
                            class="block w-full rounded-md shadow-sm border-gray-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('firstName') ring ring-red-500 ring-opacity-50 @enderror">

                        @error('firstName')
                        <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mt-2">
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
                            class="block w-full rounded-md shadow-sm border-gray-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('lastName') ring ring-red-500 ring-opacity-50 @enderror">

                        @error('lastName')
                        <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mt-2">
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
                            value="{{ old('email') }}"
                            class="block w-full rounded-md shadow-sm border-gray-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('email') ring ring-red-500 ring-opacity-50 @enderror">

                        @error('email')
                        <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
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
                            class="block w-full rounded-md shadow-sm border-gray-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('password') ring ring-red-500 ring-opacity-50 @enderror">

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
                            class="block w-full rounded-md shadow-sm border-gray-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('password') ring ring-red-500 ring-opacity-50 @enderror">

                        @error('password')
                        <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="grid grid-cols-1 mt-2 justify-end">
                        <button
                            type="submit"
                            class="text-base font-medium rounded-lg p-3 text-white bg-gray-500 w-1/6">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
