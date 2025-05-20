@props([
'name',
'label' => null,
'type' => 'text',
'value' => null,
'placeholder' => null,
'minlength' => null,
'maxlength' => null,
'min' => null,
'max' => null,
'required' => false,
'css' => null
])

<div class="mb-4">
    @if ($label)
        <label for="{{ $name }}" class="block font-medium mb-2">
            {{ $label }}
        </label>
    @endif
    
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ old($name, $value) }}" min="{{ $min }}"
        max="{{ $max }}" minlength="{{ $minlength }}" maxlength="{{ $maxlength }}"
        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
        placeholder="{{ $placeholder }}" @if ($required) required @endif />

    @error($name)
        <p class="text-red-500 text-sm mt-1">
            {{ $message }}
        </p>
    @enderror
</div>