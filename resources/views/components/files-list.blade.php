<ul>
    @for($i = 0; $i < intval($files); $i++)
        <li>
            <a href="#" class="flex justify-between bg-white py-3 px-2 rounded-lg mb-2 shadow-md
                    border border-gray-400 border-opacity-25 hover:bg-gray-100 transition-colors duration-300 ease-in-out">
                <div>
                    <span class="font-semibold">Telenet {{ $i+1 }}</span>
                    <span class="mx-1.5 font-bold">-</span>
                    <span>BIX-01 uitbouw knooppunt</span>
                </div>
                <div>
                    <x-heroicon-o-chevron-right class="h-6 w-6"/>
                </div>
            </a>
        </li>
    @endfor
</ul>
