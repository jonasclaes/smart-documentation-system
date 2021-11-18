@php /** @var App\Models\Client[]|Illuminate\Database\Eloquent\Collection $clients */ @endphp

<ul class="grid grid-cols-1 lg:grid-cols-2 gap-2">
    @if(count($clients) > 0)
        @foreach($clients as $client)
            <li>
                <a href="{{ route('clients.show', ['client' => $client->id]) }}" class="flex justify-between bg-white p-3 rounded-xl shadow
                        border border-gray-400 border-opacity-25 hover:bg-gray-200 transition-colors duration-150 ease-in-out items-center">
                    <div>
                        <span>{{ $client->clientNumber }} - {{ $client->name }}</span>
                        <br>
                        <span class="opacity-50">
                            {{ $client->contactEmail }}
                        </span>
                    </div>
                    <div>
                        <x-heroicon-s-chevron-right class="h-6 w-6 opacity-25"/>
                    </div>
                </a>
            </li>
        @endforeach
    @else
        <p>No clients have been found.</p>
    @endif
</ul>
