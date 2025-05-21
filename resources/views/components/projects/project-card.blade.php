@props(['project'])

<div class="border rounded-lg p-4">
    <h2 class="text-center text-lg mb-2">
        {{ $project->title }}
    </h2>

    <p class="text-justify mb-3">
        {{ substr( $project->description, 0, 200) }} ...
    </p>

    <div class="flex items-center justify-between mb-5">
        <p>
            {{ strtoupper($project->budget_type) }}
        </p>
        @if ($project->budget_type == 'fixed')
            <p>
                $ {{ $project->budget_amount }}
            </p>
        @else
            <p>
                $ {{ $project->hour_price }}
            </p>
        @endif
    </div>

    <a href="{{ route('projects.show', $project) }}"
        class="block text-center bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded cursor-pointer transition">
        See details
    </a>
</div>