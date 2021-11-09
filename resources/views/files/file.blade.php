@php /** @var App\Models\File $file */ @endphp

@extends('layouts.app')

@section('content')

    <div class="container mx-auto px-3">
        <!-- Menu bar -->
        <div class="bg-white rounded-xl p-4 w-full mb-3">
            <h1 class="text-xl font-semibold mb-2 pb-1 border-b">File</h1>
            <p><strong>{{ $file->name }}</strong> made for client <strong>{{ $file->client->name }}</strong></p>
        </div>

        <!-- Content -->
        <div class="grid gap-3 grid-cols-12">
            <div class="bg-white rounded-xl p-4 col-span-12 md:col-span-6 lg:col-span-5">
                <h2 class="font-semibold text-lg">General information</h2>
                <p>Created on: {{ $file->created_at }}</p>
                <p>Last edit: {{ $file->updated_at }}</p>
                <p>File number: {{ $file->fileId }}</p>
                <p>File name: {{ $file->name }}</p>
                @if($file->enclosureId)
                    <p>Enclosure: {{ $file->enclosureId }}</p>
                @endif
            </div>
            <div class="bg-white rounded-xl p-4 col-span-12 md:col-span-6 lg:col-span-5">
                <h2 class="font-semibold text-lg">Client information</h2>
                <p>Client number: {{ $file->client->clientNumber }}</p>
                <p>Client name: {{ $file->client->name }}</p>
                <p>Contact email: <a href="mailto:{{ $file->client->contactEmail }}" class="text-blue-500">{{ $file->client->contactEmail }}</a></p>
                <p>Contact phone number: <a href="tel:{{ $file->client->contactPhoneNumber }}" class="text-blue-500">{{ $file->client->contactPhoneNumber }}</a></p>
            </div>
            <div class="bg-white rounded-xl p-4 col-span-12 md:col-span-6 lg:col-span-2">
                <img src="data:image/png;base64,{!! base64_encode(\SimpleSoftwareIO\QrCode\Facades\QrCode::size(512)->format('png')->errorCorrection('H')->generate(route('files.show', ['file' => $file]))) !!}" alt="">
            </div>
            <div class="bg-white rounded-xl p-4 col-span-12 md:col-span-6 lg:col-span-6">
                <h2 class="font-semibold text-lg">Revisions</h2>
            </div>
            <div class="bg-white rounded-xl p-4 col-span-12 md:col-span-6 lg:col-span-6">
                <h2 class="font-semibold text-lg">Revision requests</h2>
            </div>
        </div>
    </div>

@endsection
