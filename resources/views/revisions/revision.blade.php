@php
    /**
     * @var App\Models\Revision $revision
     * @var App\Models\File     $file
     *
     */
@endphp

@extends('layouts.app')

@section('content')

    <div class="container mx-auto px-3">
        <!-- Delete form -->
        <form action="{{ route('revisions.destroy', ['revision' => $revision, 'file' => $file]) }}" method="POST"
              id="deleteForm">
            @csrf
            @method('DELETE')
        </form>

        <div class="mb-3 md:flex">
            <a href="{{ route('files.show', ['file' => $file]) }}" class="flex items-center justify-center p-2 rounded bg-sky-600 hover:bg-sky-700 text-white">
                <x-heroicon-s-chevron-left
                    class="h-6 w-6"></x-heroicon-s-chevron-left><span>{{ __('Back to file') }}</span>
            </a>
        </div>

        <!-- Menu bar -->
        <div class="bg-white rounded-xl p-4 w-full mb-3">
            <h1 class="text-xl font-semibold mb-2 pb-1 border-b">{{ __('Revision') }}</h1>
            <div class="flex flex-wrap items-start gap-2">
                <p class="flex-grow text-gray-400">{{ __('Revision :revisionNumber was last updated on :lastUpdate.', ['revisionNumber' => $revision->revisionNumber, 'lastUpdate' => $revision->updated_at]) }}</p>
                <div class="flex justify-end flex-grow gap-2 w-full md:w-auto">
                    <a href="{{ route('revisions.edit', ['revision' => $revision, 'file' => $file]) }}"
                       class="bg-blue-600 hover:bg-blue-700 md:px-9 py-3 text-white rounded flex-grow md:flex-grow-0
                       flex justify-center items-center">
                        <x-heroicon-s-pencil class="h-4 w-4 mr-1"></x-heroicon-s-pencil>{{ __('Edit') }}
                    </a>
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
                <p>{{ __('Created on:') }} {{ $revision->created_at }}</p>
                <p>{{ __('Last edit:') }} {{ $revision->updated_at }}</p>
                <p>{{ __('Revision number:') }} {{ $revision->revisionNumber }}</p>
                <p class="break-all">{{ __('Belongs to file: :fileUniqueId', ['fileUniqueId' => $file->uniqueId]) }}</p>
            </div>

            <!-- Section: Attachments -->
            <div class="grid gap-3 grid-cols-1 self-start">
                <!-- Title block -->
                <div class="bg-white rounded-xl p-4">
                    <h2 class="font-semibold text-lg mb-1">{{ __('Attachments') }}</h2>

                    <!-- Action buttons -->
                    <div class="grid gap-3 grid-cols-1 xl:grid-cols-2 justify-center">
                        <a href="{{ route('revisions.attachments.create', ['file' => $file, 'revision' => $revision]) }}"
                           class="bg-green-600 hover:bg-green-700 py-2 px-4 text-white rounded inline-flex justify-center items-center w-full text-center">
                            <x-heroicon-s-upload
                                class="h-4 w-4 mr-1"></x-heroicon-s-upload>{{ __('Upload attachment(s)') }}
                        </a>
                        <a href="{{ route('revisions.attachments.createDirectory', ['file' => $file, 'revision' => $revision]) }}"
                           class="bg-green-600 hover:bg-green-700 py-2 px-4 text-white rounded inline-flex justify-center items-center w-full text-center">
                            <x-heroicon-s-upload class="h-4 w-4 mr-1"></x-heroicon-s-upload>{{ __('Upload directory') }}
                        </a>
                    </div>
                </div>

                <!-- Attachments -->
                <div class="bg-white rounded-xl p-4">
                    @if(count($revision->documents) > 0)
                        <div class="grid grid-cols-1 gap-2">
                            <h3 class="font-semibold border-b">Documents</h3>
                            @foreach($revision->documents->where('category', '=', 'document') as $document)
                                <div
                                    class="flex justify-between bg-white p-3 rounded-xl shadow border border-gray-400 border-opacity-25
        hover:bg-gray-200 transition-colors duration-150 ease-in-out items-center dark:bg-coolGray-700 dark:text-white
        dark:border-gray-800 dark:hover:bg-gray-500 cursor-pointer">
                                    <div>
                                        <span>{{ $document->fileName }}</span>
                                        <br>
                                        <span
                                            class="text-gray-400">{{ __('Size') }}: {{ \App\Helpers\ByteHelper::toHuman($document->size) }}</span>
                                    </div>
                                    <div class="flex">
                                        <a href="{{ route('revisions.attachments.download', ['file' => $file, 'revision' => $revision, 'document' => $document]) }}">
                                            <x-heroicon-s-download
                                                class="h-6 w-6 text-blue-600"></x-heroicon-s-download>
                                        </a>
                                        <a href="{{ route('revisions.attachments.show', ['file' => $file, 'revision' => $revision, 'document' => $document]) }}">
                                            <x-heroicon-s-chevron-right
                                                class="h-6 w-6 opacity-25"></x-heroicon-s-chevron-right>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                            <h3 class="font-semibold border-b">Images</h3>
                            @foreach($revision->documents->where('category', '=', 'image') as $document)
                                <div
                                    class="flex justify-between bg-white p-3 rounded-xl shadow border border-gray-400 border-opacity-25
        hover:bg-gray-200 transition-colors duration-150 ease-in-out items-center dark:bg-coolGray-700 dark:text-white
        dark:border-gray-800 dark:hover:bg-gray-500 cursor-pointer">
                                    <div>
                                        <span>{{ $document->fileName }}</span>
                                        <br>
                                        <span
                                            class="text-gray-400">{{ __('Size') }}: {{ \App\Helpers\ByteHelper::toHuman($document->size) }}</span>
                                    </div>
                                    <div class="flex">
                                        <a href="{{ route('revisions.attachments.download', ['file' => $file, 'revision' => $revision, 'document' => $document]) }}">
                                            <x-heroicon-s-download
                                                class="h-6 w-6 text-blue-600"></x-heroicon-s-download>
                                        </a>
                                        <a href="{{ route('revisions.attachments.show', ['file' => $file, 'revision' => $revision, 'document' => $document]) }}">
                                            <x-heroicon-s-chevron-right
                                                class="h-6 w-6 opacity-25"></x-heroicon-s-chevron-right>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                            <h3 class="font-semibold border-b">Software</h3>
                            @foreach($revision->documents->where('category', '=', 'software') as $document)
                                <div
                                    class="flex justify-between bg-white p-3 rounded-xl shadow border border-gray-400 border-opacity-25
        hover:bg-gray-200 transition-colors duration-150 ease-in-out items-center dark:bg-coolGray-700 dark:text-white
        dark:border-gray-800 dark:hover:bg-gray-500 cursor-pointer">
                                    <div>
                                        <span>{{ $document->fileName }}</span>
                                        <br>
                                        <span
                                            class="text-gray-400">{{ __('Size') }}: {{ \App\Helpers\ByteHelper::toHuman($document->size) }}</span>
                                    </div>
                                    <div class="flex">
                                        <a href="{{ route('revisions.attachments.download', ['file' => $file, 'revision' => $revision, 'document' => $document]) }}">
                                            <x-heroicon-s-download
                                                class="h-6 w-6 text-blue-600"></x-heroicon-s-download>
                                        </a>
                                        <a href="{{ route('revisions.attachments.show', ['file' => $file, 'revision' => $revision, 'document' => $document]) }}">
                                            <x-heroicon-s-chevron-right
                                                class="h-6 w-6 opacity-25"></x-heroicon-s-chevron-right>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                            <h3 class="font-semibold border-b">Other</h3>
                            @foreach($revision->documents->where('category', '=', 'other') as $document)
                                <div
                                    class="flex justify-between bg-white p-3 rounded-xl shadow border border-gray-400 border-opacity-25
        hover:bg-gray-200 transition-colors duration-150 ease-in-out items-center dark:bg-coolGray-700 dark:text-white
        dark:border-gray-800 dark:hover:bg-gray-500 cursor-pointer">
                                    <div>
                                        <span>{{ $document->fileName }}</span>
                                        <br>
                                        <span
                                            class="text-gray-400">{{ __('Size') }}: {{ \App\Helpers\ByteHelper::toHuman($document->size) }}</span>
                                    </div>
                                    <div class="flex">
                                        <a href="{{ route('revisions.attachments.download', ['file' => $file, 'revision' => $revision, 'document' => $document]) }}">
                                            <x-heroicon-s-download
                                                class="h-6 w-6 text-blue-600"></x-heroicon-s-download>
                                        </a>
                                        <a href="{{ route('revisions.attachments.show', ['file' => $file, 'revision' => $revision, 'document' => $document]) }}">
                                            <x-heroicon-s-chevron-right
                                                class="h-6 w-6 opacity-25"></x-heroicon-s-chevron-right>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="flex-grow flex items-center">
                            <span class="text-center w-full">{{ __('There are no attachments.') }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Section: Comments -->
            <div class="grid gap-3 grid-cols-1 self-start">
                <!-- Title block -->
                <div class="bg-white rounded-xl p-4">
                    <h2 class="font-semibold text-lg mb-1">{{ __('Comments') }}</h2>

                    <!-- Action buttons -->
                    <div class="grid gap-3 grid-cols-1 xl:grid-cols-2 justify-center">
                        <a href="{{ route('revisions.comments.create', ['file' => $file, 'revision' => $revision]) }}"
                           class="bg-green-600 hover:bg-green-700 py-2 px-4 text-white rounded inline-flex justify-center items-center w-full">
                            <x-heroicon-s-plus class="h-4 w-4 mr-1"></x-heroicon-s-plus>{{ __('New comment') }}
                        </a>
                        <div class="bg-gray-100 rounded h-10"></div>
                    </div>
                </div>

                <!-- Comments -->
                <div class="bg-white rounded-xl p-4">
                    <div class="grid grid-cols-1 gap-2">
                        @if(count($revision->comments) > 0)
                            @foreach($revision->comments->sortByDesc('updated_at') as $comment)
                                <x-list-item
                                    to="{{ route('revisions.comments.show', ['file' => $file, 'revision' => $revision, 'comment' => $comment]) }}"
                                    title="{{ $comment->content }}"
                                    subtitle="{{ __('Last Update') }}: {{ $comment->created_at }}">
                                </x-list-item>
                            @endforeach
                        @else
                            <div class="flex-grow flex items-center">
                                <span class="text-center w-full">{{ __('There are no comments.') }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
