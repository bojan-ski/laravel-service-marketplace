@props([
'name',
'label' => null,
'smallText' => null,
'required' => false
])

<div class="mb-4">
    @if ($label)
        <label for="{{ $name }}" class="block font-medium mb-2">
            {{ $label }}
        </label>
    @endif

    <input type="file" name="{{ $name }}" id="{{ $name }}" @if ($required) required @endif
        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">

    @if ($smallText)
        <small class="text-gray-500">
            {{ $smallText }}
        </small>
    @endif

    @error($name)
        <p class="text-red-500 text-sm mt-1">
            {{ $message }}
        </p>
    @enderror
</div>