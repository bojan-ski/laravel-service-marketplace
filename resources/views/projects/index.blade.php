<x-layouts.app :title="__('All new project')">

    {{-- all open projects list --}}
    <section
        class="open-projects {{ $openProjects->isNotEmpty() ? 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-7' : '' }} mb-5">
        @forelse ($openProjects as $project)
            <x-projects.project-card :project="$project"/>            
        @empty
            <x-custom.no-data-message message="There are no new open projects, please come back later" />
        @endforelse
    </section>

    {{-- pagination option --}}
    <section class="pagination-option">
        {{ $openProjects->links() }}
    </section>

</x-layouts.app>