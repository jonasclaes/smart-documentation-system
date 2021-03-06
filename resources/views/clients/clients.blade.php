@extends('layouts.app')

@section('content')

    <div class="container mx-auto px-3">
        <!-- Menu bar -->
        <div class="bg-white rounded-xl p-4 w-full mb-3">
            <h1 class="text-xl font-semibold mb-2 pb-1 border-b">{{ __('Clients') }}</h1>
            <div class="flex flex-wrap items-start gap-2">
                <form action="{{ route('clients.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-2 w-full" id="clientSearch">
                    <input
                        type="text"
                        name="q"
                        class="px-0.5 border-0 border-b-2 border-gray-300 focus:ring-0 focus:border-black flex-grow"
                        placeholder="{{ __('Search client') }}"
                        value="">
                </form>
                <div class="flex justify-end flex-grow gap-2 w-full md:w-auto">
                    <a href="javascript:$('#clientSearch').submit();"
                       class="bg-gray-600 hover:bg-gray-700 md:px-9 py-3 text-white rounded flex-grow md:flex-grow-0
                       flex justify-center items-center">
                        <x-heroicon-s-search class="h-4 w-4 mr-1"></x-heroicon-s-search>{{ __('Search') }}
                    </a>
                    <a href="{{ route('clients.create') }}"
                       class="bg-green-600 hover:bg-green-700 md:px-9 py-3 text-white rounded flex-grow md:flex-grow-0
                       flex justify-center items-center">
                        <x-heroicon-s-plus class="h-4 w-4 mr-1"></x-heroicon-s-plus>{{ __('New') }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="bg-white rounded-xl p-4 w-full">
            {{ $clients->links() }}
            <br>
            <hr>
            <br>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-2">
                @if(count($clients) > 0)
                    @foreach($clients as $client)
                        <x-list-item
                            to="{{ route('clients.show', ['client' => $client->id]) }}"
                            title="{{ $client->name }}"
                            subtitle="{{ __('Client number') }}: {{ $client->clientNumber }}">
                        </x-list-item>
                    @endforeach
                @else
                    <p>{{ __('No clients have been found.') }}</p>
                @endif
            </div>
        </div>
    </div>

@endsection
