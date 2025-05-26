@props([
'name',
'label' => null,
'value' => '',
'options' => [],
'required' => false,
'xModel' => null,
'disabledOptionLabel' => null
])

<div>
    @if ($label)
        <label for="{{ $name }}" class="block font-medium mb-2">
            {{ $label }}
        </label>
    @endif

    <select name="{{ $name }}" id="{{ $name }}" @if ($required) required @endif 
        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
        @if ($xModel) x-model="{{ $xModel }}" @endif
        {{ $attributes }}
        >
        @if ($disabledOptionLabel)
            <option value="">
                {{ $disabledOptionLabel }}
            </option>
        @endif

        @foreach ($options as $option)
            <option value="{{ $option }}" {{ old($name, $value) == $option ? 'selected' : '' }}>
                {{ ucfirst($option) }}
            </option>
        @endforeach
    </select>

    @error($name)
        <p class="text-red-500 text-sm mt-1">
            {{ $message }}
        </p>
    @enderror
</div>