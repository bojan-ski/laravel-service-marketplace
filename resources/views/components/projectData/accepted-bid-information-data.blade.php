@props([
'label',
'data',
])

<div class="mb-3">
    <p class="mb-1">
        {{ $label }}:
    </p>

    <p class="font-semibold">
        {{ $data }}
    </p>
</div>