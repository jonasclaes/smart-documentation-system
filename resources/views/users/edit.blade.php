@php
    /** @var App\Models\User $user */
@endphp

@extends('layouts.app')

@section('content')

    <div class="container mx-auto px-3">
        <!-- Menu bar -->
        <div class="bg-white rounded-xl p-4 w-full mb-3">
            <h1 class="text-xl font-semibold">{{ __('Edit user') }}</h1>
        </div>

        <!-- Content -->
        <div class="bg-white rounded-xl p-4">
            <form action="{{ route('users.update', ['user' => $user]) }}" method="POST" id="editUser">
                @csrf
                @method("PUT")
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                    <div>
                        <label for="firstName">{{ __('First name') }} ({{ __('required') }}):</label>
                        <input type="text" name="firstName" id="firstName"
                               class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full"
                               placeholder="{{ __('First name') }}" value="{{ old('firstName', $user->firstName) }}"
                               required>
                        <small class="opacity-50">{{ __('Fill in user first name here.') }}</small>
                        @error('firstName')
                        <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="lastName">{{ __('Last name') }} ({{ __('required') }}):</label>
                        <input type="text" name="lastName" id="lastName"
                               class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full"
                               placeholder="{{ __('Last name') }}" value="{{ old('lastName', $user->lastName) }}"
                               required>
                        <small class="opacity-50">{{ __('Fill in user last name here.') }}</small>
                        @error('lastName')
                        <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="username">{{ __('Username') }} ({{ __('required') }}):</label>
                        <input type="text" name="username" id="username"
                               class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full"
                               placeholder="{{ __('Username') }}" value="{{ old('username', $user->username) }}">
                        <small
                            class="opacity-50">{{ __('Fill in username. If left blank, a username will be generated (format: firstname.lastname).') }}</small>
                        @error('username')
                        <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="email">{{ __('E-mail') }} ({{ __('required') }}):</label>
                        <input type="email" name="email" id="email"
                               class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full"
                               placeholder="john.doe@example.com" value="{{ old('email', $user->email) }}" required>
                        <small class="opacity-50">{{ __('Please enter a valid email address.') }}</small>
                        @error('email')
                        <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="phoneNumber">{{ __('Phone number') }} ({{ __('optional') }}):</label>
                        <input type="tel" name="phoneNumber" id="phoneNumber"
                               class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full"
                               placeholder="{{ __('Phone number') }}"
                               value="{{ old('phoneNumber', $user->phoneNumber) }}">
                        <small class="opacity-50">{{ __('Fill in a valid phone number.') }}</small>
                        @error('phoneNumber')
                        <span class="text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </form>
        </div>

        <!-- Permissions Section -->
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-3 bg-white rounded-xl mt-3 p-4">
            <h3 class="col-span-full">User Permissions Section</h3>
            @foreach($prefixes as $prefix)
                <div class="bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl shadow-md p-4 col-span-1">
                    <div class="font-bold">
                        <x-forms.input-block.checkbox label="{{ $prefix }}" name="{{ $prefix }}" id="{{ $prefix }}"></x-forms.input-block.checkbox>
                    </div>
                    @foreach($permissions as $permission => $description)
                        <div class="pl-3">
                            <x-forms.input-block.checkbox
                                label="{{ __(':prefix::permission', ['prefix' => $prefix, 'permission' => $permission]) }}"
                                name="{{ $prefix }}"
                                id="{{ $prefix }}:{{ $permission }}"
                                helpText="{{ $description }} {{ $prefix }}.">
                            </x-forms.input-block.checkbox>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>

        <!-- Buttons -->
        <div class="flex justify-end flex-grow gap-2 w-full md:w-auto mt-3">
            <a href="{{ route('users.show', ['user' => $user]) }}"
               class="bg-red-600 hover:bg-red-700 px-9 py-3 mb-3 text-white rounded inline-flex justify-center items-center">
                <x-heroicon-s-trash class="h-4 w-4 mr-1"/>
                <span>{{ __('Discard') }}</span>
            </a>
            <a href="javascript:$('#editUser').submit();"
               class="bg-green-600 hover:bg-green-700 md:px-9 py-3 mb-3 text-white rounded flex-grow md:flex-grow-0
                flex justify-center items-center">
                <x-heroicon-s-pencil class="h-4 w-4 mr-1"/>
                <span>{{ __('Save') }}</span>
            </a>
        </div>
    </div>
    <script type="text/javascript">
        var $permissionPrefixes = [
            "client-contact",
            "client",
            "comment",
            "document",
            "file",
            "qr-code",
            "revision",
            "revision-request-category",
            "revision-request-comment",
            "revision-request-document",
            "revision-request",
            "user-permission",
            "user",
        ];

        $permissionPrefixes.forEach(function(item){
            $('input[id=item]').change(function() {
                $('input[name=item]').attr('checked', this.checked);
            });

            $('input[name=item]').change(function() {
                $('input[id=item]').prop('checked', $('input[name=item]:not(:checked)').length === 0);
            });
        });
    </script>

@endsection
