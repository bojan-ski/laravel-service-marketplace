@props(['project'])

<section class="flex items-center space-x-3 mb-5">
    {{-- edit open project --}}
    <a href="{{ route('projects.edit', $project) }}"
        class="font-semibold px-4 py-2 bg-yellow-500 hover:bg-yellow-700 text-white rounded cursor-pointer transition">
        Edit
    </a>

    {{-- delete open project --}}
    <form method="POST" action="{{ route('projects.destroy', $project) }}"
        onsubmit="return confirm('Are you sure you want to delete the open project?')">
        @csrf
        @method("DELETE")

        <button type="submit"
            class="font-semibold px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded cursor-pointer transition">
            Delete
        </button>
    </form>
</section>