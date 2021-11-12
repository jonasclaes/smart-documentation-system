@php /** @var App\Models\User[]|Illuminate\Database\Eloquent\Collection $users */ @endphp

<!-- User Search Menu bar -->
<div class="bg-white rounded-xl p-4 w-full mb-3">
    <h1 class="text-xl font-semibold mb-2 pb-1 border-b">Users</h1>
    <form action="{{ route('users.index') }}" method="GET" class="flex gap-4">
        <div class="flex-initial">
            <input
                type="text"
                name="lastName"
                class="block px-0.5 border-0 border-b-2 border-gray-300 focus:ring-0 focus:border-black"
                placeholder="Last Name"
                value="{{ old('lastName') }}">
        </div>
        <div class="flex-initial">
            <input
                type="text"
                name="firstName"
                class="block px-0.5 border-0 border-b-2 border-gray-300 focus:ring-0 focus:border-black"
                placeholder="First Name"
                value="{{ old('firstName') }}">
        </div>
        <div class="flex-initial">
            <input
                type="text"
                name="username"
                class="block px-0.5 border-0 border-b-2 border-gray-300 focus:ring-0 focus:border-black"
                placeholder="User Name"
                value="{{ old('username') }}">
        </div>
        <div class="flex w-full justify-end">
            <button id="term" type="submit"
                    class="w-32 h-full bg-gray-700 text-white rounded-md">
                @isset($users)
                    {{ __('Search User') }}
                @endisset
                @isset($user)
                    {{ __('Show All Users') }}
                @endisset
            </button>
            <button type="button" onclick="window.location='{{route('users.create')}}'"
                    class="w-32 h-full bg-gray-700 text-white rounded-md mx-1.5">
                Create User
            </button>
        </div>
    </form>
</div>
