@props([
'project',
'bid'
])

{{-- if project owner (client user) see all submitted bids | freelancer user can see only his/her submitted bid --}}
@if ($project->user_id == Auth::id() || $bid->freelancer_id == Auth::id())
    <div class="border rounded-lg p-4">

        {{-- Bid status --}}
        <div class="flex items-center justify-between mb-3 pb-2 border-b">
            <h4 class="text-lg font-semibold">
                {{ strtoupper($bid->status) }}
            </h4>

            @if ($bid->freelancer_id == Auth::id() && $bid->status == 'pending')
                {{-- delete bid --}}
                <x-bids.delete-bid-card :bid="$bid"/>
            @endif
        </div>

        {{-- Bid amount --}}
        <div class="mb-3 pb-2 border-b">
            <h4 class="mb-1">
                Bid amount:
            </h4>

            <p class="font-semibold">
                {{ $bid->bid_amount }}
            </p>
        </div>

        {{-- Estimated days --}}
        <div class="mb-3 pb-2 border-b">
            <h4 class="mb-1">
                Estimated days:
            </h4>

            <p class="font-semibold">
                {{ $bid->estimated_days }}
            </p>
        </div>

        {{-- Bid message --}}
        <div class="mb-3 pb-2 border-b">
            <h4 class="mb-1">
                Message:
            </h4>

            <p class="font-semibold">
                {{ $bid->bid_message }}
            </p>
        </div>

        {{-- Bid message --}}
        <div>
            <h4 class="mb-1">
                Freelancer average rating:
            </h4>

            <p class="font-semibold">
                {{ round($bid->freelancer_avg_received_rate) }} ({{ $bid->freelancer_num_received_ratings }})
            </p>
        </div>

        {{-- Client user - accept & reject options--}}
        @if ($project->user_id == Auth::id() && $bid->status == 'pending')
            <x-projectData.client.manage-submitted-bid :project="$project" :bid="$bid" />
        @endif

    </div>
@endif