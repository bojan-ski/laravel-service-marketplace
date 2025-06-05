@props([
'label',
'data'
])

<div class="mb-3 pb-2 border-b">
    <h4 class="mb-1">
        {{ $label }}:
    </h4>

    <p class="font-semibold">
        {{ $data }}
    </p>
</div>