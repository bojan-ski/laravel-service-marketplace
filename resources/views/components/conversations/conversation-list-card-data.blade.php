@props([
    'label',
    'information'
])

<div class="mb-3">
    <span class="font-semibold">
        {{ $label }}:
    </span>
    <span>
        {{ $information }}
    </span>
</div>