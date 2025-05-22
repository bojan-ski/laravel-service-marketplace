<x-layouts.app :title="__('My completed projects')">

    {{-- all client user completed projects list --}}
    <section
        class="client-user-completed-projects {{ $projects->isNotEmpty() ? 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-7' : '' }} mb-5">
        @forelse ($projects as $project)
            <x-projects.project-card :project="$project"/>            
        @empty
            <x-custom.no-data-message message="There are no completed projects, please come back later" />
        @endforelse
    </section>

    {{-- pagination option --}}
    <section class="pagination-option">
        {{ $projects->links() }}
    </section>

</x-layouts.app>