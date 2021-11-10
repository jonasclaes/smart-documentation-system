@php /** @var App\Models\File[]|Illuminate\Database\Eloquent\Collection $files */ @endphp

<ul>
    @if(count($files) > 0)
        @foreach($files as $file)
            <li>
                <a href="{{ route('files.show', ['file' => $file->id]) }}" class="flex justify-between bg-white p-3 rounded-xl mb-2 shadow
                        border border-gray-400 border-opacity-25 hover:bg-gray-200 transition-colors duration-150 ease-in-out">
                    <div>
                        <span>{{ $file->fileId }}</span>
                        <span class="mx-1.5 font-bold">-</span>
                        <span>{{ $file->client->name }}</span>
                        <span class="mx-1.5 font-bold">-</span>
                        <span>{{ $file->name }}</span>
                        @if($file->enclosureId)
                            <span class="mx-1.5 font-bold">-</span>
                            <span>{{ $file->enclosureId }}</span>
                        @endif
                    </div>
                    <div>
                        <x-heroicon-o-chevron-right class="h-6 w-6 opacity-25"/>
                    </div>
                </a>
            </li>
        @endforeach
    @else
        <p>No files have been found.</p>
    @endif
</ul>
