@props([
    'label',
    'data'
])

<div class="mb-3 pb-2 border-b">
    <span class="mb-1">
        {{ $label }}:
    </span>

    <span class="font-semibold">
        {{ $data }}
    </span>
</div>