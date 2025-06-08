@props([
    'projects',
    'message'
])

<section
    class="projects-list-container {{ $projects->isNotEmpty() ? 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4' : '' }} mb-5">
    @forelse ($projects as $project)
        <x-projects.project-card :project="$project" />
    @empty
        <x-custom.no-data-message message='{{ $message }}' />
    @endforelse
</section>