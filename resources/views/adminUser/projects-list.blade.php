<x-layouts.app :title="__('All project')">

    {{-- all projects list --}}
    <x-projects.projects-list-container :projects="$allProjects" message='There are no projects'/>

    {{-- pagination option --}}
    <section class="pagination-option">
        {{ $allProjects->links() }}
    </section>

</x-layouts.app>