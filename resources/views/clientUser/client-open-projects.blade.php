<x-layouts.app :title="__('My opened projects')">

    {{-- all client user open projects list --}}
    <x-projects.projects-list-container :projects="$projects" message='There are no open projects, please come back later'/>

    {{-- pagination option --}}
    <section class="pagination-option">
        {{ $projects->links() }}
    </section>

</x-layouts.app>