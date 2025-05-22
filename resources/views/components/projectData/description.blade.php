@props(['project'])

<section class="mb-5">
    <h3 class="mb-2 font-semibold text-lg md:text-xl">
        Project description
    </h3>

    <p class="text-justify text-base md:text-lg">
        {{ $project->description }}
    </p>
</section>