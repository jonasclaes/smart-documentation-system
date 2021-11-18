@php
    /** @var App\Models\User $user */
@endphp

@extends('layouts.app')

@section('content')

    <div class="container mx-auto px-3">
        <!-- Menu bar -->
        <div class="bg-white rounded-xl p-4 w-full mb-3">
            <h1 class="text-xl font-semibold">Edit User Information</h1>
        </div>

        <!-- Content -->
        <div class="bg-white rounded-xl p-4">
            <form action="{{ route('users.update', ['user' => $user]) }}" method="POST" id="editUser">
                @csrf
                @method("PUT")
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                    <div>
                        <label for="firstName">First Name:</label>
                        <input type="text" name="firstName" id="firstName" class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full"
                               placeholder="First Name" value="{{ old('firstName', $user->firstName) }}" required>
                        <small class="opacity-50">Fill in user first name here.</small>
                        @error('firstName')
                        <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="lastName">Last Name:</label>
                        <input type="text" name="lastName" id="lastName" class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full"
                               placeholder="Last Name" value="{{ old('lastName', $user->lastName) }}" required>
                        <small class="opacity-50">Fill in user last name here.</small>
                        @error('lastName')
                        <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="username">Username:</label>
                        <input type="text" name="username" id="username" class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full"
                               placeholder="Username" value="{{ old('username', $user->username) }}">
                        <small class="opacity-50">Fill in username. If left blank, a username will be generated (format: firstname.lastname).</small>
                        @error('username')
                        <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full"
                               placeholder="Email address" value="{{ old('email', $user->email) }}" required>
                        <small class="opacity-50">Please enter a valid email address</small>
                        @error('email')
                        <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="phoneNumber">Phone Number:</label>
                        <input type="tel" name="phoneNumber" id="phoneNumber" class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full"
                               placeholder="Phone Number" value="{{ old('phoneNumber', $user->phoneNumber) }}">
                        <small class="opacity-50">Fill in a valid phone number</small>
                        @error('phoneNumber')
                        <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </form>
        </div>

        <div class="flex justify-end flex-grow gap-2 w-full md:w-auto mt-3">
            <a href="{{ route('users.show', ['user' => $user]) }}"
               class="bg-red-600 hover:bg-red-700 px-9 py-3 mb-3 text-white rounded inline-flex justify-center items-center">
                <x-heroicon-s-trash class="h-4 w-4 mr-1" /><span>Discard</span>
            </a>
            <a href="javascript:$('#editUser').submit();"
               class="bg-green-600 hover:bg-green-700 md:px-9 py-3 mb-3 text-white rounded flex-grow md:flex-grow-0
                flex justify-center items-center">
                <x-heroicon-s-pencil class="h-4 w-4 mr-1" /><span>Save</span>
            </a>
        </div>
    </div>

@endsection
