<a
    href="{{ $to }}"
    @if($class)
        class="{{ $class }}"
    @else
    class="flex justify-between bg-white p-3 rounded-xl shadow border border-gray-400 border-opacity-25
        hover:bg-gray-200 transition-colors duration-150 ease-in-out items-center dark:bg-coolGray-700 dark:text-white
        dark:border-gray-800 dark:hover:bg-gray-500"
    @endif>
    <div>
        <span>{{ $title }}</span>
        @if($subtitle)
            <br>
            <span class="opacity-50">{{ $subtitle }}</span>
        @endif
        @if(count($labels) > 0)
            <div class="mt-1">
                @foreach($labels as $label)
                    <span class="bg-gradient-to-br from-{{ $label['color'] }}-500 to-{{ $label['color'] }}-600 text-white rounded-md shadow px-3 py-1 inline-block text-sm">{{ $label['text'] }}</span>
                @endforeach
            </div>
        @endif
    </div>
    <div>
        <x-heroicon-s-chevron-right class="h-6 w-6 opacity-25"/>
    </div>
</a>
