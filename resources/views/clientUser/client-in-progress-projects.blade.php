<x-layouts.app :title="__('My in progress projects')">

    {{-- all client user in progress projects list --}}
    <x-projects.projects-list-container :projects="$projects" message='There are no in progress projects, please come back later'/>

    {{-- pagination option --}}
    <section class="pagination-option">
        {{ $projects->links() }}
    </section>

</x-layouts.app>