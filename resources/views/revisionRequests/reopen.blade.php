@extends('layouts.app')

@section('content')

    <div class="container mx-auto px-3">
        <!-- Menu bar -->
        <div class="bg-white rounded-xl shadow-md p-4 w-full mb-3">
            <h1 class="text-xl font-semibold mb-2 pb-1 border-b">{{ __('Reopen revision request') }}</h1>
            <div class="flex flex-wrap items-start gap-2">
                <p class="flex-grow"><strong>{{ $revisionRequest->name }}</strong> {{ __('made by') }} <strong>{{$revisionRequest->technicianLastName }}, {{$revisionRequest->technicianFirstName }}</strong></p>
            </div>
        </div>

        <!-- Content -->
        <div class="bg-white rounded-xl p-4">
            <form action="{{ route('revisionRequests.doReopen', [$file, $revisionRequest]) }}" method="POST" id="reopenForm" enctype="multipart/form-data">
                @csrf
                @method("POST")
                <div class="grid grid-cols-1gap-3">
                    <div>
                        <label for="message">{{ __('Message') }} ({{ __('required') }}):</label>
                        <textarea name="message" id="message" cols="30" rows="10" class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full">{{ old('message') }}</textarea>
                        <small class="text-gray-400">{{ __('Enter a message for the technician here.') }}</small>
                        @error('message')
                        <br>
                        <small class="text-red-600 font-semibold">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </form>
        </div>

        <div class="flex justify-end flex-grow gap-2 w-full md:w-auto mt-3">
            <a href="{{ route('revisionRequests.show', [$file, $revisionRequest]) }}"
               class="bg-red-600 hover:bg-red-700 px-9 py-3 mb-3 text-white rounded inline-flex justify-center items-center">
                <x-heroicon-s-trash class="h-4 w-4 mr-1"></x-heroicon-s-trash>{{ __('Discard') }}
            </a>
            <a href="javascript:$('#reopenForm').submit();"
               class="bg-green-600 hover:bg-green-700 md:px-9 py-3 mb-3 text-white rounded flex-grow md:flex-grow-0
                flex justify-center items-center">
                <x-heroicon-s-refresh class="h-4 w-4 mr-1" ></x-heroicon-s-refresh>{{ __('Reopen') }}
            </a>
        </div>
    </div>

@endsection
