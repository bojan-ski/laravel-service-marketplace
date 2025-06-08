@props([
    'label',
    'data'
])

<div>
    <h2 class="text-center text-2xl font-bold mb-5">
        {{ $label }}
    </h2>

    <section
        class="{{ $data->isNotEmpty() ? 'grid grid-cols-1 xl:grid-cols-2 gap-2' : '' }} mb-5">
        {{ $slot }}
    </section>
</div>