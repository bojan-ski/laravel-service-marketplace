@props(['bid'])

<div class="border rounded-lg p-4">
    {{-- Status & Delete bid --}}
    <div class="flex items-center justify-between mb-3 pb-2 border-b">
        {{-- status --}}
        <h4 class="text-lg font-semibold">
            {{ strtoupper($bid->status) }}
        </h4>

        @if ($bid->status == 'pending')
            {{-- delete bid --}}
            <x-bids.delete-bid-card :bid="$bid"/>
        @endif
    </div>

    {{-- budget type --}}
    <div class="mb-3 pb-2 border-b">
        <h4 class="mb-1">
            Budget type:
        </h4>

        <p class="font-semibold">
            {{ strtoupper($bid->budget_type) }}
        </p>
    </div>

    {{-- bid amount --}}
    <div class="mb-3 pb-2 border-b">
        <h4 class="mb-1">
            Bid amount:
        </h4>

        <p class="font-semibold">
            {{ $bid->bid_amount }}
        </p>
    </div>

    {{-- estimated days --}}
    <div class="mb-3 pb-2 border-b">
        <h4 class="mb-1">
            Estimated days:
        </h4>

        <p class="font-semibold">
            {{ $bid->estimated_days }}
        </p>
    </div>

    {{-- bid message --}}
    <div class="mb-3">
        <h4 class="mb-1">
            Message:
        </h4>

        <p class="font-semibold">
            {{ $bid->bid_message }}
        </p>
    </div>

    {{-- link to project details --}}
    <a href="{{ route('projects.show', $bid->project_id) }}"
        class="block text-center bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded cursor-pointer transition">
        See project details
    </a>
</div>