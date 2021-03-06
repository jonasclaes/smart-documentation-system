<div>
    <label for="{{ $name }}">{{ $label }}</label>
    <x-forms.input.file name="{{ $name }}" placeholder="{{ $placeholder }}" customProperties="{{ $customProperties }}"></x-forms.input.file>
    <small class="text-gray-400">{{ $helpText }}</small>
    @error($name)
    <br>
    <small class="text-red-600 font-semibold">{{ $message }}</small>
    @enderror
</div>
