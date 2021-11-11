@extends('layouts.app')

@section('content')
    <div class="flex-row justify-center mx-auto p-3 pr-6">
        <a href="{{ route('users.index') }}"
           class="bg-gray-700 hover:bg-gray-800 px-9 py-3 mb-3 text-white rounded inline-flex justify-center items-center">
            <x-heroicon-o-chevron-left class="h-4 w-4"/>
            <span>Back</span>
        </a>
        <!-- Menu bar -->
        <div class="grid grid-cols-12 gap-2 bg-white rounded-xl pl-3 pr-1 pt-4 pb-2 w-full mb-3">
            <h1 class="col-span-12 font-semibold mb-2 pb-1 border-b w-full">User Page</h1>
            <div class="col-span-9">Display and edit the information of the current user.</div>
            <div class="col-span-2 col-start-12 justify-end">
                <form method="POST" action="{{route('users.destroy', $user->id)}}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="bg-red-600 text-base font-medium rounded p-3
            text-white">Delete User
                    </button>
                </form>
            </div>
        </div>

        <!-- User Information Section -->
        <div class="grid grid-cols-12 gap-4 bg-white rounded-xl p-3">
            <div class="col-span-12 md:col-span-7 lg:col-span-5 mb-1">
                <h1 class="pl-2 font-bold text-left text-4xl">{{$user->firstName}} {{$user->lastName}} <span
                        class="text-2xl font-normal text-gray-400">(User ID: {{$user->id}})</span></h1>

            </div>
            <div class="text-center md:text-right col-span-12 sm:col-start-1 md:col-span-5 mb-1 lg:col-end-13 px-3">
                <p>Created at {{$user->created_at}}</p>
                <p>Last Updated at {{$user->updated_at}}</p>
            </div>
            <div class="col-span-12">
                <hr>
                <br>
                <form id="userEdit" method="POST" action="{{ route('users.update', ['user' => $user]) }}">
                    @csrf
                    @method("PUT")
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
                                value="{{ old('firstName', $user->firstName) }}"
                                class="field block w-full rounded-md shadow-sm border-gray-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
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
                                value="{{ old('lastName', $user->lastName) }}"
                                class="field block w-full rounded-md shadow-sm border-gray-300 focus:ring focus:ring-indigo-200
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
                                value="{{ old('email', $user->email)}}"
                                class="field block w-full rounded-md shadow-sm border-gray-300 focus:ring focus:ring-indigo-200
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
                                value="{{ old('phoneNumber', $user->phoneNumber) }}"
                                class="field block w-full rounded-md shadow-sm border-gray-300 focus:ring focus:ring-indigo-200
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
                                value="{{ old('username', $user->username) }}"
                                class="field block w-full rounded-md shadow-sm border-gray-300 focus:ring focus:ring-indigo-200
         focus:ring-opacity-50 @error('username') ring ring-red-500 ring-opacity-50 @enderror"
                                disabled>
                            @error('username')
                            <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                    </div>
                    @isset($create)
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
                                class="field block w-full rounded-md shadow-sm border-gray-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('password') ring ring-red-500 ring-opacity-50 @enderror"
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
                                class="field block w-full rounded-md shadow-sm border-gray-300 focus:ring focus:ring-indigo-200
             focus:ring-opacity-50 @error('password') ring ring-red-500 ring-opacity-50 @enderror"
                                disabled>

                            @error('password')
                            <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                    @endisset

                    <div class="grid grid-cols-8 flex justify-end flex-grow gap-2 w-full md:w-auto mt-3">
                        <a id="save" href="javascript:$('#userEdit').submit();"
                           class="col-span-1 col-end-8 hide bg-green-600 hover:bg-green-700 md:px-9 py-3 text-white rounded flex-grow md:flex-grow-0
                flex justify-center items-center">
                            <x-heroicon-o-pencil class="h-4 w-4 mr-1"/>
                            <span>Save</span>
                        </a>
                        <a id="discard" href="{{ route('users.show', ['user' => $user])}}"
                           class="col-span-1 col-end-9 hide bg-red-600 hover:bg-red-700 px-9 py-3 text-white rounded inline-flex justify-center items-center">
                            <x-heroicon-o-trash class="h-4 w-4 mr-1"/>
                            <span>Discard</span>
                        </a>
                        <button id="edit" type="button" onclick="toggleEnable()" class="bg-gray-500 col-end-9 col-span-1 text-base font-medium rounded p-3
                                    text-white">Edit
                        </button>
                    </div>

                    {{--                    <div class="grid grid-cols-8 gap-4 mt-4 justify-end align-bottom">--}}
                    {{--                        <button id="discard" onclick="window.location='{{route('users.update', $user)}}'" class="bg-gray-500 col-end-8 col-span-1 text-base font-medium rounded p-3--}}
                    {{--                                text-white hidden">Save</button>--}}


                    {{--                    </div>--}}
                </form>
            </div>
        </div>
        <script>
            // Function for saving and editing to unlock all input fields
            function toggleEnable() {
                var fields = document.querySelectorAll('input');
                var editButton = document.getElementById('edit');
                var discard = document.getElementById('discard');
                var save = document.getElementById('save');
                console.log(fields);
                fields.forEach(function (field) {
                    if (field.disabled) {
                        // If disabled, do this
                        if (field.classList.contains('field')) {
                            field.disabled = false;
                        }
                        editButton.classList.add('hide');
                        discard.classList.remove('hide');
                        save.classList.remove('hide');
                    } else {
                        // Enter code here
                        if (field.classList.contains('field')) {
                            field.disabled = true;
                        }
                        editButton.classList.remove('hide');
                        discard.classList.add('hide');
                        save.classList.add('hide');

                    }
                })
            }
        </script>
@endsection
