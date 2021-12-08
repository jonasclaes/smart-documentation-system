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
           class="bg-sky-500 hover:bg-sky-600 px-9 py-3 mb-3 text-white rounded flex md:inline-flex justify-center items-center">
            <x-heroicon-s-chevron-left class="h-4 w-4 mr-1"></x-heroicon-s-chevron-left>{{ __('Back to file') }}
        </a>

        <div class="grid gap-3 grid-cols-1 md:grid-cols-2">
            <!-- Section: Header -->
            <div class="bg-white dark:bg-coolGray-800 dark:text-white rounded-xl shadow-md p-4 col-span-full">
                <h1 class="text-xl font-semibold">{{ __('Revision request') }}: {{ $revisionRequest->name }}</h1>
                <small class="text-gray-400 dark:text-gray-300">{{ __('This revision request was created on') }} {{ $revisionRequest->created_at }}</small>
            </div>

            <!-- Section: General -->
            <div class="bg-white dark:bg-coolGray-800 dark:text-white rounded-xl shadow-md p-4 col-span-full">
                <h1 class="text-xl font-semibold">{{ __('General') }}</h1>
                <p>{{ __('Status') }}: <strong>{{ $revisionRequest->submitted ? 'Awaiting approval' : 'Awaiting submission' }}</strong></p>
                <p>{{ __('Change category') }}: <strong>{{ $revisionRequest->revisionCategory->name }}</strong></p>
                <p>{{ __('This revision request was made by') }}: <strong>{{ $revisionRequest->technicianLastName }}, {{ $revisionRequest->technicianFirstName }}</strong></p>
                <p>{{ __('Technician e-mail') }}: <strong>{{ $revisionRequest->technicianEmail }}</strong></p>
                <!-- Actions -->
                <div class="grid gap-3 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 justify-center mt-2">
                    @if( ! $revisionRequest->submitted)
                        <a href="{{ route('public.revisionRequests.edit', ['file' => $file, 'revisionRequest' => $revisionRequest]) }}"
                           class="bg-sky-600 hover:bg-sky-700 py-2 px-4 text-white rounded inline-flex justify-center items-center w-full">
                            <x-heroicon-s-pencil-alt class="h-4 w-4"></x-heroicon-s-pencil-alt>&nbsp;{{ __('Edit change request') }}
                        </a>
                        <a href="{{ route('public.revisionRequests.attachments.create', ['file' => $file, 'revisionRequest' => $revisionRequest]) }}"
                           class="bg-sky-600 hover:bg-sky-700 py-2 px-4 text-white rounded inline-flex justify-center items-center w-full">
                            <x-heroicon-s-upload class="h-4 w-4"></x-heroicon-s-upload>&nbsp;{{ __('Upload attachment(s)') }}
                        </a>
                        <a href="{{ route('public.revisionRequests.attachments.create', ['file' => $file, 'revisionRequest' => $revisionRequest]) }}"
                           class="bg-sky-600 hover:bg-sky-700 py-2 px-4 text-white rounded inline-flex justify-center items-center w-full">
                            <x-heroicon-s-plus class="h-4 w-4"></x-heroicon-s-plus>&nbsp;{{ __('Add comment') }}
                        </a>
                        <div class="bg-gray-100 dark:bg-coolGray-500 rounded hidden xl:block"></div>
                    @else
                        <div class="bg-gray-100 dark:bg-coolGray-500 rounded block h-10"></div>
                        <div class="bg-gray-100 dark:bg-coolGray-500 rounded hidden sm:block"></div>
                        <div class="bg-gray-100 dark:bg-coolGray-500 rounded hidden lg:block"></div>
                        <div class="bg-gray-100 dark:bg-coolGray-500 rounded hidden xl:block"></div>
                    @endif
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
                            <form method="POST" action="{{ route('public.revisionRequests.attachments.delete', ['file' => $file, 'revisionRequest' => $revisionRequest, 'revisionRequestDocument' => $attachment]) }}" id="deleteForm-{{ $attachment->id }}">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $attachment->id }}">
                            </form>
                            <div class="flex justify-between bg-white p-3 rounded-xl shadow border border-gray-400 border-opacity-25 hover:bg-gray-200 transition-colors duration-150 ease-in-out items-center dark:bg-coolGray-700 dark:text-white dark:border-gray-800 dark:hover:bg-gray-500">
                                <div>
                                    <span>{{ $attachment->fileName }}</span>
                                    <br>
                                    <span class="opacity-50">{{ __('Size') }}: {{ \App\Helpers\ByteHelper::toHuman($attachment->size) }}</span>
                                </div>
                                <div class="flex gap-0">
                                    <a href="javascript:$('#deleteForm-{{ $attachment->id }}').submit();">
                                        <x-heroicon-s-trash class="h-6 w-6 text-red-500"></x-heroicon-s-trash>
                                    </a>
                                </div>
                            </div>
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
