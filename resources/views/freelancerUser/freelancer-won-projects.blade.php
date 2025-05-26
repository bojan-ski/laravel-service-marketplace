<x-layouts.app :title="__('All new project')">

    {{-- select option --}}
    <form method="GET" action="{{ route('freelancer.apply.select') }}" x-data class="w-60 mb-5">
        <x-custom.select-custom name='freelancer_projects' value="{{ request('freelancer_projects') }}" :required="true"
            :options="['all', 'in_progress', 'completed', 'cancelled']" x-on:change="$root.submit()" />
    </form>

    {{-- all open projects list --}}
    <x-projects.projects-list-container :projects="$projects"
        message='There are no projects' />

    {{-- pagination option --}}
    <section class="pagination-option">
        {{ $projects->links() }}
    </section>

</x-layouts.app>