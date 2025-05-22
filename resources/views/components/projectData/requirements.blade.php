@props(['project'])

<section class="mb-5">
    <h3 class="mb-2 font-semibold text-lg md:text-xl">
        Project requirements
    </h3>

    <p class="text-justify text-base md:text-lg">
        {{ $project->requirements }}
    </p>
</section>