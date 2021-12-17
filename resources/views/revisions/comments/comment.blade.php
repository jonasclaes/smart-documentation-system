@php
    /**
     * @var App\Models\File     $file
     * @var App\Models\Revision $revision
     * @var App\Models\Comment $comment
     * @var App\Models\Document $document
     */
@endphp

@extends('layouts.app')

@section('content')

    <div class= "container mx-auto px-3">
        <!-- Delete form -->
        <form action="{{ route('revisions.comments.destroy', ['file' => $file, 'revision' => $revision, 'comment' => $comment])}}" method="POST" id="deleteComment">
            @csrf
            @method('DELETE')
        </form>

        <div class="mb-3 md:flex">
            <a href="{{ route('revisions.show', ['file' => $file, 'revision' => $revision]) }}" class="flex items-center justify-center p-2 rounded bg-sky-600 hover:bg-sky-700 text-white">
                <x-heroicon-s-chevron-left
                    class="h-6 w-6"></x-heroicon-s-chevron-left><span>{{ __('Back to revision') }}</span>
            </a>
        </div>

        <!-- Menu bar -->
        <div class="bg-white rounded-xl p-4 w-full mb-3">
            <h1 class="text-xl font-semibold mb-2 pb-1 border-b">{{ __('Comment') }}</h1>
            <div class="flex flex-wrap items-start gap-2">
                <p class="flex-grow text-gray-400">{{ __('Comment :id was created on :created_at for file :file ', ['id' => $comment->id, 'created_at' => $comment->created_at, 'file'=> $file->name] )}}</p>
                <div class="flex justify-end flex-grow gap-2 w-full md:w-auto">
                    <a href="{{ route('revisions.comments.edit', ['revision' => $revision, 'file' => $file, 'comment' => $comment]) }}"
                       class="bg-blue-600 hover:bg-blue-700 md:px-9 py-3 text-white rounded flex-grow md:flex-grow-0
                       flex justify-center items-center">
                        <x-heroicon-s-pencil class="h-4 w-4 mr-1"></x-heroicon-s-pencil>{{ __('Edit') }}
                    </a>
                    <a href="javascript:$('#deleteComment').submit();"
                       class="bg-red-600 hover:bg-red-700 md:px-9 py-3 text-white rounded flex-grow md:flex-grow-0
                       flex justify-center items-center">
                        <x-heroicon-s-trash class="h-4 w-4 mr-1"></x-heroicon-s-trash>{{ __('Delete') }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="grid gap-3 w-full items-start">
            <!-- Section: General information -->
            <div class="bg-white rounded-xl p-4">
                <h2 class="font-semibold text-lg mb-1">{{ __('Comment information') }}</h2>
                <p class="flex-grow pb-2 text-gray-400">{{ __('Latest update: :updated_at ', ['updated_at' => $comment->updated_at])}}</p>
                <p>{{ $comment->content }}</p>
            </div>
        </div>
    </div>
    </div>

@endsection
