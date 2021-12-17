@extends('layouts.page', ['topnav' => true])

@section('content')

    <div class="container mx-auto px-3">
        <!-- Menu bar -->
        <div class="bg-white rounded-xl p-4 w-full mb-3">
            <h1 class="text-xl font-semibold">{{ __('Upload attachment(s)') }}</h1>
        </div>

        <!-- Content -->
        <div class="bg-white rounded-xl p-4">
            <form action="{{ route('public.revisionRequests.attachments.store', ['file' => $file, 'revisionRequest' => $revisionRequest]) }}" method="POST" id="uploadForm" enctype="multipart/form-data">
                @csrf
                @method("POST")
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                    <x-forms.input-block.file
                        label="{{ __('Attachment(s)') }} ({{ __('required') }}):"
                        name="files[]"
                        helpText="Select the attachment(s) to be uploaded here."
                        customProperties="multiple">
                    </x-forms.input-block.file>
                </div>
                <button type="submit" hidden></button>
            </form>
        </div>

        <div class="flex justify-end flex-grow gap-2 w-full md:w-auto mt-3">
            <a href="{{ route('public.revisionRequests.show', ['file' => $file, 'revisionRequest' => $revisionRequest]) }}"
               class="bg-red-600 hover:bg-red-700 px-9 py-3 mb-3 text-white rounded inline-flex justify-center items-center">
                <x-heroicon-s-trash class="h-4 w-4 mr-1"></x-heroicon-s-trash>{{ __('Discard') }}
            </a>
            <a href="javascript:$('#uploadForm').submit();"
               class="bg-green-600 hover:bg-green-700 md:px-9 py-3 mb-3 text-white rounded flex-grow md:flex-grow-0
                flex justify-center items-center">
                <x-heroicon-s-upload class="h-4 w-4 mr-1" ></x-heroicon-s-upload>{{ __('Upload') }}
            </a>
        </div>
    </div>

@endsection
