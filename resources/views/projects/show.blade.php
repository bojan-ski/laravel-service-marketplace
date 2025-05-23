<x-layouts.app :title="__($project->title)">

    {{-- Title & Status --}}
    <x-projectData.title-status :project="$project" />

    {{-- Description --}}
    <x-projectData.description :project="$project" />

    {{-- Requirements --}}
    <x-projectData.requirements :project="$project" />

    {{-- Budget & Deadline --}}
    <section class="font-semibold flex items-center justify-between mb-5">
        {{-- budget --}}
        <x-projectData.budget-data :project="$project" divCss='flex' paragraphCss='text-base md:text-lg'/>

        {{-- deadline --}}
        <x-projectData.deadline :project="$project" />
    </section>

    {{-- If document, download document option --}}
    @if($project->document_path)
        <x-projectData.download-document :project="$project" />
    @endif

    {{-- If open project --}}
    @if($project->status == 'open')
        @if (Auth::id() == $project->user_id)
            {{-- Client user - Manage open project --}}
            <x-projectData.client.manage-open-project :project="$project" />            
        @elseif(Auth::user()->account_type == 'freelancer')
            {{-- Freelancer user - Bid for the open project --}}
            <x-projectData.freelancer.bid-for-open-project :project="$project" />
        @endif
    @endif

</x-layouts.app>