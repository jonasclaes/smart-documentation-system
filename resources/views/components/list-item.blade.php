<a
    href="{{ $to }}"
    @if($class)
        class="{{ $class }}"
    @else
    class="flex justify-between bg-white p-3 rounded-xl shadow border border-gray-400 border-opacity-25
        hover:bg-gray-200 transition-colors duration-150 ease-in-out items-center"
    @endif>
    <div>
        <span>{{ $title }}</span>
        @if($subtitle)
            <br>
            <span class="opacity-50">{{ $subtitle }}</span>
        @endif
    </div>
    <div>
        <x-heroicon-s-chevron-right class="h-6 w-6 opacity-25"/>
    </div>
</a>
