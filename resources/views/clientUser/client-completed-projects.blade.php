<x-layouts.app :title="__('My completed projects')">

    {{-- all client user completed projects list --}}
    <x-projects.projects-list-container :projects="$projects" message='There are no completed projects, please come back later'/>

    {{-- pagination option --}}
    <section class="pagination-option">
        {{ $projects->links() }}
    </section>

</x-layouts.app>