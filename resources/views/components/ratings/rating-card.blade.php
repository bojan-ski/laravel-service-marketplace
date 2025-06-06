@props(['userRating'])

<div class="border rounded-lg p-4">
    <h4 class="font-semibold mb-3">
        {{ $userRating->project->title }}
    </h4>

    {{-- freelance rated the client user --}}
    <p class="mb-3">
        <span>
            Client received rating:
        </span>
        <span class="font-bold">
            {{ $userRating->client_received_rate }}
        </span>
    </p>

    {{-- client rated the freelance user --}}
    <p class="mb-3">
        <span>
            Freelancer received rating:
        </span>
        <span class="font-bold">
            {{ $userRating->freelancer_received_rate }}
        </span>
    </p>

    {{-- link to project details --}}
    <a href="{{ route('projects.show', $userRating->project) }}"
        class="block text-center bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded cursor-pointer transition">
        See project details
    </a>
</div>