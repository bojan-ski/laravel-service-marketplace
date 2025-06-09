<x-layouts.app :title="__('All project')">

    {{-- select option --}}
    <x-custom.form-select-custom route='admin.projects.filter' name='filter_projects' :options="['all', 'open', 'in_progress', 'completed', 'cancelled']"/>

    {{-- all projects list --}}
    <x-projects.projects-list-container :projects="$allProjects" message='There are no projects'/>

    {{-- pagination option --}}
    <section class="pagination-option">
        {{ $allProjects->links() }}
    </section>

</x-layouts.app>