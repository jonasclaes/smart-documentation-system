@php /** @var App\Models\Client $client */ @endphp

@extends('layouts.app')

@section('content')

    <div class="container mx-auto px-3">
        <!-- Back Button -->
        <a href="{{ route('clients.index') }}"
           class="bg-gray-700 hover:bg-gray-800 px-9 py-3 mb-3 text-white rounded inline-flex justify-center items-center">
            <x-heroicon-s-chevron-left class="h-4 w-4"/>
            <span>Back</span>
        </a>

        <!-- Delete form -->
        <form action="{{ route('clients.destroy', ['client' => $client]) }}" method="POST" id="deleteClient">
            @csrf
            @method('DELETE')
        </form>

        <!-- Menu bar -->
        <div class="bg-white rounded-xl p-4 w-full mb-3">
            <h1 class="text-xl font-semibold mb-2 pb-1 border-b">Client</h1>
            <div class="flex flex-wrap items-start gap-2">
                <p class="flex-grow text-gray-400">This page displays all the information of a particular client.</p>
                <div class="flex justify-end flex-grow gap-2 w-full md:w-auto">
                    <a href="{{ route('clients.edit', ['client' => $client]) }}"
                       class="bg-blue-600 hover:bg-blue-700 md:px-9 py-3 text-white rounded flex-grow md:flex-grow-0
                       flex justify-center items-center">
                        <x-heroicon-s-pencil class="h-4 w-4 mr-1"/>
                        Edit
                    </a>
                    <a href="javascript:toggleModal('modal-delete')"
                       class="bg-red-600 hover:bg-red-700 md:px-9 py-3 text-white rounded flex-grow md:flex-grow-0
                       flex justify-center items-center">
                        <x-heroicon-s-trash class="h-4 w-4 mr-1"/>
                        Delete
                    </a>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="grid gap-3 grid-cols-12">
            <!-- Client information Box -->
            <div class="bg-white rounded-xl p-4 col-span-12 md:col-span-6 h-56">
                <h2 class="font-semibold text-lg mb-1">{{ $client->name }}</h2>
                <p class="opacity-40">Created on: {{$client->created_at}}</p>
                <p class="opacity-40">Last updated on: {{$client->updated_at}}</p>
                <br>
                <p>Client Number: {{ $client->clientNumber }}</p>
                <p>Email: <a href="mailto:{{ $client->contactEmail }}" class="text-blue-500">{{$client->contactEmail}}</a></p>
                <p>Phone: <a href="tel:{{ $client->contactPhoneNumber }}" class="text-blue-500">{{$client->contactPhoneNumber}}</a></p>
            </div>
            <!-- Files List for Particular Client -->
            <div class="bg-white rounded-xl p-4 col-span-12 md:col-span-6 lg:col-span-6 flex flex-col">
                <h2 class="font-semibold text-lg mb-1">Files</h2>
                <!-- Files loop for all the files attached to current client, display message if no files found. -->
                <div class="grid grid-cols-1 gap-2">
                    @if(count($client->files) > 0)
                        @foreach($client->files->sortBy('name') as $file)
                            <x-list-item
                                to="{{ route('files.show', ['file' => $file]) }}"
                                title="{{ $file->fileId }} - {{ $file->name }}">
                            </x-list-item>
                        @endforeach
                    @else
                        <div class="flex-grow flex items-center">
                            <span class="text-center w-full">There are currently no files for this client.</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div id="modal-delete" class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50
     outline-none focus:outline-none justify-center items-center">
        <div class="relative w-auto my-6 mx-auto max-w-3xl">
            <!--content-->
            <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none
            focus:outline-none">
                <!--header-->
                <div class="flex items-start justify-between p-5 border-b border-solid border-gray-200
                rounded-t">
                    <h3 class="text-3xl font-semibold">Confirm Delete</h3>
                    <button class="p-1 ml-auto bg-transparent border-0 text-gray-300 float-right text-3xl
                    leading-none font-semibold outline-none focus:outline-none"
                            onclick="toggleModal('modal-delete')">
                        <span class="bg-transparent h-6 w-6 text-2xl block outline-none focus:outline-none">
                            <x-heroicon-s-x class="h-6 w-6"/>
                        </span>
                    </button>
                </div>
                <!--body-->
                <div class="relative p-6 flex-auto">
                    <p class="my-4 text-gray-500 text-lg leading-relaxed">
                        Do you really want to delete client {{$client->clientNumber}} {{$client->name}}?
                        This action cannot be undone.
                    </p>
                </div>
                <!--footer-->
                <div class="flex items-center justify-end p-6 border-t border-solid border-gray-200 rounded-b">
                    <button class="text-white bg-gray-600 hover:bg-gray-500 rounded font-bold uppercase px-6
                    py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                            type="button"
                            onclick="toggleModal('modal-delete')">
                        Discard
                    </button>
                    <button class="bg-red-600 hover:bg-red-500 text-white font-bold uppercase text-sm px-4 py-2
                    rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear
                    transition-all duration-150"
                            type="button"
                            onclick="$('#deleteClient').submit();">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!--gray overlay for modal backgrounds-->
    <div
        class="hidden opacity-50 fixed inset-0 z-40 bg-gray-900"
        id="modal-delete-backdrop"
    ></div>
    <script type="text/javascript">
        function toggleModal(modalID) {
            document.getElementById(modalID).classList.toggle("hidden");
            document
                .getElementById(modalID + "-backdrop")
                .classList.toggle("hidden");
            document.getElementById(modalID).classList.toggle("flex");
            document.getElementById(modalID + "-backdrop").classList.toggle("flex");
        }
    </script>

@endsection
