@props([
    'name',
    'radioOptions'
])

<div class="grid grid-cols-1 lg:grid-cols-2">
    @foreach ($radioOptions as $option)
        <div class="flex items-center">
            <input @if ($loop->first) checked @endif id="{{ $option }}" type="radio" value="{{ $option }}" name="{{ $name }}"
                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label for="{{ $option }}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                {{ ucfirst($option) }}
            </label>
        </div>
    @endforeach
</div>