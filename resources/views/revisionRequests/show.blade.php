@extends('layouts.app')

@section('content')

    <div class="container mx-auto px-3">
        <!-- Delete form -->
        <form action="#" method="POST" id="deleteForm">
            @csrf
            @method('DELETE')
        </form>

        <!-- Back Button -->
        <a href="{{ route('files.show', ['file' => $file]) }}"
           class="bg-gray-700 hover:bg-gray-800 px-9 py-3 mb-3 text-white rounded inline-flex justify-center items-center">
            <x-heroicon-s-chevron-left class="h-4 w-4"></x-heroicon-s-chevron-left><span>{{ __('Back to file') }}</span>
        </a>

        <!-- Menu bar -->
        <div class="bg-white rounded-xl shadow-md p-4 w-full mb-3">
            <h1 class="text-xl font-semibold mb-2 pb-1 border-b">{{ __('Revision request') }}</h1>
            <div class="flex flex-wrap items-start gap-2">
                <p class="flex-grow"><strong>{{ $revisionRequest->name }}</strong> {{ __('made by') }} <strong>{{$revisionRequest->technicianLastName }}, {{$revisionRequest->technicianFirstName }}</strong></p>
                <div class="flex justify-end flex-grow gap-2 w-full md:w-auto">
                    <a href="#"
                       class="bg-blue-600 hover:bg-blue-700 md:px-9 py-3 text-white rounded flex-grow md:flex-grow-0 flex justify-center items-center">
                        <x-heroicon-s-pencil class="h-4 w-4 mr-1"></x-heroicon-s-pencil><span>{{ __('Edit') }}</span>
                    </a>
                    <a href="javascript:$('#deleteForm').submit();"
                       class="bg-red-600 hover:bg-red-700 md:px-9 py-3 text-white rounded flex-grow md:flex-grow-0 flex justify-center items-center">
                        <x-heroicon-s-trash class="h-4 w-4 mr-1"></x-heroicon-s-trash><span>{{ __('Delete') }}</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="grid gap-3 grid-cols-4">
            <div class="bg-white rounded-xl shadow-md p-4 col-span-2">
                <h2 class="font-semibold text-lg mb-1">{{ __('General information') }}</h2>
                <p>{{ __('Created on') }}: <strong>{{ $revisionRequest->created_at }}</strong></p>
                <p>{{ __('Last edit') }}: <strong>{{ $revisionRequest->updated_at }}</strong></p>
                <p>{{ __('Name') }}: <strong>{{ $revisionRequest->name }}</strong></p>
                <p>{{ __('Submitted') }}: <strong>{{ $revisionRequest->submitted ? 'Yes' : 'No' }}</strong></p>
                <p>{{ __('Category') }}: <strong>{{ $revisionRequest->revisionCategory->name }}</strong></p>
                <p>{{ __('Description') }}: <strong>{{ $revisionRequest->description }}</strong></p>
            </div>
            <div class="bg-white rounded-xl shadow-md p-4 col-span-2">
                <h2 class="font-semibold text-lg mb-1">{{ __('Information about the submitter') }}</h2>
                <p>{{ __('First name') }}: <strong>{{ $revisionRequest->technicianFirstName }}</strong></p>
                <p>{{ __('Last name') }}: <strong>{{ $revisionRequest->technicianLastName }}</strong></p>
                <p>{{ __('E-mail') }}: <strong>{{ $revisionRequest->technicianEmail }}</strong></p>
            </div>
            <div class="bg-white rounded-xl shadow-md p-4 col-span-2 self-start">
                <h2 class="font-semibold text-lg mb-1">{{ __('Attachments') }}</h2>
                <!-- Attachments -->
                <div class="grid grid-cols-1 gap-3">
                    @if(count($revisionRequest->revisionDocuments) > 0)
                        @foreach($revisionRequest->revisionDocuments as $attachment)
                            <form method="POST" action="{{ route('revisionRequestDocuments.destroy', ['file' => $file, 'revisionRequest' => $revisionRequest, 'revisionRequestDocument' => $attachment]) }}" id="deleteAttachmentForm-{{ $attachment->id }}" class="hidden">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $attachment->id }}">
                            </form>
                            <div class="flex justify-between bg-white p-3 rounded-xl shadow border border-gray-400 border-opacity-25
        hover:bg-gray-200 transition-colors duration-150 ease-in-out items-center dark:bg-coolGray-700 dark:text-white
        dark:border-gray-800 dark:hover:bg-gray-500">
                                <div>
                                    <span>{{ $attachment->fileName }}</span>
                                    <br>
                                    <span class="text-gray-400">{{ __('Size') }}: {{ \App\Helpers\ByteHelper::toHuman($attachment->size) }}</span>
                                </div>
                                <div class="flex gap-1">
                                    <a href="{{ route('revisionRequestDocuments.download', ['file' => $file, 'revisionRequest' => $revisionRequest, 'revisionRequestDocument' => $attachment]) }}">
                                        <x-heroicon-s-download class="h-6 w-6 text-blue-500"></x-heroicon-s-download>
                                    </a>
                                    <a href="javascript:$('#deleteAttachmentForm-{{ $attachment->id }}').submit();">
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
            <div class="bg-white rounded-xl shadow-md p-4 col-span-2 self-start">
                <h2 class="font-semibold text-lg mb-1">{{ __('Comments') }}</h2>
                <!-- Attachments -->
                <div class="grid grid-cols-1 gap-3">
                    @if(count($revisionRequest->revisionComments) > 0)
                        @foreach($revisionRequest->revisionComments as $comment)
                            <div class="flex justify-between bg-white p-3 rounded-xl shadow border border-gray-400 border-opacity-25 hover:bg-gray-200 transition-colors duration-150 ease-in-out items-center dark:bg-coolGray-700 dark:text-white dark:border-gray-800 dark:hover:bg-gray-500">
                                <div>
                                    <span>{{ $comment->content }}</span>
                                    <br>
                                    <span class="text-gray-400">{{ __('Last updated on') }}: {{ $comment->updated_at }}</span>
                                </div>
                                <div class="flex gap-0">
{{--                                    <a href="javascript:$('#deleteAttachmentForm-{{ $attachment->id }}').submit();">--}}
{{--                                        <x-heroicon-s-trash class="h-6 w-6 text-red-500"></x-heroicon-s-trash>--}}
{{--                                    </a>--}}
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
        </div>
    </div>

@endsection
