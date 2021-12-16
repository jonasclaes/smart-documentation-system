@extends('layouts.app')

@section('content')

    <div class="container mx-auto px-3">
        <!-- Menu bar -->
        <div class="bg-white rounded-xl shadow-md p-4 mb-3">
            <h1 class="text-xl font-bold">{{ __('Dashboard') }}</h1>
        </div>

        <!-- Content -->
        <div class="grid gap-3 grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-6">
            <!-- Statistics -->
            <div class="hidden sm:grid grid-cols-2 md:grid-cols-4 xl:grid-cols-7 gap-3 col-span-full">
                <!-- Users -->
                <div class="bg-gradient-to-br from-sky-500 to-blue-700 text-white rounded-xl shadow-md p-4">
                    <div class="flex justify-between">
                        <p class="font-semibold">{{ __('Users') }}</p>
                        <p class="font-semibold">{{ \App\Models\User::count() }}</p>
                    </div>
                </div>

                <!-- Clients -->
                <div class="bg-gradient-to-br from-sky-500 to-blue-700 text-white rounded-xl shadow-md p-4">
                    <div class="flex justify-between">
                        <p class="font-semibold">{{ __('Clients') }}</p>
                        <p class="font-semibold">{{ \App\Models\Client::count() }}</p>
                    </div>
                </div>

                <!-- Files -->
                <div class="bg-gradient-to-br from-sky-500 to-blue-700 text-white rounded-xl shadow-md p-4">
                    <div class="flex justify-between">
                        <p class="font-semibold">{{ __('Files') }}</p>
                        <p class="font-semibold">{{ \App\Models\File::count() }}</p>
                    </div>
                </div>

                <!-- Revisions -->
                <div class="bg-gradient-to-br from-sky-500 to-blue-700 text-white rounded-xl shadow-md p-4">
                    <div class="flex justify-between">
                        <p class="font-semibold">{{ __('Revisions') }}</p>
                        <p class="font-semibold">{{ \App\Models\Revision::count() }}</p>
                    </div>
                </div>

                <!-- Attachments -->
                <div class="bg-gradient-to-br from-sky-500 to-blue-700 text-white rounded-xl shadow-md p-4">
                    <div class="flex justify-between">
                        <p class="font-semibold">{{ __('Attachments') }}</p>
                        <p class="font-semibold">{{ \App\Models\Document::count() }}</p>
                    </div>
                </div>

                <!-- Comments -->
                <div class="bg-gradient-to-br from-sky-500 to-blue-700 text-white rounded-xl shadow-md p-4">
                    <div class="flex justify-between">
                        <p class="font-semibold">{{ __('Comments') }}</p>
                        <p class="font-semibold">{{ \App\Models\Comment::count() }}</p>
                    </div>
                </div>

                <!-- QR-scans -->
                <div class="bg-gradient-to-br from-sky-500 to-blue-700 text-white rounded-xl shadow-md p-4">
                    <div class="flex justify-between">
                        <p class="font-semibold">{{ __('QR-scans') }}</p>
                        <p class="font-semibold">{{ \App\Models\QRCode::sum('scanCount') }}</p>
                    </div>
                </div>
            </div>

            <!-- Open revision requests -->
            @if(request()->user()->can('view-any', \App\Models\RevisionRequest::class))
            <div class="bg-white rounded-xl shadow-md p-4 col-span-1 lg:col-span-2 xl:col-span-3">
                <h2 class="text-lg font-semibold mb-2">{{ __('Open revision requests') }} ({{ count($revisionRequests) }})</h2>
                @if(count($revisionRequests) > 0)
                    <div class="grid grid-cols-1 gap-3">
                        @foreach($revisionRequests as $revisionRequest)
                            <x-list-item
                                to="{{ route('revisionRequests.show', ['file' => $revisionRequest->file, 'revisionRequest' => $revisionRequest]) }}"
                                title="{{ $revisionRequest->name }}"
                                subtitle="{{ __('File') }}: {{ $revisionRequest->file->name }}"
                                :labels="[['color' => 'sky', 'text' => __('Status') . ': ' . ($revisionRequest->submitted ? 'awaiting approval' : 'awaiting submission')]]">
                            </x-list-item>
                        @endforeach
                    </div>
                @else
                    <div class="flex-grow flex items-center">
                        <span
                            class="text-center w-full">{{ __('There are currently no open revision requests.') }}</span>
                    </div>
                @endif
            </div>
            @endif
        </div>
    </div>

@endsection

