@php /** @var App\Models\User[]|Illuminate\Database\Eloquent\Collection $users */ @endphp

<!-- User Search Menu bar -->
<div class="bg-white rounded-xl p-4 w-full mb-3">
    <h1 class="text-xl font-semibold mb-2 pb-1 border-b">Registered Users</h1>
    <!-- search field -->
    <form id="userSearch" action="{{ route('users.index') }}" method="GET" class="flex gap-4">
        <div class="flex-initial">
            <input
                type="text"
                name="lastName"
                class="block px-0.5 border-0 border-b-2 border-gray-300 focus:ring-0 focus:border-black"
                placeholder="Search User"
                value="">
        </div>
        <div class="flex justify-end flex-grow gap-2 w-full md:w-auto">
            <a href="javascript:$('#userSearch').submit();"
               class="bg-gray-600 hover:bg-gray-700 md:px-9 py-3 text-white rounded flex-grow md:flex-grow-0
                       flex justify-center items-center">
                <x-heroicon-o-search class="h-4 w-4 mr-1"/>
                Search
            </a>
            <a href="{{ route('users.create') }}"
               class="bg-green-600 hover:bg-green-700 md:px-9 py-3 text-white rounded flex-grow md:flex-grow-0
                       flex justify-center items-center">
                <x-heroicon-o-plus class="h-4 w-4 mr-1"/>
                New
            </a>
        </div>
    </form>
</div>
