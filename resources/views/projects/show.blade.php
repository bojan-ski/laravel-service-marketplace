<x-layouts.app :title="__($project->title)">

    {{-- Title & Status --}}
    <x-projectData.title-status :project="$project" />

    {{-- Client ratings --}}
    <x-projectData.client-rating 
        :project="$project" 
        :averageClientRate="$averageClientRate" 
        :clientNumberOfReceivedRatings="$clientNumberOfReceivedRatings" 
    />

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

    {{-- If document available, download document option --}}
    @if($project->document_path)
        <x-projectData.download-document :project="$project" />
    @endif

    {{-- If open project --}}
    @if($project->status == 'open')
        @if (Auth::id() == $project->user_id || Auth::user()->account_type == 'admin')
            {{-- Client user - Manage open project --}}
            <x-projectData.client.manage-open-project :project="$project" />
        @elseif(Auth::user()->account_type == 'freelancer')
            {{-- Freelancer user - Bid for the open project --}}
            <x-projectData.freelancer.bid-for-open-project :project="$project" />
        @endif
    @endif

    {{-- If not open project --}}
    @if($project->status !== 'open' && Auth::id() == $project->user_id)
    {{-- Client user - change project status (completed or canceled) --}}
        <x-projectData.client.manage-project-status :project="$project" />
    @endif
    
    {{-- If project status completed or canceled - rating options --}}
    @if(($project->status == 'completed' || $project->status == 'cancelled') && (Auth::id() == $project->user_id || Auth::id() == $freelancerData->id))    
        <x-projectData.rating-option :project="$project" :freelancerData="$freelancerData" />    
    @endif  

    {{-- If bid accepted - display accepted bid & freelancer data --}}
    @if($freelancerData && (Auth::id() == $project->user_id || Auth::id() == $freelancerData->id || Auth::user()->account_type == 'admin'))
        <x-projectData.accepted-bid-information 
            :project="$project" 
            :acceptedBidData="$acceptedBidData"
            :freelancerData="$freelancerData" 
            :averageFreelancerRate="$averageFreelancerRate"
            :numberOfReceivedRatings="$numberOfReceivedRatings"
        />
    @endif

    {{-- Submitted bids & Countdown timer --}}
    <section class="submitted-bids border-t pt-5">
        {{-- countdown timer --}}
        @if($project->status == 'open')
            <x-projectData.countdown-timer :project="$project" />
        @endif

        {{-- submitted bids --}}
        @if ($submittedBids->isNotEmpty())
            <h3 class="text-3xl text-center font-semibold mb-5">
                Received bids from freelancers
            </h3>
        @endif

        <div
            class="submitted-bids-list grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mb-5">
            @foreach ($submittedBids as $bid)
                <x-projectData.submitted-bid-card :project="$project" :bid="$bid" />
            @endforeach
        </div>
    </section>

</x-layouts.app>

