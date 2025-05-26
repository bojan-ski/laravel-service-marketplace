<x-layouts.app :title="__('Won project')">

    {{-- select option --}}
    <x-custom.form-select-custom route='freelancer.won.projects.apply.select' name='freelancer_projects' :options="['all', 'in_progress', 'completed', 'cancelled']"/>

    {{-- all open projects list --}}
    <x-projects.projects-list-container :projects="$projects" message='There are no projects' />

    {{-- pagination option --}}
    <section class="pagination-option">
        {{ $projects->links() }}
    </section>

</x-layouts.app>