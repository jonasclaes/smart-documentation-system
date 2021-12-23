@extends('layouts.app')

@section('content')

    <div class="container mx-auto px-3">
        <!-- Menu bar -->
        <div class="bg-white rounded-xl shadow-md p-4 mb-3">
            <h1 class="text-xl font-bold">{{ __('System Logs') }}</h1>
        </div>

        <!-- Content -->
        <div class="grid gap-3 grid-cols-1">
            <div class="bg-white rounded-xl shadow-md p-4 mb-3">
                @foreach ($logFile as $entry)
                    <p class="my-1">{{ $entry }}</p>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>

@endsection

