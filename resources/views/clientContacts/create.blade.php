@extends('layouts.app')

@section('content')

    <div class="container mx-auto px-3">
        <!-- Menu bar -->
        <div class="bg-white rounded-xl p-4 w-full mb-3">
            <h1 class="text-xl font-semibold">{{ __('Create contact') }}</h1>
        </div>

        <!-- Content -->
        <div class="bg-white rounded-xl p-4">
            <form action="{{ route('clientContacts.store', ['client' => $client]) }}" method="POST" id="createForm">
                @csrf
                @method("POST")
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                    <div>
                        <label for="firstName">{{ __('First name') }} ({{ __('required') }}):</label>
                        <input type="text" name="firstName" id="firstName" class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full"
                               placeholder="John" value="{{ old('firstName') }}">
                        <small class="text-gray-400">{{ __('Fill in the first name of the contact here.') }}</small>
                        @error('firstName')
                        <br>
                        <small class="text-red-600 font-semibold">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="lastName">{{ __('Last name') }} ({{ __('required') }}):</label>
                        <input type="text" name="lastName" id="lastName" class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full"
                               placeholder="Doe" value="{{ old('lastName') }}">
                        <small class="text-gray-400">{{ __('Fill in the last name of the contact here.') }}</small>
                        @error('lastName')
                        <br>
                        <small class="text-red-600 font-semibold">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="role">{{ __('Role') }} ({{ __('optional') }}):</label>
                        <input type="text" name="role" id="role" class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full"
                               placeholder="IT Architect" value="{{ old('role') }}">
                        <small class="text-gray-400">{{ __('Fill in the role of the contact here.') }}</small>
                        @error('role')
                        <br>
                        <small class="text-red-600 font-semibold">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="email">{{ __('E-mail') }} ({{ __('optional') }}):</label>
                        <input type="email" name="email" id="email" class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full"
                               placeholder="john.doe@example.com" value="{{ old('email') }}">
                        <small class="text-gray-400">{{ __('Fill in the email of the contact here.') }}</small>
                        @error('email')
                        <br>
                        <small class="text-red-600 font-semibold">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="phoneNumber">{{ __('Phone number') }} ({{ __('optional') }}):</label>
                        <input type="tel" name="phoneNumber" id="phoneNumber" class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full"
                               placeholder="{{ __('Phone number') }}" value="{{ old('phoneNumber') }}">
                        <small class="text-gray-400">{{ __('Fill in the phoneNumber of the contact here.') }}</small>
                        @error('phoneNumber')
                        <br>
                        <small class="text-red-600 font-semibold">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="clientId">{{ __('Client') }} ({{ __('required') }}):</label>
                        <select name="clientId" id="clientId" class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full">
                            @foreach ($clients as $clientEntry)
                                <option
                                    value="{{ $clientEntry->id }}"
                                    @if(old('clientId', $client->id) == $clientEntry->id) selected @endif>
                                    {{ $clientEntry->name }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-gray-400">{{ __('Select the client of the file here.') }}</small>
                        @error('clientId')
                        <br>
                        <small class="text-red-600 font-semibold">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <button type="submit" hidden></button>
            </form>
        </div>

        <div class="flex justify-end flex-grow gap-2 w-full md:w-auto mt-3">
            <a href="{{ route('clients.show', ['client' => $client]) }}"
                class="bg-red-600 hover:bg-red-700 px-9 py-3 mb-3 text-white rounded inline-flex justify-center items-center">
                <x-heroicon-s-trash class="h-4 w-4 mr-1" /><span>{{ __('Discard') }}</span>
            </a>
            <a href="javascript:$('#createForm').submit();"
                class="bg-green-600 hover:bg-green-700 md:px-9 py-3 mb-3 text-white rounded flex-grow md:flex-grow-0
                flex justify-center items-center">
                <x-heroicon-s-pencil class="h-4 w-4 mr-1" /><span>{{ __('Save') }}</span>
            </a>
        </div>
    </div>

@endsection
