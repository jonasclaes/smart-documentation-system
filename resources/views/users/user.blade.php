@php
    /**
     * @var App\Models\User[]|Illuminate\Database\Eloquent\Collection $users
    */
@endphp

@extends('layouts.app')

@section('content')
    <!--Page Content-->
    <div class="container mx-auto px-3">
        <!-- Menu bar -->
        <!-- Delete form -->
        <form action="{{ route('users.destroy', ['user' => $user]) }}" method="POST" id="deleteUser">
            @csrf
            @method('DELETE')
        </form>
        <form action="{{ route('users.updateStatus', ['user' => $user]) }}" method="POST"
              id="updateStatus">
            @csrf
            @method('PUT')
            <input type="hidden" name="active" value="{{ intval(!$user->active) }}">
        </form>

        <!-- Menu bar -->
        <div class="col-span-12 bg-white rounded-xl p-4 w-full mb-3">
            <h1 class="text-xl font-semibold mb-2 pb-1 border-b">{{ __('User') }}</h1>
            <div class="flex flex-wrap items-start gap-2">
                <p class="flex-grow">{{ __('This page shows the information for an individual user.') }}</p>
                <div class="flex justify-end flex-grow gap-2 w-full md:w-auto">
                    <!--(De)Activate User-->
                    @if($user->active)
                        <button class="text-green-500 bg-white hover:bg-gray-100 text-white font-bold uppercase text-sm md:px-5 py-3
                    rounded shadow hover:shadow-lg outline-none focus:outline-none ease-linear
                    transition-all duration-150 flex-grow md:flex-grow-0
                       flex justify-center items-center"
                                type="button"
                                onclick="$('#updateStatus').submit();">
                            <x-heroicon-s-check-circle class="h-4 w-4 mr-1 text-green-500"/>
                            {{ __('Active') }}
                        </button>
                    @else
                        <button class="text-red-500 bg-white hover:bg-gray-100 text-white font-bold uppercase text-sm md:px-5 py-3
                    rounded shadow hover:shadow-lg outline-none focus:outline-none ease-linear
                    transition-all duration-150 flex-grow md:flex-grow-0
                       flex justify-center items-center"
                                type="button"
                                onclick="$('#updateStatus').submit();">
                            <x-heroicon-s-minus-circle class="h-4 w-4 mr-1 text-red-500"/>
                            {{ __('Inactive') }}
                        </button>
                @endif
                <!--Reset Password button-->
                    <a href="{{ route('users.resetPassword', ['user' => $user]) }}"
                       class="bg-gray-600 hover:bg-gray-700 md:px-9 py-3 text-white rounded flex-grow md:flex-grow-0
                       flex justify-center items-center">
                        <x-heroicon-s-key class="h-4 w-4 mr-1"/>
                        {{ __('Reset Password') }}
                    </a>
                    <!--Edit Button-->
                    <a href="{{ route('users.edit', ['user' => $user]) }}"
                       class="bg-blue-600 hover:bg-blue-700 md:px-9 py-3 text-white rounded flex-grow md:flex-grow-0
                       flex justify-center items-center">
                        <x-heroicon-s-pencil class="h-4 w-4 mr-1"/>
                        {{ __('Edit') }}
                    </a>
                    <!--Edit Permissions Button-->
                    <a href="{{ route('userPermissions.edit', ['user' => $user]) }}"
                       class="bg-blue-600 hover:bg-blue-700 md:px-9 py-3 text-white rounded flex-grow md:flex-grow-0
                       flex justify-center items-center">
                        <x-heroicon-s-pencil class="h-4 w-4 mr-1"/>
                        {{ __('Edit Rights') }}
                    </a>
                    <!--Delete Button to Modal-->
                    <a href="javascript:toggleModal('modal-delete')"
                       class="bg-red-600 hover:bg-red-700 md:px-9 py-3 text-white rounded flex-grow md:flex-grow-0
                       flex justify-center items-center">
                        <x-heroicon-s-trash class="h-4 w-4 mr-1"/>
                        {{ __('Delete') }}
                    </a>
                </div>
            </div>
        </div>

        <div class="grid gap-3 grid-cols-12">
            <!-- User Information Section -->
            <div class="col-span-12 md:col-span-6 bg-white rounded-xl p-4">
                <h1 class="font-semibold text-lg">{{ __('General information') }}</h1>
                <p>{{ __('Created on') }}: {{$user->created_at}}</p>
                <p>{{ __('Last updated on') }}: {{$user->updated_at}}</p>
                <p>{{ __('First name') }}: {{$user->firstName}}</p>
                <p>{{ __('Last name') }}: {{$user->lastName}}</p>
                <p>{{ __('Username') }}: {{$user->username}}</p>
                <p>{{ __('E-mail address') }}: <a href="mailto:{{ $user->email }}" class="text-blue-500">{{$user->email}}</a></p>
                <p>{{ __('Phone number') }}: <a href="tel:{{ $user->phoneNumber }}" class="text-blue-500">{{$user->phoneNumber}}</a></p>
            </div>
            <!-- User Logs Section -->
            <div class="col-span-12 md:col-span-6 bg-white rounded-xl p-4">
                <h1 class="font-semibold text-lg">{{ __('User logs') }}</h1>
                <p class="text-gray-400">{{ __('Recent activity') }}</p>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="modal-delete" class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50
     outline-none focus:outline-none justify-center items-center">
        <div class="relative w-auto my-6 mx-auto max-w-3xl">
            <!--content-->
            <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none
            focus:outline-none">
                <!--header-->
                <div class="flex items-start justify-between p-5 border-b border-solid border-gray-200
                rounded-t">
                    <h3 class="text-3xl font-semibold">{{ __('Confirm delete') }}</h3>
                    <button class="p-1 ml-auto bg-transparent border-0 text-gray-300 float-right text-3xl
                    leading-none font-semibold outline-none focus:outline-none"
                            onclick="toggleModal('modal-delete')">
                        <span class="bg-transparent h-6 w-6 text-2xl block outline-none focus:outline-none">
                            <x-heroicon-s-x class="h-6 w-6"/>
                        </span>
                    </button>
                </div>
                <!--body-->
                <div class="relative p-6 flex-auto">
                    <p class="my-4 text-gray-500 text-lg leading-relaxed">
                        {{ __('Do you really want to delete user') }} {{$user->firstName}} {{$user->lastName}}?
                        {{ __('This action cannot be undone.') }}
                    </p>
                </div>
                <!--footer-->
                <div class="flex items-center justify-end p-6 border-t border-solid border-gray-200 rounded-b">
                    <button class="text-white bg-gray-600 hover:bg-gray-500 rounded font-bold uppercase px-6
                    py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                            type="button"
                            onclick="toggleModal('modal-delete')">
                        {{ __('Discard') }}
                    </button>
                    <button class="bg-red-600 hover:bg-red-500 text-white font-bold uppercase text-sm px-4 py-2
                    rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear
                    transition-all duration-150"
                            type="button"
                            onclick="$('#deleteUser').submit();">
                        {{ __('Delete') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!--gray overlay for modal backgrounds-->
    <div
        class="hidden opacity-50 fixed inset-0 z-40 bg-gray-900"
        id="modal-delete-backdrop"
    ></div>
    <script type="text/javascript">
        <!-- Modal Toggler -->
        function toggleModal(modalID) {
            document.getElementById(modalID).classList.toggle("hidden");
            document
                .getElementById(modalID + "-backdrop")
                .classList.toggle("hidden");
            document.getElementById(modalID).classList.toggle("flex");
            document.getElementById(modalID + "-backdrop").classList.toggle("flex");
        }
    </script>
@endsection
