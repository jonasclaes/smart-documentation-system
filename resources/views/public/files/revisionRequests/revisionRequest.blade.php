@php
/**
 * @var \App\Models\File $file
 */
@endphp

@extends('layouts.page', ['topnav' => true])

@section('content')

    <div class="container mx-auto">
        <div class="grid gap-3 grid-cols-1 md:grid-cols-2">
            <!-- Section: Header -->
            <div class="bg-white dark:bg-coolGray-800 dark:text-white rounded-xl shadow-md p-4 col-span-full">
                <h1 class="text-xl font-semibold">{{ __('Revision request') }}: {{ $revisionRequest->name }}</h1>
                <small class="text-gray-400 dark:text-gray-300">{{ __('This revision request was created on') }} {{ $revisionRequest->created_at }}</small>
            </div>

            <!-- Section: General -->
            <div class="bg-white dark:bg-coolGray-800 dark:text-white rounded-xl shadow-md p-4 col-span-full">
                <h1 class="text-xl font-semibold">{{ __('General') }}</h1>
                <p>{{ __('Change category') }}: <strong>{{ $revisionRequest->revisionCategory->name }}</strong></p>
                <p>{{ __('This revision request was made by') }}: <strong>{{ $revisionRequest->technicianLastName }}, {{ $revisionRequest->technicianFirstName }}</strong></p>
                <p>{{ __('Technician e-mail') }}: <strong>{{ $revisionRequest->technicianEmail }}</strong></p>
                <!-- Actions -->
                <div class="grid gap-3 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 justify-center mt-2">
                    <div class="bg-gray-100 dark:bg-coolGray-500 rounded block h-10"></div>
                    <div class="bg-gray-100 dark:bg-coolGray-500 rounded hidden sm:block"></div>
                    <div class="bg-gray-100 dark:bg-coolGray-500 rounded hidden lg:block"></div>
                    <div class="bg-gray-100 dark:bg-coolGray-500 rounded hidden xl:block"></div>
                </div>
            </div>

            <!-- Section: Files -->
            <div class="bg-white dark:bg-coolGray-800 dark:text-white rounded-xl shadow-md p-4 self-start" id="sectionFiles">
                <h1 class="text-xl font-semibold">{{ __('Attachments') }}</h1>
                <!-- Attachments -->
                <div class="grid grid-cols-1 gap-2 mt-1">
                @if(count($revisionRequest->revisionDocuments) > 0)
                    @foreach($revisionRequest->revisionDocuments as $attachment)
                        <!-- Attachment -->
                            <x-list-item
                                to="{{ route('public.downloadDocument', ['file' => $file, 'revision' => $revision, 'document' => $attachment]) }}"
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
                @if(count($revisionRequest->revisionComments) > 0)
                    @foreach($revisionRequest->revisionComments as $comment)
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
