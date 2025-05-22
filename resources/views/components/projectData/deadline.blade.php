@props(['project'])

<div class="flex">
    <p class="text-base md:text-lg mr-2">
        DEADLINE:
    </p>
    <p class="text-base md:text-lg">
        {{ \Carbon\Carbon::parse($project->deadline)->format('d.m.Y') }}
    </p>
</div>