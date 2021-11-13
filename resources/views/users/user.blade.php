@php /** @var App\Models\User[]|Illuminate\Database\Eloquent\Collection $users */ @endphp

@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-12 container mx-auto px-3">
        <a href="{{ route('users.index') }}"
           class="col-span-1 col-start-1 bg-gray-700 hover:bg-gray-800 px-9 py-3 mb-3 text-white rounded inline-flex justify-center items-center">
            <x-heroicon-o-chevron-left class="h-4 w-4"/>
            <span>Back</span>
        </a>
        <!-- Menu bar -->
        <!-- Delete form -->
        <form action="{{ route('users.destroy', ['user' => $user]) }}" method="POST" id="deleteUser">
            @csrf
            @method('DELETE')
        </form>

        <!-- Menu bar -->
        <div class="col-span-12 bg-white rounded-xl p-4 w-full mb-3">
            <h1 class="text-xl font-semibold mb-2 pb-1 border-b">User Information</h1>
            <div class="flex flex-wrap items-start gap-2">
                <p class="flex-grow">This page shows the information for an individual user.</strong></p>
                <div class="flex justify-end flex-grow gap-2 w-full md:w-auto">
                    <a href="{{ route('users.resetPassword', ['user' => $user]) }}"
                       class="bg-gray-600 hover:bg-gray-700 md:px-9 py-3 text-white rounded flex-grow md:flex-grow-0
                       flex justify-center items-center">
                        <x-heroicon-o-key class="h-4 w-4 mr-1"/>Reset Password
                    </a>
                    <a href="{{ route('users.edit', ['user' => $user]) }}"
                       class="bg-blue-600 hover:bg-blue-700 md:px-9 py-3 text-white rounded flex-grow md:flex-grow-0
                       flex justify-center items-center">
                        <x-heroicon-o-pencil class="h-4 w-4 mr-1"/>Edit
                    </a>
                    <a onclick="toggleModal('modal-example-regular')"
                       class="bg-red-600 hover:bg-red-700 md:px-9 py-3 text-white rounded flex-grow md:flex-grow-0
                       flex justify-center items-center">
                        <x-heroicon-o-trash class="h-4 w-4 mr-1"/>Delete
                    </a>
                </div>
            </div>
        </div>

        <!-- User Information Section -->
        <div class="col-span-6 gap-4 bg-white rounded-xl p-3 mr-1 pb-5">
            <h1 class="pl-2 font-bold text-left text-3xl">{{$user->firstName}} {{$user->lastName}} <span
                    class="text-2xl font-normal text-gray-400">(User ID: {{$user->id}})</span></h1>
            <p class="pl-2 text-gray-400 opacity-80 text-xl">Created on: {{$user->created_at}}</p>
            <p class="pl-2 text-gray-400 opacity-80 text-xl">Last updated on: {{$user->updated_at}}</p>
            <br>
            <p class="pl-2 text-lg">First Name: <span class="font-bold">{{$user->firstName}}</span></p>
            <p class="pl-2 text-lg">Last Name: <span class="font-bold">{{$user->lastName}}</span></p>
            <p class="pl-2 text-lg">Username: <span class="font-bold">{{$user->username}}</span></p>
            <p class="pl-2 text-lg">Email address: <a href="mailto:{{ $user->email }}"><span
                        class="font-bold">{{$user->email}}</span></a></p>
            <p class="pl-2 text-lg">Phone Number: <a href="tel:{{ $user->phoneNumber }}"><span
                        class="font-bold">{{$user->phoneNumber}}</span></a></p>
        </div>
        <div class="col-span-6 gap-4 bg-white rounded-xl p-3 ml-1">
            <h1 class="pl-2 font-bold text-left text-2xl">User Logs</h1>
            <p class="pl-2 text-gray-400 opacity-80 text-lg">Recent activity
                of {{$user->firstName}} {{$user->lastName}}</p>
        </div>
        <div class="col-span-12 gap-4 bg-white rounded-xl mt-3 p-3 pb-4">
            <h1 class="pl-2 font-bold text-left text-2xl">Projects</h1>
        </div>
    </div>

    <!-- Modal -->
    <div
        class="
    hidden
    overflow-x-hidden overflow-y-auto
    fixed
    inset-0
    z-50
    outline-none
    focus:outline-none
    justify-center
    items-center
  "
        id="modal-example-regular"
    >
        <div class="relative w-auto my-6 mx-auto max-w-3xl">
            <!--content-->
            <div
                class="
        border-0
        rounded-lg
        shadow-lg
        relative
        flex flex-col
        w-full
        bg-white
        outline-none
        focus:outline-none
      "
            >
                <!--header-->
                <div
                    class="
          flex
          items-start
          justify-between
          p-5
          border-b border-solid border-gray-200
          rounded-t
        "
                >
                    <h3 class="text-3xl font-semibold">Confirm Delete</h3>
                    <button
                        class="
            p-1
            ml-auto
            bg-transparent
            border-0
            text-gray-300
            float-right
            text-3xl
            leading-none
            font-semibold
            outline-none
            focus:outline-none
          "
                        onclick="toggleModal('modal-example-regular')"
                    >
          <span
              class="
              bg-transparent
              h-6
              w-6
              text-2xl
              block
              outline-none
              focus:outline-none
            "
          >
            <i class="fas fa-times"></i>
          </span>
                    </button>
                </div>
                <!--body-->
                <div class="relative p-6 flex-auto">
                    <p class="my-4 text-gray-500 text-lg leading-relaxed">
                        Do you really want to delete user {{$user->firstName}} {{$user->lastName}}?
                        This action cannot be undone.
                    </p>
                </div>
                <!--footer-->
                <div
                    class="
          flex
          items-center
          justify-end
          p-6
          border-t border-solid border-gray-200
          rounded-b
        "
                >
                    <button
                        class="
            text-white
            bg-gray-600
            hover:bg-gray-500
            rounded
            font-bold
            uppercase
            px-6
            py-2
            text-sm
            outline-none
            focus:outline-none
            mr-1
            mb-1
            ease-linear
            transition-all
            duration-150
          "
                        type="button"
                        onclick="toggleModal('modal-example-regular')"
                    >
                        Discard
                    </button>
                    <button
                        class="
            bg-red-600
            hover:bg-red-500
            text-white
            font-bold
            uppercase
            text-sm
            px-4
            py-2
            rounded
            shadow
            hover:shadow-lg
            outline-none
            focus:outline-none
            mr-1
            mb-1
            ease-linear
            transition-all
            duration-150
          "
                        type="button"
                        onclick="$('#deleteUser').submit();"
                    >
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div
        class="hidden opacity-50 fixed inset-0 z-40 bg-gray-900"
        id="modal-example-regular-backdrop"
    ></div>
    <script type="text/javascript">
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
