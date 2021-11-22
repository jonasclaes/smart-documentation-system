<a
    href="{{ $to }}"
    class="flex justify-between bg-white p-3 rounded-xl shadow border border-gray-400 border-opacity-25
        hover:bg-gray-200 transition-colors duration-150 ease-in-out items-center">
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
