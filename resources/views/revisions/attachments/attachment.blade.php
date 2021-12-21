@php
/**
 * @var App\Models\File     $file
 * @var App\Models\Revision $revision
 * @var App\Models\Document $document
 */
@endphp

@extends('layouts.app')

@section('content')

    <div class="container mx-auto px-3">
        <!-- Delete form -->
        <form action="{{ route('revisions.attachments.destroy', ['file' => $file, 'revision' => $revision, 'document' => $document]) }}" method="POST" id="deleteForm">
            @csrf
            @method('DELETE')
        </form>

        <div class="mb-3 md:flex">
            <a href="{{ route('revisions.show', ['file' => $file, 'revision' => $revision]) }}" class="flex items-center justify-center p-2 rounded bg-sky-600 hover:bg-sky-700 text-white">
                <x-heroicon-s-chevron-left
                    class="h-6 w-6"></x-heroicon-s-chevron-left><span>{{ __('Back to revision') }}</span>
            </a>
        </div>

        <!-- Menu bar -->
        <div class="bg-white rounded-xl p-4 w-full mb-3">
            <h1 class="text-xl font-semibold mb-2 pb-1 border-b">{{ __('Attachment') }}</h1>
            <div class="flex flex-wrap items-start gap-2">
                <p class="flex-grow text-gray-400">{{ __('Attachment :fileName was created on :createdOn.', ['fileName' => $document->fileName, 'createdOn' => $document->created_at]) }}</p>
                <div class="flex justify-end flex-grow gap-2 w-full md:w-auto">
                    <a href="javascript:$('#deleteForm').submit();"
                       class="bg-red-600 hover:bg-red-700 md:px-9 py-3 text-white rounded flex-grow md:flex-grow-0
                       flex justify-center items-center">
                        <x-heroicon-s-trash class="h-4 w-4 mr-1"></x-heroicon-s-trash>{{ __('Delete') }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="grid gap-3 grid-cols-1 lg:grid-cols-3 items-start">
            <!-- Section: General information -->
            <div class="bg-white rounded-xl p-4">
                <h2 class="font-semibold text-lg mb-1">{{ __('General information') }}</h2>
                <p>{{ __('Created on') }}: {{ $document->created_at }}</p>
                <p>{{ __('Last edit') }}: {{ $document->updated_at }}</p>
                <p>{{ __('File name') }}: {{ $document->fileName }}</p>
                <p>{{ __('Size') }}: {{ \App\Helpers\ByteHelper::toHuman($document->size) }}</p>
            </div>

            <!-- Section: Connected revisions -->
            <div class="bg-white rounded-xl p-4">
                <h2 class="font-semibold text-lg mb-1">{{ __('Revisions') }}</h2>
                <p>{{ __('This attachment is connected to the following revisions:') }}</p>
                <div class="grid grid-cols-1 gap-2">
                    @foreach($document->revisions->sortByDesc('created_at') as $revisionEntry)
                        <x-list-item
                            to="{{ route('revisions.show', ['file' => $revisionEntry->file, 'revision' => $revisionEntry]) }}"
                            title="{{ $revisionEntry->revisionNumber }}"
                            subtitle="{{ __('Created on') }}: {{ $revisionEntry->created_at }}">
                        </x-list-item>
                    @endforeach
                </div>
            </div>

            <!-- Section: Download -->
            <div class="bg-white rounded-xl p-4">
                <h2 class="font-semibold text-lg mb-1">{{ __('Download') }}</h2>
                <!-- Action buttons -->
                <div class="grid gap-3 grid-cols-1 justify-center">
                    <a href="{{ route('revisions.attachments.download', ['file' => $file, 'revision' => $revision, 'document' => $document]) }}"
                       class="bg-blue-600 hover:bg-blue-700 py-2 px-4 text-white rounded inline-flex justify-center items-center w-full">
                        <x-heroicon-s-download class="h-4 w-4 mr-1"></x-heroicon-s-download>{{ __('Download') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
