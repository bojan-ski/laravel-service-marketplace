<x-layouts.app :title="__('My cancelled projects')">

    {{-- all client user cancelled projects list --}}
    <x-projects.projects-list-container :projects="$projects" message='There are no cancelled projects, please come back later'/>

    {{-- pagination option --}}
    <section class="pagination-option">
        {{ $projects->links() }}
    </section>

</x-layouts.app>