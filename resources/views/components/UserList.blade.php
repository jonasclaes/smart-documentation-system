@php /**
 * @use Illuminate\Http\Request;
 * @var App\Models\User[]|Illuminate\Database\Eloquent\Collection $users */ @endphp

<ul class="grid grid-cols-1 lg:grid-cols-2 gap-2">
    @if(count($users) > 0)
        @foreach($users as $user)
            <li>
                <a href="{{ route('users.show', ['user' => $user->id]) }}"
                @class([
                    'flex justify-between bg-white p-3 rounded-xl shadow
                        border border-gray-400 border-opacity-25 hover:bg-gray-200 transition-colors duration-150 ease-in-out items-center',
                    'bg-gray-300 opacity-30' => ($user->active === 0)
                        ])>
                <div>
                    <span class="font-bold">{{$user->lastName}}, </span>
                    <span>{{$user->firstName}}</span>
                    <br>
                    <span class="opacity-50">{{$user->username}}</span>
                </div>
                <div>
                    <x-heroicon-o-chevron-right class="h-6 w-6 opacity-25"/>
                </div>
                </a>
            </li>
        @endforeach
    @else
        <p>No users have been found.</p>
    @endif
</ul>
