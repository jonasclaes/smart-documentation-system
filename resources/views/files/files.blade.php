@extends('layouts.app')

@section('content')

    <div class="container mx-auto px-3">
        <!-- Menu bar -->
        <div class="bg-white rounded-xl p-4 w-full mb-3">
            <h1 class="text-xl font-semibold">Files</h1>
            <p>Zoek met de velden hieronder.</p>
            <div class="flex gap-4">
                <div class="flex-initial">
                    <input type="text" class="block px-0.5 border-0 border-b-2 border-gray-300 focus:ring-0 focus:border-black" placeholder="Klant naam">
                </div>
                <div class="flex-initial">
                    <input type="text" class="block px-0.5 border-0 border-b-2 border-gray-300 focus:ring-0 focus:border-black" placeholder="Document naam">
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="bg-white rounded-xl p-4 w-full">
            <x-files-list files="20"></x-files-list>
        </div>
    </div>

@endsection
