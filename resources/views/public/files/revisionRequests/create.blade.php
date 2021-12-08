@extends('layouts.page', ['topnav' => true])

@section('content')

    <div class="container mx-auto">
        <!-- Menu bar -->
        <div class="bg-white rounded-xl p-4 w-full mb-3">
            <h1 class="text-xl font-semibold">{{ __('Create revision request') }}</h1>
        </div>

        <!-- Content -->
        <div>
            <form action="{{ route('public.revisionRequests.store', ['file' => $file]) }}" method="POST" id="createForm">
                @csrf
                @method("POST")
                <input type="hidden" name="fileId" value="{{ $file->id }}">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 items-start">
                    <div class="bg-white rounded-xl shadow-md p-4">
                        <h2 class="text-lg font-semibold">Personal details</h2>
                        <div>
                            <label for="technicianFirstName">{{ __('First name') }} ({{ __('required') }}):</label>
                            <input type="text" name="technicianFirstName" id="technicianFirstName" class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full"
                                   placeholder="{{ __('First name') }}" value="{{ old('technicianFirstName') }}">
                            <small class="opacity-50">{{ __('Fill in your own first name here.') }}</small>
                            @error('technicianFirstName')
                            <br>
                            <small class="text-red-600 font-semibold">{{ $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <label for="technicianLastName">{{ __('Last name') }} ({{ __('required') }}):</label>
                            <input type="text" name="technicianLastName" id="technicianLastName" class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full"
                                   placeholder="{{ __('Last name') }}" value="{{ old('technicianLastName') }}">
                            <small class="opacity-50">{{ __('Fill in your own last name here.') }}</small>
                            @error('technicianLastName')
                            <br>
                            <small class="text-red-600 font-semibold">{{ $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <label for="technicianEmail">{{ __('E-mail') }} ({{ __('required') }}):</label>
                            <input type="email" name="technicianEmail" id="technicianEmail" class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full"
                                   placeholder="{{ __('E-mail') }}" value="{{ old('technicianEmail') }}">
                            <small class="opacity-50">{{ __('Fill in your own e-mail address here.') }}</small>
                            @error('technicianEmail')
                            <br>
                            <small class="text-red-600 font-semibold">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <div class="bg-white rounded-xl shadow-md p-4">
                            <h2 class="text-lg font-semibold">Revision data</h2>
                            <div>
                                <label for="name">{{ __('Name') }} ({{ __('required') }}):</label>
                                <input type="text" name="name" id="name" class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full"
                                       placeholder="{{ __('Name') }}" value="{{ old('name') }}">
                                <small class="opacity-50">{{ __('Fill in a short summary of the change here.') }}</small>
                                @error('name')
                                <br>
                                <small class="text-red-600 font-semibold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div>
                                <label for="categoryId">{{ __('Change category') }} ({{ __('required') }}):</label>
                                <select name="categoryId" id="categoryId" class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full">
                                    @foreach ($categories as $categoryEntry)
                                        <option
                                            value="{{ $categoryEntry->id }}"
                                            @if(old('categoryId') == $categoryEntry->id) selected @endif>
                                            {{ $categoryEntry->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="opacity-50">{{ __('Select the category of the change here.') }}</small>
                                @error('categoryId')
                                <br>
                                <small class="text-red-600 font-semibold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div>
                                <label for="description">{{ __('Description') }} ({{ __('optional') }}):</label>
                                <textarea name="description" id="description" rows="6" placeholder="{{ __('Description of the change') }}" class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full">{{ old('description') }}</textarea>
                                <small class="opacity-50">{{ __('Fill in a description of the change here.') }}</small>
                                @error('description')
                                <br>
                                <small class="text-red-600 font-semibold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="flex justify-end flex-grow gap-2 w-full md:w-auto mt-3">
                            <a href="{{ route('public.showFile', ['file' => $file]) }}"
                               class="bg-red-600 hover:bg-red-700 px-9 py-3 mb-3 text-white rounded inline-flex justify-center items-center">
                                <x-heroicon-s-trash class="h-4 w-4 mr-1"></x-heroicon-s-trash><span>{{ __('Discard') }}</span>
                            </a>
                            <a href="javascript:$('#createForm').submit();"
                               class="bg-green-600 hover:bg-green-700 px-9 py-3 mb-3 text-white rounded inline-flex justify-center items-center">
                                <x-heroicon-s-pencil class="h-4 w-4 mr-1"></x-heroicon-s-pencil><span>{{ __('Save') }}</span>
                            </a>
                        </div>
                    </div>
                </div>
                <button type="submit" hidden></button>
            </form>
        </div>
    </div>

@endsection
