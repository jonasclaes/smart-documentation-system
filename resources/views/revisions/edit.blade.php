@php
/** @var App\Models\Revision $revision */
/** @var App\Models\File $file */
@endphp

@extends('layouts.app')

@section('content')

    <div class="container mx-auto px-3">
        <!-- Menu bar -->
        <div class="bg-white rounded-xl p-4 w-full mb-3">
            <h1 class="text-xl font-semibold">{{ __('Edit file') }}</h1>
        </div>

        <!-- Content -->
        <div class="bg-white rounded-xl p-4">
            <form action="{{ route('revisions.update', ['revision' => $revision, 'file' => $file]) }}" method="POST" id="editForm">
                @csrf
                @method("PUT")
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                    <div>
                        <label for="revisionNumber">{{ __('Revision number:') }}</label>
                        <input type="text" name="revisionNumber" id="revisionNumber" class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full"
                            placeholder="{{ __('Revision number') }}" value="{{ old('revisionNumber', $revision->revisionNumber) }}">
                        <small class="opacity-50">{{ __('Fill in the number of the revision here.') }}</small>
                        @error('revisionNumber')
                        <br>
                        <small class="text-red-600 font-semibold">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="fileId">{{ __('Client:') }}</label>
                        <select name="fileId" id="fileId" class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full">
                            @foreach ($files as $fileEntry)
                                <option
                                    value="{{ $fileEntry->id }}"
                                    @if(old('fileId', $revision->fileId) == $fileEntry->id) selected @endif>
                                    {{ $fileEntry->fileId }} - {{ $fileEntry->name }}
                                </option>
                            @endforeach
                        </select>
                        <small class="opacity-50">{{ __('Select the file of the revision here.') }}</small>
                        @error('fileId')
                        <br>
                        <small class="text-red-600 font-semibold">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <button type="submit" hidden></button>
            </form>
        </div>

        <div class="flex justify-end flex-grow gap-2 w-full md:w-auto mt-3">
            <a href="{{ url()->previous() }}"
                class="bg-red-600 hover:bg-red-700 px-9 py-3 mb-3 text-white rounded inline-flex justify-center items-center">
                <x-heroicon-o-trash class="h-4 w-4 mr-1" /><span>{{ __('Discard') }}</span>
            </a>
            <a href="javascript:$('#editForm').submit();"
                class="bg-green-600 hover:bg-green-700 md:px-9 py-3 mb-3 text-white rounded flex-grow md:flex-grow-0
                flex justify-center items-center">
                <x-heroicon-o-pencil class="h-4 w-4 mr-1" /><span>{{ __('Save') }}</span>
            </a>
        </div>
    </div>

@endsection
