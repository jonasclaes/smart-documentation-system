@php
    /**
     * @var App\Models\Revision $revision
     * @var App\Models\File     $file
     */
@endphp

@extends('layouts.app')

@section('content')

    <div class="container mx-auto px-3">
        <!-- Delete form -->
        <form action="{{ route('revisions.destroy', ['revision' => $revision, 'file' => $file]) }}" method="POST" id="deleteForm">
            @csrf
            @method('DELETE')
        </form>

        <!-- Back Button -->
        <a href="{{ route('files.show', ['file' => $file]) }}"
            class="bg-gray-700 hover:bg-gray-800 px-9 py-3 mb-3 text-white rounded inline-flex justify-center items-center">
             <x-heroicon-o-chevron-left class="h-4 w-4"/><span>{{ __('Back') }}</span>
         </a>

        <!-- Menu bar -->
        <div class="bg-white rounded-xl p-4 w-full mb-3">
            <h1 class="text-xl font-semibold mb-2 pb-1 border-b">{{ __('Revision') }}</h1>
            <div class="flex flex-wrap items-start gap-2">
                <p class="flex-grow">{{ __('Revision :revisionNumber was last updated on :lastUpdate.', ['revisionNumber' => $revision->revisionNumber, 'lastUpdate' => $revision->updated_at]) }}</p>
                <div class="flex justify-end flex-grow gap-2 w-full md:w-auto">
                    <a href="{{ route('revisions.edit', ['revision' => $revision, 'file' => $file]) }}"
                       class="bg-blue-600 hover:bg-blue-700 md:px-9 py-3 text-white rounded flex-grow md:flex-grow-0
                       flex justify-center items-center">
                        <x-heroicon-o-pencil class="h-4 w-4 mr-1"/>{{ __('Edit') }}
                    </a>
                    <a href="javascript:$('#deleteForm').submit();"
                       class="bg-red-600 hover:bg-red-700 md:px-9 py-3 text-white rounded flex-grow md:flex-grow-0
                       flex justify-center items-center">
                        <x-heroicon-o-trash class="h-4 w-4 mr-1"/>{{ __('Delete') }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="grid gap-3 grid-cols-3 items-start">
            <div class="bg-white rounded-xl p-4 col-span-3 md:col-span-1">
                <h2 class="font-semibold text-lg mb-1">{{ __('General information') }}</h2>
                <p>{{ __('Created on:') }} {{ $revision->created_at }}</p>
                <p>{{ __('Last edit:') }} {{ $revision->updated_at }}</p>
                <p>{{ __('Revision number:') }} {{ $revision->revisionNumber }}</p>
                <p>{{ __('Belongs to file: :fileUniqueId', ['fileUniqueId' => $file->uniqueId]) }}</p>
            </div>
            <div class="bg-white rounded-xl p-4 col-span-3 md:col-span-1">
                <h2 class="font-semibold text-lg mb-1">{{ __('Files') }}</h2>

            </div>
            <div class="bg-white rounded-xl p-4 col-span-3 md:col-span-1">
                <h2 class="font-semibold text-lg mb-1">{{ __('Comments') }}</h2>

            </div>
        </div>
    </div>

@endsection
