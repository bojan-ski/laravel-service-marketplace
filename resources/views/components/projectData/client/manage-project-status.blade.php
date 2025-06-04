@props(['project'])

<div class="flex items-center space-x-3 mb-5">
    {{-- change project status to completed --}}
    <x-projectData.client.manage-project-status-form :project="$project" newStatus='completed' />

    {{-- change project status to cancelled --}}
    <x-projectData.client.manage-project-status-form :project="$project" newStatus='cancelled' />
</div>