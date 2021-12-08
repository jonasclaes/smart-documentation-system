@php
/**
 * @var \App\Models\File $file
 */
@endphp

@extends('layouts.page', ['topnav' => true])

@section('content')

    <div class="container mx-auto">
        <!-- Section: Back button -->
        <a href="{{ route('public.showFile', ['file' => $file]) }}"
           class="bg-sky-500 hover:bg-sky-600 px-9 py-3 mb-3 text-white rounded inline-flex justify-center items-center">
            <x-heroicon-s-chevron-left class="h-4 w-4 mr-1"></x-heroicon-s-chevron-left>{{ __('Back to file') }}
        </a>

        <div class="grid gap-3 grid-cols-1 md:grid-cols-2">
            <!-- Section: Header -->
            <div class="bg-white dark:bg-coolGray-800 dark:text-white rounded-xl shadow-md p-4 col-span-full">
                <h1 class="text-xl font-semibold">{{ __('Revision') }}: {{ $revision->revisionNumber }}</h1>
                <small class="text-gray-400 dark:text-gray-300">{{ __('This revision was last edited on') }} {{ $revision->updated_at }}</small>
                <!-- Actions -->
                <div class="grid gap-3 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 justify-center mt-2">
                    <a href="#sectionFiles"
                       class="bg-sky-600 hover:bg-sky-700 py-2 px-4 text-white rounded inline-flex justify-center items-center w-full">
                        <x-heroicon-s-document-duplicate class="h-4 w-4"></x-heroicon-s-document-duplicate>&nbsp;{{ __('Go to attachments') }}
                    </a>
                    <a href="#sectionComments"
                       class="bg-sky-600 hover:bg-sky-700 py-2 px-4 text-white rounded inline-flex justify-center items-center w-full">
                        <x-heroicon-s-annotation class="h-4 w-4"></x-heroicon-s-annotation>&nbsp;{{ __('Go to comments') }}
                    </a>
                    <div class="bg-gray-100 dark:bg-coolGray-500 rounded hidden lg:block"></div>
                    <div class="bg-gray-100 dark:bg-coolGray-500 rounded hidden xl:block"></div>
                </div>
            </div>

            <!-- Section: Files -->
            <div class="bg-white dark:bg-coolGray-800 dark:text-white rounded-xl shadow-md p-4 self-start" id="sectionFiles">
                <h1 class="text-xl font-semibold">{{ __('Attachments') }}</h1>
                <!-- Attachments -->
                <div class="grid grid-cols-1 gap-2 mt-1">
                    @if(count($revision->documents) > 0)
                        @foreach($revision->documents as $attachment)
                            <!-- Attachment -->
                            <x-list-item
                                to="{{ route('public.revisionRequests.download', ['file' => $file, 'revision' => $revision, 'document' => $attachment]) }}"
                                title="{{ $attachment->fileName }}"
                                subtitle="{{ __('Size') }}: {{ \App\Helpers\ByteHelper::toHuman($attachment->size) }}"></x-list-item>
                        @endforeach
                    @else
                        <div class="flex-grow flex items-center">
                            <span class="text-center w-full">{{ __('There are no attachments.') }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Section: Comments -->
            <div class="bg-white dark:bg-coolGray-800 dark:text-white rounded-xl shadow-md p-4 self-start" id="sectionComments">
                <h1 class="text-xl font-semibold">{{ __('Comments') }}</h1>

                <!-- Comments -->
                <div class="grid grid-cols-1 gap-2 mt-1">
                    @if(count($revision->comments) > 0)
                        @foreach($revision->comments as $comment)
                            <!-- Comment -->
                            <x-list-item
                                title="{{ $comment->content }}"
                                subtitle="{{ __('Last updated on') }}: {{ $comment->updated_at }}"></x-list-item>
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

@endsection
