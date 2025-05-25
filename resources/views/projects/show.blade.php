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
        <x-projectData.budget-data :project="$project" divCss='flex' paragraphCss='text-base md:text-lg' />

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

    {{-- Submitted bids --}}
    <section class="submitted-bids border-t pt-5">
        @if ($submittedBids->isNotEmpty())
            <h3 class="text-3xl text-center font-semibold mb-5">
                Received bids from freelancers
            </h3>
        @endif        

        <div
            class="submitted-bids-list {{ $submittedBids->isNotEmpty() ? 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-7' : '' }} mb-5">
            @forelse ($submittedBids as $bid)
                <x-projectData.submitted-bid-card :project="$project" :bid="$bid" />
            @empty
                <x-custom.no-data-message message='You have not received any bids for this project!' />
            @endforelse
        </div>
    </section>

</x-layouts.app>