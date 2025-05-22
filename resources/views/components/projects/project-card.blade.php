@props(['project'])

<div class="border rounded-lg p-4">
    {{-- title --}}
    <h2 class="text-center text-lg font-semibold mb-2">
        {{ $project->title }}
    </h2>

    {{-- description --}}
    <p class="text-justify mb-3">
        {{ substr( $project->description, 0, 200) }} ...
    </p>

    {{-- budget --}}
    <x-projectData.budget-data :project="$project" divCss='font-semibold flex items-center justify-between mb-5' />

    {{-- link to project details --}}
    <a href="{{ route('projects.show', $project) }}"
        class="block text-center bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded cursor-pointer transition">
        See details
    </a>
</div>