@props([
'name',
'label' => null,
'value' => '',
'placeholder' => '',
'rows' => '6',
'cols' => '20',
'required' => false
])

<div class="mb-4">
    @if ($label)
        <label for="{{ $name }}" class="block font-medium mb-2">
            {{ $label }}
        </label>
    @endif

    <textarea name="{{ $name }}" id="{{ $name }}" rows="{{ $rows }}" cols="{{ $cols }}"
        class="w-full resize-none px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
        placeholder="{{ $placeholder }}" required>{{ old($name, $value) }}</textarea>

    @error($name)
        <p class="text-red-500 text-sm mt-1">
            {{ $message }}
        </p>
    @enderror
</div>