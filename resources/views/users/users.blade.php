@extends('layouts.app')

@section('content')
    <div class="flex-row justify-center mx-auto p-3">
        <!-- Menu bar -->
        <x-UserSearch :users="$users"></x-UserSearch>
        <div class="max-h-screen bg-white w-full rounded-2xl p-3">
            <div class="col-span-12">
                <div class="overflow-auto lg:overflow-visible border-separate">
                    {{ $users->links() }}
                    <br>
                    <hr>
                    <br>
                    @include('components.UserList')
                </div>
            </div>
        </div>
    </div>
@endsection
