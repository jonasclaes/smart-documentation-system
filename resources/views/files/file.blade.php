@php
/**
 * @var App\Models\File $file
 */

use SimpleSoftwareIO\QrCode\Facades\QrCode;

$qrCode = QrCode::size(512)
            ->format('png')
            ->errorCorrection('H')
            ->merge('/public/assets/delta-technics-small.png', 0.3)
            ->generate($file->QRCode->content);
$qrCodeEncoded = base64_encode($qrCode);
@endphp

@extends('layouts.app')

@section('content')

    <div class="container mx-auto px-3">
        <!-- Delete form -->
        <form action="{{ route('files.destroy', ['file' => $file]) }}" method="POST" id="deleteForm">
            @csrf
            @method('DELETE')
        </form>

        <!-- Back Button -->
        <a href="{{ route('files.index') }}"
            class="bg-gray-700 hover:bg-gray-800 px-9 py-3 mb-3 text-white rounded inline-flex justify-center items-center">
             <x-heroicon-o-chevron-left class="h-4 w-4"/><span>{{ __('Back') }}</span>
         </a>

        <!-- Menu bar -->
        <div class="bg-white rounded-xl p-4 w-full mb-3">
            <h1 class="text-xl font-semibold mb-2 pb-1 border-b">{{ __('File') }}</h1>
            <div class="flex flex-wrap items-start gap-2">
                <p class="flex-grow"><strong>{{ $file->name }}</strong> {{ __('made for client') }} <strong>{{ $file->client->name }}</strong></p>
                <div class="flex justify-end flex-grow gap-2 w-full md:w-auto">
                    <a href="{{ route('files.edit', ['file' => $file]) }}"
                       class="bg-blue-600 hover:bg-blue-700 md:px-9 py-3 text-white rounded flex-grow md:flex-grow-0
                       flex justify-center items-center">
                        <x-heroicon-o-pencil class="h-4 w-4 mr-1"/>{{ __('Edit') }}
                    </a>
                    <a href="javascript:$('#deleteForm').submit();"
                       class="bg-red-600 hover:bg-red-700 md:px-9 py-3 text-white rounded flex-grow md:flex-grow-0
                       flex justify-center items-center">
                        <x-heroicon-o-trash class="h-4 w-4 mr-1"/>{{ __('Delete') }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="grid gap-3 grid-cols-12">
            <div class="bg-white rounded-xl p-4 col-span-12 md:col-span-6 lg:col-span-5">
                <h2 class="font-semibold text-lg mb-1">{{ __('General information') }}</h2>
                <p>{{ __('Created on:') }} {{ $file->created_at }}</p>
                <p>{{ __('Last edit:') }} {{ $file->updated_at }}</p>
                <p>{{ __('File number:') }} {{ $file->fileId }}</p>
                <p>{{ __('File name:') }} {{ $file->name }}</p>
                @if($file->enclosureId)
                    <p>{{ __('Enclosure:') }} {{ $file->enclosureId }}</p>
                @endif
                <p>{{ __('Unique ID:') }} {{ $file->uniqueId }}</p>
                <p>{{ trans_choice('This file has been opened once.|This file has been opened :amount times.', $file->QRCode->scanCount, ['amount' => $file->QRCode->scanCount]) }}</p>
                <p class="break-all">{{ __('Public link:') }} <a href="{{ $file->QRCode->content }}" class="text-blue-500">{{ $file->QRCode->content }}</a></p>
            </div>
            <div class="bg-white rounded-xl p-4 col-span-12 md:col-span-6 lg:col-span-4 xl:col-span-5">
                <h2 class="font-semibold text-lg mb-1">{{ __('Client information') }}</h2>
                <p>{{ __('Client number:') }} {{ $file->client->clientNumber }}</p>
                <p>{{ __('Client name:') }} {{ $file->client->name }}</p>
                <p>{{ __('Contact email:') }} <a href="mailto:{{ $file->client->contactEmail }}" class="text-blue-500">{{ $file->client->contactEmail }}</a></p>
                <p>{{ __('Contact phone number:') }} <a href="tel:{{ $file->client->contactPhoneNumber }}" class="text-blue-500">{{ $file->client->contactPhoneNumber }}</a></p>
            </div>
            <div class="bg-white rounded-xl p-4 col-span-12 md:col-span-6 lg:col-span-3 xl:col-span-2">
                <img id="qr-code" src="data:image/png;base64,{!! $qrCodeEncoded !!}" alt="{{ $file->QRCode->content }}">
                <div class="grid gap-3 grid-cols-1 mt-3 justify-items-center">
                    <a href="javascript:printJS('qr-code', 'html')"
                       class="bg-blue-600 hover:bg-blue-700 py-2 px-4 text-white rounded inline-flex justify-center items-center w-full">
                        <x-heroicon-o-printer class="h-4 w-4"/>&nbsp;{{ __('Print') }}
                    </a>
                    <a href="data:image/png;base64,{!! $qrCodeEncoded !!}" download="qr-code.png"
                       class="bg-blue-600 hover:bg-blue-700 py-2 px-4 text-white rounded inline-flex justify-center items-center w-full">
                        <x-heroicon-o-download class="h-4 w-4"/>&nbsp;{{ __('Download') }}
                    </a>
                </div>
            </div>

            <!-- Section: Revisions -->
            <div class="col-span-12 md:col-span-6 grid gap-3 grid-cols-1 self-start">
                <!-- Title bar -->
                <div class="bg-white rounded-xl p-4">
                    <h2 class="font-semibold text-lg mb-1">{{ __('Revisions') }}</h2>
                    <!-- Actions -->
                    <div class="grid gap-3 grid-cols-1 md:grid-cols-2 xl:grid-cols-3 justify-center">
                        <a href="{{ route('revisions.create', ['file' => $file]) }}"
                           class="bg-green-600 hover:bg-green-700 py-2 px-4 text-white rounded inline-flex justify-center items-center w-full">
                            <x-heroicon-o-plus class="h-4 w-4"/>&nbsp;{{ __('New') }}
                        </a>
                        <div class="bg-gray-100 rounded hidden md:block"></div>
                        <div class="bg-gray-100 rounded hidden xl:block"></div>
                    </div>
                </div>

                <!-- Revisions -->
                <div class="bg-white rounded-xl p-4 flex flex-col">
                    @if(count($file->revisions) > 0)
                        <ul>
                            @foreach($file->revisions->sortByDesc('created_at') as $revision)
                                <li>
                                    <a href="{{ route('revisions.show', ['revision' => $revision, 'file' => $file]) }}" class="flex justify-between bg-white p-3 rounded-xl mb-2 shadow
                        border border-gray-400 border-opacity-25 hover:bg-gray-200 transition-colors duration-150 ease-in-out items-center">
                                        <div>
                                            <span>{{ $revision->revisionNumber }}</span>
                                            <br>
                                            <span class="opacity-50">{{ __('Created at:') }} {{ $revision->created_at }}</span>
                                        </div>
                                        <div>
                                            <x-heroicon-o-chevron-right class="h-6 w-6 opacity-25"/>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="flex-grow flex items-center">
                            <span class="text-center w-full">{{ __('There are currently no revisions.') }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Section: Revision requests -->
            <div class="col-span-12 md:col-span-6 grid gap-3 grid-cols-1 self-start">
                <div class="bg-white rounded-xl p-4">
                    <h2 class="font-semibold text-lg mb-1">{{ __('Revision requests') }}</h2>
                    <!-- Actions -->
                    <div class="grid gap-3 grid-cols-1 md:grid-cols-2 xl:grid-cols-3 justify-center">
                        <div class="bg-gray-100 rounded h-10"></div>
                        <div class="bg-gray-100 rounded hidden md:block"></div>
                        <div class="bg-gray-100 rounded hidden xl:block"></div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-4 flex flex-col">
                    @if(count($file->revisionRequests) > 0)
                        <ul>
                            @foreach($file->revisionRequests->sortByDesc('updated_at') as $revisionRequest)
                                <li>
                                    {{-- TODO: Add link to revision requests --}}
                                    <a href="#" class="flex justify-between bg-white p-3 rounded-xl mb-2 shadow
                        border border-gray-400 border-opacity-25 hover:bg-gray-200 transition-colors duration-150 ease-in-out items-center">
                                        <div>
                                            <span class="opacity-50">{{ __('Updated at:') }} {{ $revisionRequest->updated_at }}</span>
                                        </div>
                                        <div>
                                            <x-heroicon-o-chevron-right class="h-6 w-6 opacity-25"/>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="flex-grow flex items-center">
                            <span class="text-center w-full">{{ __('There are currently no revision requests.') }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
