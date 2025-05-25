@props([
'project',
'bid'
])

{{-- if project owner (client user) see all submitted bids | freelancer user can see only his/her submitted bid --}}
@if ($project->user_id == Auth::id() || $bid->freelancer_id == Auth::id())
    <div class="border rounded-lg p-4">

        {{-- Status --}}
        <div class="flex items-center justify-between mb-3 pb-2 border-b">
            <h2 class="text-lg font-semibold">
                {{ strtoupper($bid->status) }}
            </h2>

            @if ($bid->freelancer_id == Auth::id() && $bid->status == 'pending')
                {{-- delete bid --}}
                <x-bids.delete-bid-card :bid="$bid"/>
            @endif
        </div>

        {{-- bid amount --}}
        <div class="mb-3 pb-2 border-b">
            <h2 class="mb-1">
                Bid amount:
            </h2>

            <p class="font-semibold">
                {{ $bid->bid_amount }}
            </p>
        </div>

        {{-- estimated days --}}
        <div class="mb-3 pb-2 border-b">
            <h2 class="mb-1">
                Estimated days:
            </h2>

            <p class="font-semibold">
                {{ $bid->estimated_days }}
            </p>
        </div>

        {{-- bid message --}}
        <div>
            <h2 class="mb-1">
                Message:
            </h2>

            <p class="font-semibold">
                {{ $bid->bid_message }}
            </p>
        </div>

        {{-- Client user - accept & reject options--}}
        @if ($project->user_id == Auth::id() && $bid->status == 'pending')
            <x-projectData.client.manage-submitted-bid :project="$project" :bid="$bid" />
        @endif

    </div>
@endif