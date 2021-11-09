@extends('layouts.app')

@section('content')

    <div class="container mx-auto px-3">
        <!-- Menu bar -->
        <div class="bg-white rounded-xl p-4 w-full mb-3">
            <h1 class="text-xl font-semibold mb-2 pb-1 border-b">Files</h1>
            <form action="{{ route('files') }}" method="GET" class="flex gap-4">
                <div class="flex-initial">
                    <input
                        type="text"
                        name="clientName"
                        class="block px-0.5 border-0 border-b-2 border-gray-300 focus:ring-0 focus:border-black"
                        placeholder="Client name"
                        value="{{ old('clientName') }}">
                </div>
                <div class="flex-initial">
                    <input
                        type="text"
                        name="documentName"
                        class="block px-0.5 border-0 border-b-2 border-gray-300 focus:ring-0 focus:border-black"
                        placeholder="Document name"
                        value="{{ old('documentName') }}">
                </div>
                <div class="flex w-full justify-end">
                    <button type="submit" class="w-32 h-full bg-gray-700 text-white rounded-md">Search</button>
                </div>
            </form>
        </div>

        <!-- Content -->
        <div class="bg-white rounded-xl p-4 w-full">
            <x-files-list :files="$files"></x-files-list>
        </div>
    </div>

@endsection
