@php
    /**
     * @var App\Models\File $file
     */
@endphp

@extends('layouts.app')

@section('content')

    <div class="container mx-auto px-3">
        <!-- Menu bar -->
        <div class="bg-white rounded-xl p-4 w-full mb-3">
            <h1 class="text-xl font-semibold">{{ __('Create comment') }}</h1>
        </div>

        <!-- Content -->
        <div class="bg-white rounded-xl p-4">
            <form action="{{ route('revisions.comments.store', [$file, $revision]) }}" method="POST" id="createComment">
                @csrf
                @method("POST")
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                    <div>
                        <label for="revisionId">{{ __('This comment will be attached to Revision: ') }}</label>
                        <select name="revisionId" id="revisionId"
                                class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full">
                            @foreach ($revisions as $revisionEntry)
                                <option
                                    value="{{ $revisionEntry->id }}"
                                    @if(old('revisionId', $revision->id) == $revisionEntry->id) selected @endif>
                                    {{ $revisionEntry->file->name }} - {{ $revisionEntry->revisionNumber }}
                                </option>
                            @endforeach
                        </select>
                        <small>{{ __('Select the revision that this comment needs to be attached to.') }}</small>
                        @error('fileId')
                        <br>
                        <small class="text-red-600 font-semibold">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="content">{{ __('Comment') }} ({{ __('required') }}):</label>
                        <textarea form="createComment" name="content" id="content" rows="10" class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full" placeholder="{{ __('Enter your comment here.') }}"></textarea>
                        <small>{{ __('Fill in the comment you want to attach here.') }}</small>
                        @error('content')
                        <br>
                        <small class="text-red-600 font-semibold">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="hidden"></button>
            </form>
        </div>

        <div class="flex justify-end flex-grow gap-2 w-full md:w-auto mt-3">
            <a href="{{ route('revisions.show', ['file'=>$file, 'revision'=>$revision]) }}"
               class="bg-red-600 hover:bg-red-700 px-9 py-3 mb-3 text-white rounded inline-flex justify-center items-center">
                <x-heroicon-s-trash class="h-4 w-4 mr-1"></x-heroicon-s-trash>{{ __('Discard') }}
            </a>
            <a href="javascript:$('#createComment').submit();"
               class="bg-green-600 hover:bg-green-700 md:px-9 py-3 mb-3 text-white rounded flex-grow md:flex-grow-0
                flex justify-center items-center">
                <x-heroicon-s-pencil class="h-4 w-4 mr-1"></x-heroicon-s-pencil>{{ __('Save') }}
            </a>
        </div>
    </div>

@endsection
