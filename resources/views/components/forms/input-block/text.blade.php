<div>
    <label for="{{ $name }}">{{ $label }}</label>
    <x-forms.input.text name="{{ $name }}" placeholder="{{ $placeholder }}" customProperties="{{ $customProperties }}"></x-forms.input.text>
    <small class="text-gray-400">{{ $helpText }}</small>
    @error($name)
    <br>
    <small class="text-red-600 font-semibold">{{ $message }}</small>
    @enderror
</div>
