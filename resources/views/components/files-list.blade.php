@php /** @var App\Models\File[]|Illuminate\Database\Eloquent\Collection $files */ @endphp

<ul class="grid grid-cols-1 lg:grid-cols-2 gap-2">
    @if(count($files) > 0)
        @foreach($files as $file)
            <li>
                <a href="{{ route('files.show', ['file' => $file->id]) }}" class="flex justify-between bg-white p-3 rounded-xl shadow
                        border border-gray-400 border-opacity-25 hover:bg-gray-200 transition-colors duration-150 ease-in-out items-center">
                    <div>
                        <span>{{ $file->fileId }} - {{ $file->name }}</span>
                        <br>
                        <span class="opacity-50">
                            {{ $file->client->name }}
                            @if($file->enclosureId)
                                <span> - {{ $file->enclosureId }}</span>
                            @endif
                        </span>

                    </div>
                    <div>
                        <x-heroicon-o-chevron-right class="h-6 w-6 opacity-25"/>
                    </div>
                </a>
            </li>
        @endforeach
    @else
        <p>{{ __('No files have been found.') }}</p>
    @endif
</ul>
