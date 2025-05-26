@props([
    'route',
    'name',
    'options'
])

<form method="GET" action="{{ route($route) }}" x-data class="w-60 mb-5">
    <x-custom.select-custom name="{{ $name }}" value="{{ request($name) }}" :required="true"
        :options="$options" x-on:change="$root.submit()" />
</form>