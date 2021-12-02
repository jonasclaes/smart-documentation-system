@extends('layouts.app')

@section('content')

    <div class="container mx-auto px-3">
        <!-- Menu bar -->
        <div class="bg-white rounded-xl p-4 w-full mb-3">
            <h1 class="text-xl font-semibold">{{ __('Copy revision') }}</h1>
        </div>

        <!-- Content -->
        <div>
            <form action="{{ route('revisions.performCopy', ['file' => $file]) }}" method="POST" id="copyForm" class="grid grid-cols-1 lg:grid-cols-2 gap-3 items-start">
                @csrf
                @method("POST")
                <div class="bg-white rounded-xl p-4 grid grid-cols-1 gap-3">
                    <h2 class="font-semibold text-lg mb-1 pb-1 border-b">{{ __('Source') }}</h2>
                    <div>
                        <label for="sourceRevisionId">{{ __('Revision number') }} ({{ __('required') }}):</label>
                        <select name="sourceRevisionId" id="sourceRevisionId" class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full">
                            @foreach ($revisions as $revisionEntry)
                                @if( ! old('sourceRevisionId', false) && $loop->last)
                                    <option
                                        value="{{ $revisionEntry->id }}"
                                        selected>
                                        {{ $revisionEntry->file->name }} | {{ $revisionEntry->revisionNumber }}
                                    </option>
                                @else
                                    <option
                                        value="{{ $revisionEntry->id }}"
                                        @if(old('sourceRevisionId') == $revisionEntry->id) selected @endif>
                                        {{ $revisionEntry->file->name }} | {{ $revisionEntry->revisionNumber }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        <small class="opacity-50">{{ __('Select the source revision here.') }}</small>
                        @error('sourceRevisionId')
                        <br>
                        <small class="text-red-600 font-semibold">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="bg-white rounded-xl p-4 grid grid-cols-1 gap-3">
                    <h2 class="font-semibold text-lg mb-1 pb-1 border-b">{{ __('Destination') }}</h2>
                    <div>
                        <label for="revisionNumber">{{ __('Revision number') }} ({{ __('required') }}):</label>
                        <input type="text" name="revisionNumber" id="revisionNumber" class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full"
                               placeholder="{{ __('Revision number') }}" value="{{ old('revisionNumber') }}">
                        <small class="opacity-50">{{ __('Fill in the number of the revision here.') }}</small>
                        @error('revisionNumber')
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
                <x-heroicon-s-trash class="h-4 w-4 mr-1" /><span>{{ __('Discard') }}</span>
            </a>
            <a href="javascript:$('#copyForm').submit();"
                class="bg-green-600 hover:bg-green-700 md:px-9 py-3 mb-3 text-white rounded flex-grow md:flex-grow-0
                flex justify-center items-center">
                <x-heroicon-s-document-duplicate class="h-4 w-4 mr-1" /><span>{{ __('Copy') }}</span>
            </a>
        </div>
    </div>

@endsection
