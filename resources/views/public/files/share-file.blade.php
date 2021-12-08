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
                <h1 class="text-xl font-semibold">{{ __('Share file') }}</h1>
            </div>

            <!-- Section: General -->
            <div class="bg-white dark:bg-coolGray-800 dark:text-white rounded-xl shadow-md p-4">
                <form action="{{ route('public.revisionRequests.performShareFile', ['file' => $file]) }}" method="POST" id="shareFileForm">
                    @csrf
                    @method("POST")
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                        <div>
                            <label for="email">{{ __('E-mail:') }}</label>
                            <input type="email" name="email" id="email" class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full"
                                   placeholder="john.doe@example.com" value="{{ old('email') }}">
                            <small class="opacity-50">{{ __('Fill in your e-mail address here.') }}</small>
                            @error('email')
                            <br>
                            <small class="text-red-600 font-semibold">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" hidden></button>
                    <!-- Actions -->
                    <div class="grid gap-3 grid-cols-1 justify-center mt-2">
                        <a href="javascript:$('#shareFileForm').submit();"
                           class="bg-sky-600 hover:bg-sky-700 py-2 px-4 text-white rounded inline-flex justify-center items-center w-full">
                            <x-heroicon-s-paper-airplane class="h-4 w-4 transform rotate-45"></x-heroicon-s-paper-airplane>&nbsp;{{ __('E-mail me this page') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
