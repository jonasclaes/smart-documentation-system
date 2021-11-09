@php /** @var App\Models\File[]|Illuminate\Database\Eloquent\Collection $files */ @endphp

<ul>
    @foreach($files as $file)
        <li>
            <a href="{{ route('files.show', ['file' => $file->id]) }}" class="flex justify-between bg-white py-3 px-2 rounded-xl mb-2 shadow
                    border border-gray-400 border-opacity-25 hover:bg-gray-200 transition-colors duration-150 ease-in-out">
                <div>
                    <span class="font-semibold">{{ $file->client->name }}</span>
                    <span class="mx-1.5 font-bold">-</span>
                    <span>{{ $file->name }}</span>
                </div>
                <div>
                    <x-heroicon-o-chevron-right class="h-6 w-6 opacity-25"/>
                </div>
            </a>
        </li>
    @endforeach
</ul>
