@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-4 container mx-auto px-3">
        <!-- Menu bar -->
        <div class="col-span-2 col-start-2 bg-white rounded-xl p-4 w-full mb-3">
            <h1 class="text-xl font-semibold text-center">Reset Password</h1>
            <h2 class="text-lg text-gray-900 opacity-60 text-center">User: {{$user->firstName}} {{$user->lastName}}</h2>
        </div>

        <!-- Content -->
        <div class="col-span-2 col-start-2 bg-white rounded-xl p-4">
            <form action="{{ route('users.updatePassword', ['user' => $user]) }}" method="POST" id="editPassword">
                @csrf
                @method("PUT")
                <div class="grid grid-cols-1  gap-3">
                    <div>
                        <label for="password"></label>
                        <input type="text" name="password" id="password" class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full"
                               placeholder="Enter New Password" value="" required>
                        <small class="opacity-50">Choose a new password. Must be at least 8 characters long and include a digit and special symbol.</small>
                    </div>
                    <div>
                        <label for="confirm"></label>
                        <input type="text" name="confirm" id="confirm" class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full"
                               placeholder="Retype New Password" value="" required>
                        <small class="opacity-50">Confirm the new password.</small>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-span-1 col-start-3 flex justify-end flex-grow gap-2 w-full md:w-auto mt-3">
            <a href="{{ route('users.show', ['user' => $user]) }}"
               class="bg-red-600 hover:bg-red-700 px-9 py-3 mb-3 text-white rounded inline-flex justify-center items-center">
                <x-heroicon-o-trash class="h-4 w-4 mr-1" /><span>Discard</span>
            </a>
            <a href="javascript:$('#editPassword').submit();"
               class="bg-green-600 hover:bg-green-700 md:px-9 py-3 mb-3 text-white rounded flex-grow md:flex-grow-0
                flex justify-center items-center">
                <x-heroicon-o-pencil class="h-4 w-4 mr-1" /><span>Save</span>
            </a>
        </div>
    </div>
@endsection
