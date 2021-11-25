@extends('layouts.page', ['topnav' => true])

@section('content')

    <div class="container mx-auto">
        <div class="grid gap-3 grid-cols-1">
            <div class="bg-white rounded-xl shadow-md p-4">
                <h1 class="text-xl font-semibold">{{ __('File') }}</h1>
                <small>{{ __('This file was last edited on') }} {{ $file->updated_at }}</small>
            </div>
            <div class="bg-white rounded-xl shadow-md p-4">
                <h1 class="text-xl font-semibold">{{ __('File') }}</h1>
            </div>
        </div>
    </div>

@endsection
