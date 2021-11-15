@php
/**
 * @var App\Models\File $file
 */

use SimpleSoftwareIO\QrCode\Facades\QrCode;

$qrCode = QrCode::size(512)
            ->format('png')
            ->errorCorrection('H')
            ->merge('/public/assets/delta-technics-small.png', 0.3)
            ->generate(route('files.show', ['file' => $file]));
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

        <a href="{{ route('files.index') }}"
            class="bg-gray-700 hover:bg-gray-800 px-9 py-3 mb-3 text-white rounded inline-flex justify-center items-center">
             <x-heroicon-o-chevron-left class="h-4 w-4"/><span>Back</span>
         </a>

        <!-- Menu bar -->
        <div class="bg-white rounded-xl p-4 w-full mb-3">
            <h1 class="text-xl font-semibold mb-2 pb-1 border-b">File</h1>
            <div class="flex flex-wrap items-start gap-2">
                <p class="flex-grow"><strong>{{ $file->name }}</strong> made for client <strong>{{ $file->client->name }}</strong></p>
                <div class="flex justify-end flex-grow gap-2 w-full md:w-auto">
                    <a href="{{ route('files.edit', ['file' => $file]) }}"
                       class="bg-blue-600 hover:bg-blue-700 md:px-9 py-3 text-white rounded flex-grow md:flex-grow-0
                       flex justify-center items-center">
                        <x-heroicon-o-pencil class="h-4 w-4 mr-1"/>Edit
                    </a>
                    <a href="javascript:$('#deleteForm').submit();"
                       class="bg-red-600 hover:bg-red-700 md:px-9 py-3 text-white rounded flex-grow md:flex-grow-0
                       flex justify-center items-center">
                        <x-heroicon-o-trash class="h-4 w-4 mr-1"/>Delete
                    </a>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="grid gap-3 grid-cols-12">
            <div class="bg-white rounded-xl p-4 col-span-12 md:col-span-6 lg:col-span-5">
                <h2 class="font-semibold text-lg mb-1">General information</h2>
                <p>Created on: {{ $file->created_at }}</p>
                <p>Last edit: {{ $file->updated_at }}</p>
                <p>File number: {{ $file->fileId }}</p>
                <p>File name: {{ $file->name }}</p>
                @if($file->enclosureId)
                    <p>Enclosure: {{ $file->enclosureId }}</p>
                @endif
            </div>
            <div class="bg-white rounded-xl p-4 col-span-12 md:col-span-6 lg:col-span-5">
                <h2 class="font-semibold text-lg mb-1">Client information</h2>
                <p>Client number: {{ $file->client->clientNumber }}</p>
                <p>Client name: {{ $file->client->name }}</p>
                <p>Contact email: <a href="mailto:{{ $file->client->contactEmail }}" class="text-blue-500">{{ $file->client->contactEmail }}</a></p>
                <p>Contact phone number: <a href="tel:{{ $file->client->contactPhoneNumber }}" class="text-blue-500">{{ $file->client->contactPhoneNumber }}</a></p>
            </div>
            <div class="bg-white rounded-xl p-4 col-span-12 md:col-span-6 lg:col-span-2">
                <img id="qr-code" src="data:image/png;base64,{!! $qrCodeEncoded !!}" alt="">
                <a href="javascript:printJS('qr-code', 'html')"
                   class="bg-blue-600 hover:bg-blue-700 md:px-9 py-3 text-white rounded flex justify-center items-center mt-3">
                    <x-heroicon-o-printer class="h-4 w-4 mr-1"/>Print
                </a>
                <a href="data:image/png;base64,{!! $qrCodeEncoded !!}" download="qr-code.png"
                   class="bg-blue-600 hover:bg-blue-700 md:px-9 py-3 text-white rounded flex justify-center items-center mt-3">
                    <x-heroicon-o-download class="h-4 w-4 mr-1"/>Download
                </a>
            </div>
            <div class="bg-white rounded-xl p-4 col-span-12 md:col-span-6 lg:col-span-6 flex flex-col">
                <h2 class="font-semibold text-lg mb-1">Revisions</h2>
                @if(count($file->revisions) > 0)
                    <ul>
                        @foreach($file->revisions->sortByDesc('updated_at') as $revision)
                            <li>
                                {{-- TODO: Add link to revisions --}}
                                <a href="#" class="flex justify-between bg-white p-3 rounded-xl mb-2 shadow
                        border border-gray-400 border-opacity-25 hover:bg-gray-200 transition-colors duration-150 ease-in-out items-center">
                                    <div>
                                        <span>{{ $revision->revisionNumber }}</span>
                                        <br>
                                        <span class="opacity-50">Updated at: {{ $revision->updated_at }}</span>
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
                        <span class="text-center w-full">There are currently no revisions.</span>
                    </div>
                @endif
            </div>
            <div class="bg-white rounded-xl p-4 col-span-12 md:col-span-6 lg:col-span-6 flex flex-col">
                <h2 class="font-semibold text-lg mb-1">Revision requests</h2>
                @if(count($file->revisionRequests) > 0)
                    <ul>
                        @foreach($file->revisionRequests->sortByDesc('updated_at') as $revisionRequest)
                            <li>
                                {{-- TODO: Add link to revision requests --}}
                                <a href="#" class="flex justify-between bg-white p-3 rounded-xl mb-2 shadow
                        border border-gray-400 border-opacity-25 hover:bg-gray-200 transition-colors duration-150 ease-in-out items-center">
                                    <div>
                                        <span class="opacity-50">Updated at: {{ $revisionRequest->updated_at }}</span>
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
                        <span class="text-center w-full">There are currently no revision requests.</span>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
