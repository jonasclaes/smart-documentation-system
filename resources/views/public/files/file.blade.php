@php
/**
 * @var \App\Models\File $file
 */
@endphp

@extends('layouts.page', ['topnav' => true])

@section('content')

    <div class="container mx-auto">
        <div class="grid gap-3 grid-cols-1">
            <div class="bg-white dark:bg-coolGray-800 dark:text-white rounded-xl shadow-md p-4">
                <h1 class="text-xl font-semibold">{{ __('File') }}</h1>
                <small class="text-gray-400 dark:text-gray-300">{{ __('This file was last edited on') }} {{ $file->updated_at }}</small>
            </div>
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
        </div>
    </div>

@endsection
