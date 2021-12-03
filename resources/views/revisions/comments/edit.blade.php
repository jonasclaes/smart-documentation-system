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
            <h1 class="text-xl font-semibold">{{ __('Edit Comment') }}</h1>
            <p class="flex-grow text-gray-400">{{ __('Comment :id for file :file ', ['id' => $comment->id, 'file'=> $file->name] )}}</p>
        </div>

        <!-- Content -->
        <div class="bg-white rounded-xl p-4">
            <form action="{{ route('revisions.comments.update', [$file, $revision, $comment]) }}" method="POST" id="editComment"
                  enctype="multipart/form-data">
                @csrf
                @method("POST")
                <div class="grid-cols-12 pt-3">
                    <h1>Comment</h1>
                    <textarea form="editComment" name="content" id="content" rows="10" class="border p-2 rounded w-full">{{old('content', $comment->content)}}</textarea>
                </div>
                <button type="submit" hidden></button>
            </form>
        </div>

        <div class="flex justify-end flex-grow gap-2 w-full md:w-auto mt-3">
            <a href="{{ route('revisions.show', ['file'=>$file, 'revision'=>$revision]) }}"
               class="bg-red-600 hover:bg-red-700 px-9 py-3 mb-3 text-white rounded inline-flex justify-center items-center">
                <x-heroicon-s-trash class="h-4 w-4 mr-1"></x-heroicon-s-trash>{{ __('Discard') }}
            </a>
            <a href="javascript:$('#editComment').submit();"
               class="bg-green-600 hover:bg-green-700 md:px-9 py-3 mb-3 text-white rounded flex-grow md:flex-grow-0
                flex justify-center items-center">
                <x-heroicon-s-pencil class="h-4 w-4 mr-1"></x-heroicon-s-pencil>{{ __('Update') }}
            </a>
        </div>
    </div>

@endsection
