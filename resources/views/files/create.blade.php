@extends('layouts.app')

@section('content')

    <div class="container mx-auto px-3">
        <!-- Menu bar -->
        <div class="bg-white rounded-xl p-4 w-full mb-3">
            <h1 class="text-xl font-semibold">Create file</h1>
        </div>

        <!-- Content -->
        <div class="bg-white rounded-xl p-4">
            <form action="{{ route('files.store') }}" method="POST" id="createForm">
                @csrf
                @method("POST")
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                    <div>
                        <label for="fileId">File number:</label>
                        <input type="text" name="fileId" id="fileId" class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full"
                            placeholder="File number" value="{{ old('fileId') }}">
                        <small class="opacity-50">Fill in the number of the file here.</small>
                        @error('fileId')
                        <br>
                        <small class="text-red-600 font-semibold">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="name">File name:</label>
                        <input type="text" name="name" id="name" class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full"
                            placeholder="File name" value="{{ old('name') }}" required>
                        <small class="opacity-50">Fill in the name of the file here.</small>
                        @error('name')
                        <br>
                        <small class="text-red-600 font-semibold">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="enclosureId">Enclosure ID:</label>
                        <input type="text" name="enclosureId" id="enclosureId" class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full"
                            placeholder="Enclosure ID" value="{{ old('enclosureId') }}">
                        <small class="opacity-50">Fill in the name of the enclosure here.</small>
                        @error('enclosureId')
                        <br>
                        <small class="text-red-600 font-semibold">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="uniqueId">Unique ID:</label>
                        <input type="text" name="uniqueId" id="uniqueId" class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full"
                            placeholder="Unique ID" value="{{ old('uniqueId') }}">
                        <small class="opacity-50">Fill in the unique ID of the file here. This ID will be used in the URL generated for the client, as well as in the QR-code.</small>
                        @error('uniqueId')
                        <br>
                        <small class="text-red-600 font-semibold">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="clientId">Client:</label>
                        <select name="clientId" id="clientId" class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full">
                            @foreach ($clients as $client)
                                <option
                                    value="{{ $client->id }}"
                                    @if(old('clientId') == $client->id) selected @endif>
                                    {{ $client->name }}
                                </option>
                            @endforeach
                        </select>
                        <small class="opacity-50">Select the client of the file here.</small>
                        @error('clientId')
                        <br>
                        <small class="text-red-600 font-semibold">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </form>
        </div>

        <div class="flex justify-end flex-grow gap-2 w-full md:w-auto mt-3">
            <a href="{{ route('files.index') }}"
                class="bg-red-600 hover:bg-red-700 px-9 py-3 mb-3 text-white rounded inline-flex justify-center items-center">
                <x-heroicon-o-trash class="h-4 w-4 mr-1" /><span>Discard</span>
            </a>
            <a href="javascript:$('#createForm').submit();"
                class="bg-green-600 hover:bg-green-700 md:px-9 py-3 mb-3 text-white rounded flex-grow md:flex-grow-0
                flex justify-center items-center">
                <x-heroicon-o-pencil class="h-4 w-4 mr-1" /><span>Save</span>
            </a>
        </div>
    </div>

@endsection
