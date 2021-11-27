@php
/**
 * @var \App\Models\File $file
 */
@endphp

@extends('layouts.page', ['topnav' => true])

@section('content')

    <div class="container mx-auto">
        <div class="grid gap-3 grid-cols-1">
            <!-- Section: Header -->
            <div class="bg-white dark:bg-coolGray-800 dark:text-white rounded-xl shadow-md p-4">
                <h1 class="text-xl font-semibold">{{ __('File') }}</h1>
                <small class="text-gray-400 dark:text-gray-300">{{ __('This file was last edited on') }} {{ $file->updated_at }}</small>
            </div>

            <!-- Section: General -->
            <div class="bg-white dark:bg-coolGray-800 dark:text-white rounded-xl shadow-md p-4">
                <h1 class="text-xl font-semibold">{{ __('General') }}</h1>
                <p>{{ __('You are viewing the documentation for file') }}: <strong>{{ $file->name }}</strong></p>
                @if($file->enclosureId) <p>{{ __('Enclosure') }}: <strong>{{ $file->enclosureId }}</strong></p> @endif
                <p>{{ __('This documentation is applicable for client') }}: <strong>{{ $file->client->name }}</strong></p>
                <!-- Actions -->
                <div class="grid gap-3 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 justify-center mt-2">
                    <a href="#"
                       class="bg-sky-600 hover:bg-sky-700 py-2 px-4 text-white rounded inline-flex justify-center items-center w-full">
                        <x-heroicon-s-paper-airplane class="h-4 w-4 transform rotate-45"></x-heroicon-s-paper-airplane>&nbsp;{{ __('E-mail me this page') }}
                    </a>
                    <div class="bg-gray-100 dark:bg-coolGray-500 rounded hidden sm:block"></div>
                    <div class="bg-gray-100 dark:bg-coolGray-500 rounded hidden lg:block"></div>
                    <div class="bg-gray-100 dark:bg-coolGray-500 rounded hidden xl:block"></div>
                </div>
            </div>

            <!-- Section: Revisions -->
            <div class="bg-white dark:bg-coolGray-800 dark:text-white rounded-xl shadow-md p-4 flex flex-col gap-3">
                <h1 class="text-xl font-semibold">{{ __('Revisions') }}</h1>
                <!-- Timeline -->
                <div class="grid grid-cols-1 text-gray-50 p-4">
                    @foreach($file->revisions->sortByDesc('created_at') as $revision)
                        <!-- Timeline item -->
                        <div class="flex">
                            <!-- Timeline line with circle-->
                            <div class="mr-10 relative">
                                <div @class(['absolute w-4 md:w-5 flex items-center justify-center' => true, 'h-full' => ! $loop->first && ! $loop->last, 'h-1/2' => $loop->first || $loop->last, 'top-1/2' => $loop->first])>
                                    <div class="h-full w-1 bg-sky-600 pointer-events-none"></div>
                                </div>
                                <div class="w-4 h-4 md:w-5 md:h-5 absolute top-1/2 -mt-3 rounded-full bg-sky-600 shadow text-center"></div>
                            </div>
                            <!-- Revision -->
                            <x-list-item
                                title="{{ $revision->revisionNumber }}"
                                subtitle="{{ __('Created at:') }} {{ $revision->created_at }}"
                                class="bg-white dark:bg-coolGray-700 dark:text-white flex justify-between p-3
                                rounded-xl shadow border border-gray-400 dark:border-gray-800 border-opacity-25 hover:bg-gray-200 dark:hover:bg-gray-500 transition-colors duration-150 ease-in-out items-center w-full my-2 text-black"></x-list-item>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
