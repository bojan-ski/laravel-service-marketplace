@props(['project'])

<section class="flex items-center justify-between mb-5">
    <h2 class="font-bold text-xl md:text-3xl">
        {{ $project->title }}
    </h2>

    <h2 class="font-bold text-xl md:text-3xl">
        {{ strtoupper($project->status) }}
    </h2>
</section>