<div class="pl-1">
    <label for="{{ $name }}">{{ $label }}</label>
    <x-forms.input.checkbox name="{{ $name }}" id="{{ $id }}" customProperties="{{ $customProperties }}"></x-forms.input.checkbox>
    <small class="hidden md:inline-block opacity-50">{{ $helpText }}</small>
    @error($name)
    <br>
    <small class="text-red-600 font-semibold">{{ $message }}</small>
    @enderror
</div>
