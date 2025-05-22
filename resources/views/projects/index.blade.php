<x-layouts.app :title="__('All new project')">

    {{-- search option --}}
    <section class="search-option text-center lg:text-start mb-5">
        <x-projects.search-option />
    </section>

    {{-- all open projects list --}}
    <x-projects.projects-list-container :projects="$openProjects" message='There are no new open projects, please come back later'/>

    {{-- pagination option --}}
    <section class="pagination-option">
        {{ $openProjects->links() }}
    </section>

</x-layouts.app>