<x-layouts.app :title="__('My cancelled projects')">

    {{-- all client user cancelled projects list --}}
    <section
        class="client-user-cancelled-projects {{ $projects->isNotEmpty() ? 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-7' : '' }} mb-5">
        @forelse ($projects as $project)
            <x-projects.project-card :project="$project"/>            
        @empty
            <x-custom.no-data-message message="There are no cancelled projects, please come back later" />
        @endforelse
    </section>

    {{-- pagination option --}}
    <section class="pagination-option">
        {{ $projects->links() }}
    </section>

</x-layouts.app>