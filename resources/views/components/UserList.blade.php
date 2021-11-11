@php /** @var App\Models\User[]|Illuminate\Database\Eloquent\Collection $users */ @endphp

<ul>
    @if(count($users) > 0)
        @foreach($users as $user)
            <li>
                <a href="{{ route('users.show', ['user' => $user->id]) }}" class="flex justify-between bg-white p-3 rounded-xl mb-2 shadow
                        border border-gray-400 border-opacity-25 hover:bg-gray-200 transition-colors duration-150 ease-in-out">
                    <div>
                        <span class="font-bold">{{$user->lastName}}, </span>
                        <span>{{$user->firstName}}</span>
                        <span>  </span>
                        <span class="italic text-gray-400">({{$user->username}})</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">User Id: {{$user->id}}</span>
                        <x-heroicon-o-chevron-right class="h-6 w-6 opacity-25"/>
                    </div>
                </a>
            </li>
        @endforeach
    @else
        <p>No users have been found.</p>
    @endif
</ul>

{{--<table id="userTable" class="table mx-auto border-separate w-5/6 text-gray-400 space-y-6 text-lg">--}}
{{--    <thead class="text-gray-500 text-left">--}}
{{--    <tr>--}}
{{--        <th onclick="sortTable(0)" scope="col" class="w-1/12">User ID</th>--}}
{{--        <th scope="col" class="w-1/4">First Name</th>--}}
{{--        <th scope="col" class="w-1/4">Last Name</th>--}}
{{--        <th scope="col" class="w-3/12">Email</th>--}}
{{--        <th scope="col" class="w-1/12">Actions</th>--}}
{{--    </tr>--}}
{{--    </thead>--}}
{{--    <tbody>--}}
{{--    @foreach($users as $user)--}}
{{--        <tr class="mb-2 rounded-2xl">--}}
{{--            <th>{{ $user->id }}</th>--}}
{{--            <td class="p-3  font-semibold text-teal-500">{{ $user->firstName }}</td>--}}
{{--            <td class="p-3">{{ $user->lastName }}</td>--}}
{{--            <td class="p-3"><a href="mailto:{{$user->email}}">{{ $user->email }}</a></td>--}}
{{--            <td class="table-cell">--}}
{{--                <div class="flex justify-between">--}}
{{--                    <a href="">--}}
{{--                        <x-heroicon-s-eye class="h-6 w-6"/></a>--}}
{{--                    <a href="{{route('users.edit', $user->id)}}" role="button">--}}
{{--                        <x-heroicon-s-pencil-alt class="h-6 w-6"/></a>--}}
{{--                    <a href=""--}}
{{--                       onclick="event.preventDefault(); document.getElementById('delete-user-form-{{$user->id}}').submit()"--}}
{{--                       role="button">--}}
{{--                        <x-heroicon-s-trash class="h-6 w-6"/></a>--}}
{{--                    <form id="delete-user-form-{{$user->id}}" action="{{route('users.destroy', $user->id)}}"--}}
{{--                          method="POST" style="display: none">--}}
{{--                        @csrf--}}
{{--                        @method("DELETE")--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--    @endforeach--}}
{{--    </tbody>--}}
{{--</table>--}}
