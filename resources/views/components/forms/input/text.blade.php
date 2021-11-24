<input
    type="text"
    name="{{ $name }}"
    id="{{ $name }}"
    class="block rounded-md border-0 bg-gray-100 focus:ring-2 w-full"
    placeholder="{{ $placeholder }}"
    value="{{ old($name) }}"
    {{ $customProperties }}>
