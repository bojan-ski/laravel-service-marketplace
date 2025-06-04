@props([
    'project',
    'newStatus'
])

<form method="POST" action="{{ route('projects.statusChange', [$project, $newStatus]) }}"
    onsubmit="return confirm('Are you sure you want to change the project status to: {{ ucfirst($newStatus) }}?')">
    @csrf
    @method("PUT")

    <button type="submit"
        class="font-semibold px-4 py-2 text-white rounded cursor-pointer transition {{ $newStatus == 'completed' ? 'bg-green-500 hover:bg-green-700' : 'bg-red-500 hover:bg-red-700' }}">
        {{ ucfirst($newStatus) }}
    </button>
</form>