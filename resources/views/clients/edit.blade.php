@php
    /** @var App\Models\Client $client */
@endphp

@extends('layouts.app')

@section('content')

    <div class="container mx-auto px-3">
        <!-- Menu bar -->
        <div class="bg-white rounded-xl p-4 w-full mb-3">
            <h1 class="text-xl font-semibold">Edit Client Information</h1>
        </div>

        <!-- Content -->
        <div class="bg-white rounded-xl p-4">
            <form action="{{ route('clients.update', ['client' => $client]) }}" method="POST" id="editClient">
                @csrf
                @method("PUT")
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                    <div>
                        <label for="clientNumber">Client Number: </label>
                        <input type="number" name="clientNumber" id="clientNumber" class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full"
                               placeholder="Client Number" value="{{ old('clientNumber', $client->clientNumber) }}" min="1000" max="9999" required>
                        <small class="opacity-50">Fill in the number of the client here.</small>
                        @error('clientNumber')
                        <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="name">Client Name</label>
                        <input type="text" name="name" id="name" class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full"
                                   placeholder="Client Name" value="{{ old('name', $client->name) }}" required>
                        <small class="opacity-50">Fill in the name of the file here.</small>
                        @error('name')
                        <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="contactEmail">Contact Email:</label>
                        <input type="email" name="contactEmail" id="contactEmail" class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full"
                               placeholder="Contact Email" value="{{ old('contactEmail', $client->contactEmail) }}" required">
                        <small class="opacity-50">Fill in a valid contact email address here.</small>
                        @error('contactEmail')
                        <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="contactPhoneNumber">Contact Phone Number:</label>
                        <input type="tel" name="contactPhoneNumber" id="contactPhoneNumber" class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full"
                               placeholder="Contact Phone Number" value="{{ old('contactPhoneNumber', $client->contactPhoneNumber) }}" required>
                        <small class="opacity-50">Please provide a valid phone Number of a client Contact.</small>
                        @error('contactPhoneNumber')
                        <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </form>
        </div>

        <div class="flex justify-end flex-grow gap-2 w-full md:w-auto mt-3">
            <a href="{{ route('clients.show', ['client' => $client]) }}"
               class="bg-red-600 hover:bg-red-700 px-9 py-3 mb-3 text-white rounded inline-flex justify-center items-center">
                <x-heroicon-o-trash class="h-4 w-4 mr-1" /><span>Discard</span>
            </a>
            <a href="javascript:$('#editClient').submit();"
               class="bg-green-600 hover:bg-green-700 md:px-9 py-3 mb-3 text-white rounded flex-grow md:flex-grow-0
                flex justify-center items-center">
                <x-heroicon-o-pencil class="h-4 w-4 mr-1" /><span>Save</span>
            </a>
        </div>
    </div>

@endsection