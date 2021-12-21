@php /** @var App\Models\Client $client */ @endphp

@extends('layouts.app')

@section('content')

    <div class="container mx-auto px-3">
        <!-- Delete form -->
        <form action="{{ route('clients.destroy', ['client' => $client]) }}" method="POST" id="deleteClient">
            @csrf
            @method('DELETE')
        </form>

        <!-- Menu bar -->
        <div class="bg-white rounded-xl p-4 w-full mb-3">
            <h1 class="text-xl font-semibold mb-2 pb-1 border-b">{{ __('Client') }}</h1>
            <div class="flex flex-wrap items-start gap-2">
                <p class="flex-grow text-gray-400">{{ __('This page displays all the information of a particular client') }}.</p>
                <div class="flex justify-end flex-grow gap-2 w-full md:w-auto">
                    <a href="{{ route('clients.edit', ['client' => $client]) }}"
                       class="bg-blue-600 hover:bg-blue-700 md:px-9 py-3 text-white rounded flex-grow md:flex-grow-0
                       flex justify-center items-center">
                        <x-heroicon-s-pencil class="h-4 w-4 mr-1"/>
                        {{ __('Edit') }}
                    </a>
                    <a href="javascript:toggleModal('modal-delete')"
                       class="bg-red-600 hover:bg-red-700 md:px-9 py-3 text-white rounded flex-grow md:flex-grow-0
                       flex justify-center items-center">
                        <x-heroicon-s-trash class="h-4 w-4 mr-1"/>
                        {{ __('Delete') }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="grid gap-3 grid-cols-12 items-start">
            <!-- Client information Box -->
            <div class="col-span-12 md:col-span-6 grid grid-cols-1 gap-3">
                <!-- General information -->
                <div class="bg-white rounded-xl p-4 col-span-full">
                    <h2 class="font-semibold text-lg mb-1">{{ __('General information') }}</h2>
                    <p>{{ __('Created on') }}: {{ $client->created_at }}</p>
                    <p>{{ __('Last edit') }}: {{ $client->updated_at }}</p>
                    <p>{{ __('Client number') }}: {{ $client->clientNumber }}</p>
                    <p>{{ __('Client name') }}: {{ $client->name }}</p>
                </div>

                <!-- Contacts -->
                <div class="bg-white rounded-xl p-4 col-span-full">
                    <h2 class="font-semibold text-lg mb-1">{{ __('Contacts') }}</h2>

                    <!-- Action buttons -->
                    <div class="grid gap-3 grid-cols-1 xl:grid-cols-2 justify-center mb-2">
                        <a href="{{ route('clientContacts.create', ['client' => $client]) }}"
                           class="bg-green-600 hover:bg-green-700 py-2 px-4 text-white rounded inline-flex justify-center items-center w-full">
                            <x-heroicon-s-plus class="h-4 w-4 mr-1"></x-heroicon-s-plus>{{ __('Create contact') }}
                        </a>
                        <div class="bg-gray-100 rounded h-10 hidden xl:block"></div>
                    </div>

                    <!-- Contact list -->
                    <div class="grid grid-cols-1 gap-3">
                        @foreach($client->contacts as $contact)
                            <!-- Contact -->
                            <div class="col-span-full">
                                <div class="float-right flex gap-0.5">
                                    <a href="{{ route('clientContacts.edit', ['client' => $client, 'clientContact' => $contact]) }}"
                                       class="bg-blue-600 hover:bg-blue-700 p-2 text-white rounded flex-grow md:flex-grow-0 flex justify-center items-center">
                                        <x-heroicon-s-pencil class="h-3 w-3"></x-heroicon-s-pencil>
                                    </a>

                                    <!-- Delete form -->
                                    <form action="{{ route('clientContacts.destroy', ['client' => $client, 'clientContact' => $contact]) }}" method="POST" id="deleteFormContact-{{ $contact->id }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <a href="javascript:$('#deleteFormContact-{{ $contact->id }}').submit();"
                                       class="bg-red-600 hover:bg-red-700 p-2 text-white rounded flex-grow md:flex-grow-0 flex justify-center items-center">
                                        <x-heroicon-s-trash class="h-3 w-3"></x-heroicon-s-trash>
                                    </a>
                                </div>

                                <p>{{ __('Name') }}: {{ $contact->lastName }}, {{ $contact->firstName }}</p>
                                @if($contact->role)
                                    <p class="pl-2">{{ __('Role') }}: {{ $contact->role }}</p>
                                @endif
                                @if($contact->email)
                                    <p class="pl-2">{{ __('E-mail') }}: <a href="mailto:{{ $contact->email }}" class="text-blue-500">{{ $contact->email }}</a></p>
                                @endif
                                @if($contact->phoneNumber)
                                    <p class="pl-2">{{ __('Phone number') }}: <a href="tel:{{ $contact->phoneNumber }}" class="text-blue-500">{{ $contact->phoneNumber }}</a></p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Files List for Particular Client -->
            <div class="bg-white rounded-xl p-4 col-span-12 md:col-span-6 lg:col-span-6 flex flex-col">
                <h2 class="font-semibold text-lg mb-1">{{ __('Files') }}</h2>
                <!-- Files loop for all the files attached to current client, display message if no files found. -->
                <div class="grid grid-cols-1 gap-2">
                    @if(count($client->files) > 0)
                        @foreach($client->files->sortBy('name') as $file)
                            <x-list-item
                                to="{{ route('files.show', ['file' => $file]) }}"
                                title="{{ $file->name }}"
                                subtitle="{{ __('File number') }}: {{ $file->fileId }}">
                            </x-list-item>
                        @endforeach
                    @else
                        <div class="flex-grow flex items-center">
                            <span class="text-center w-full">{{ __('There are currently no files for this client.') }}</span>
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
                    <h3 class="text-3xl font-semibold">{{ __('Confirm delete') }}</h3>
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
                        {{ __('Do you really want to delete client') }} {{$client->clientNumber}} {{$client->name}}?
                        {{ __('This action cannot be undone.') }}
                    </p>
                </div>
                <!--footer-->
                <div class="flex items-center justify-end p-6 border-t border-solid border-gray-200 rounded-b">
                    <button class="text-white bg-gray-600 hover:bg-gray-500 rounded font-bold uppercase px-6
                    py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                            type="button"
                            onclick="toggleModal('modal-delete')">
                        {{ __('Discard') }}
                    </button>
                    <button class="bg-red-600 hover:bg-red-500 text-white font-bold uppercase text-sm px-4 py-2
                    rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear
                    transition-all duration-150"
                            type="button"
                            onclick="$('#deleteClient').submit();">
                        {{ __('Delete') }}
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
