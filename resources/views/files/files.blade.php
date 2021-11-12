@extends('layouts.app')

@section('content')

    <div class="container mx-auto px-3">
        <!-- Menu bar -->
        <div class="bg-white rounded-xl p-4 w-full mb-3">
            <h1 class="text-xl font-semibold mb-2 pb-1 border-b">Files</h1>
            <div class="flex flex-wrap items-start gap-2">
                <form action="{{ route('files.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-2 w-full" id="searchForm">
                    <input
                        type="text"
                        name="clientName"
                        class="px-0.5 border-0 border-b-2 border-gray-300 focus:ring-0 focus:border-black flex-grow"
                        placeholder="Client name"
                        value="{{ old('clientName') }}">
                    <input
                        type="text"
                        name="documentName"
                        class="px-0.5 border-0 border-b-2 border-gray-300 focus:ring-0 focus:border-black flex-grow"
                        placeholder="Document name"
                        value="{{ old('documentName') }}">
                    <button type="submit" hidden></button>
                </form>
                <div class="flex justify-end flex-grow gap-2 w-full md:w-auto">
                    <a href="javascript:$('#searchForm').submit();"
                       class="bg-gray-600 hover:bg-gray-700 md:px-9 py-3 text-white rounded flex-grow md:flex-grow-0
                       flex justify-center items-center">
                        <x-heroicon-o-search class="h-4 w-4 mr-1"/>Search
                    </a>
                    <a href="{{ route('files.create') }}"
                       class="bg-green-600 hover:bg-green-700 md:px-9 py-3 text-white rounded flex-grow md:flex-grow-0
                       flex justify-center items-center">
                        <x-heroicon-o-plus class="h-4 w-4 mr-1"/>New
                    </a>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="bg-white rounded-xl p-4 w-full">
            <x-files-list :files="$files"></x-files-list>
        </div>
    </div>

@endsection
