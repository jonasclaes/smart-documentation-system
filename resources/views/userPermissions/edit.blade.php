@php
    /** @var App\Models\User $user */
@endphp

@extends('layouts.app')

@section('content')

    <div class="container mx-auto px-3">
        <!-- Menu bar -->
        <div class="bg-white rounded-xl p-4 w-full mb-3">
            <h1 class="text-xl font-semibold">{{ __('Edit User Permissions') }}</h1>
        </div>

        <!-- Permissions Section -->
        <form action="{{ route('userPermissions.update', ['user' => $user]) }}" method="POST" id="editPermissions">
            @csrf
            @method("PUT")
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-3 bg-white rounded-xl mt-3 p-4">
                <h3 class="col-span-full">Here you can adjust all the rights for an individual user. The checkbox in bold
                    selects all the rights for that section.</h3>
                @foreach($prefixes as $prefix)
                    <div class="bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl shadow-md p-4 col-span-1">
                        <div class="font-bold">
                            <x-forms.input-block.checkbox label="{{ $prefix }}" name="{{ $prefix }}" id="{{ $prefix }}"></x-forms.input-block.checkbox>
                        </div>
                        @foreach($permissions as $permission => $description)
                            <div class="pl-3">
                                <x-forms.input-block.checkbox
                                    class="{{ $prefix }}"
                                    label="{{ __(':prefix::permission', ['prefix' => $prefix, 'permission' => $permission]) }}"
                                    name="{{ $prefix }}:{{ $permission }}"
                                    id="{{ $prefix }}:{{ $permission }}"
                                    helpText="{{ $description }} {{ $prefix }}."
                                    customProperties="{{ old($prefix . ':' . $permission, $user->permissions()->where('permissionName', '=' , $prefix . ':' . $permission)->first() ? 'on' : null) == 'on' ? 'checked' : '' }}"
                                >
                                </x-forms.input-block.checkbox>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </form>

        <!-- Buttons -->
        <div class="flex justify-end flex-grow gap-2 w-full md:w-auto mt-3">
            <a href="{{ route('users.show', ['user' => $user]) }}"
               class="bg-red-600 hover:bg-red-700 px-9 py-3 mb-3 text-white rounded inline-flex justify-center items-center">
                <x-heroicon-s-trash class="h-4 w-4 mr-1"/>
                <span>{{ __('Discard') }}</span>
            </a>
            <a href="javascript:$('#editPermissions').submit();"
               class="bg-green-600 hover:bg-green-700 md:px-9 py-3 mb-3 text-white rounded flex-grow md:flex-grow-0
                flex justify-center items-center">
                <x-heroicon-s-pencil class="h-4 w-4 mr-1"/>
                <span>{{ __('Save') }}</span>
            </a>
        </div>
    </div>
    <script type="text/javascript">
        const $permissionPrefixes = [
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

        window.onload = function() {
            checkBoxes();
        };

        function checkBoxes () {
            $permissionPrefixes.forEach(function (item) {
                let checkBox = "input[name^=" + item + "\\:]"
                console.log(checkBox)
                console.log(checkBox)
                //One Checkbox to check them all...
                $("#"+item).click(function() {
                    $(checkBox).not(this).prop('checked', this.checked);
                });

                //Event to Check or Uncheck main Checkbox
                $(checkBox).click(function() {

                    if ($(checkBox + ":checked").length === $(checkBox).length) {
                        $("#"+item).prop('checked', true);
                    } else {
                        $("#"+item).prop('checked', false);
                    }
                });

            });

        }

    </script>

@endsection
