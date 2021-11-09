@extends('layouts.app')

@section('content')
    <div class="flex-row justify-center mx-auto p-3">
        <div class="flex justify-between bg-white rounded-xl p-4 w-full mx-auto mb-3 text-xl font-bold">
            <h1 class="text-2xl text-cyan-700">Registered Users</h1>
            <div class="flex justify-end w-1/2">
                <div class="text-center flex-auto justify-end">
                    <label for="name"></label>
                    <input type="text" id="name" name="name" placeholder="Search user..."
                           class="w-2/3 py-2 border-b-2 rounded-xl border-blueGray-600 outline-none focus:border-cyan-500">
                </div>
                <p>Create User</p>
                <a href="{{route('users.create')}}"><x-heroicon-o-plus-circle class="h-12 w-12"/></a>
            </div>
        </div>
        <div class="bg-white rounded-xl p-4 w-full mx-auto mb-3 text-xl font-bold">
            {{ $users->links() }}
        </div>
        <div class="max-h-screen bg-white w-full rounded-2xl p-3">
            <div class="col-span-12">
                <div class="overflow-auto lg:overflow-visible border-separate">
                    @include('components.UserList')
                </div>
            </div>
        </div>
    </div>
@endsection
