<table id="userTable" class="table mx-auto border-separate w-5/6 text-gray-400 space-y-6 text-lg">
    <thead class="text-gray-500 text-left">
    <tr>
        <th onclick="sortTable(0)" scope="col" class="w-1/12">User ID</th>
        <th scope="col" class="w-1/4">First Name</th>
        <th scope="col" class="w-1/4">Last Name</th>
        <th scope="col" class="w-3/12">Email</th>
        <th scope="col" class="w-1/12">Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr class="mb-2 rounded-2xl">
            <th>{{ $user->id }}</th>
            <td class="p-3  font-semibold text-teal-500">{{ $user->firstName }}</td>
            <td class="p-3">{{ $user->lastName }}</td>
            <td class="p-3"><a href="mailto:{{$user->email}}">{{ $user->email }}</a></td>
            <td class="table-cell">
                <div class="flex justify-between">
                    <a href="">
                        <x-heroicon-s-eye class="h-6 w-6"/></a>
                    <a href="{{route('admin.users.edit', $user->id)}}" role="button">
                        <x-heroicon-s-pencil-alt class="h-6 w-6"/></a>
                    <a href=""
                       onclick="event.preventDefault(); document.getElementById('delete-user-form-{{$user->id}}').submit()"
                       role="button">
                        <x-heroicon-s-trash class="h-6 w-6"/></a>
                    <form id="delete-user-form-{{$user->id}}" action="{{route('admin.users.destroy', $user->id)}}"
                          method="POST" style="display: none">
                        @csrf
                        @method("DELETE")
                    </form>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
