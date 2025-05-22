@props(['project'])

<section class="flex space-x-3 mb-5">
    <p class="text-base md:text-lg">
        Available documentation:
    </p>

    <a href="{{ asset('storage/' . $project->document_path) }}"
        class="text-base md:text-lg text-blue-500 hover:text-blue-700" download>
        Download
    </a>
</section>