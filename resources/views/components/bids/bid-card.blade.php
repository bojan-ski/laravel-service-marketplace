@props(['bid'])

<div class="border rounded-lg p-4">

    {{-- Budget type & Delete bid --}}
    <div class="flex items-center justify-between mb-3 pb-2 border-b">
        {{-- budget type --}}
        <h2 class="text-lg font-semibold">
            {{ strtoupper($bid->status) }}
        </h2>

        @if ($bid->status == 'pending')
        {{-- delete bid --}}
        <form method="POST" action="{{ route('freelancer.bid.destroy', $bid) }}"
            onsubmit="return confirm('Are you sure you want to delete the bid?')">
            @csrf
            @method("DELETE")

            <button type="submit"
                class="font-semibold px-2.5 py-1 text-sm bg-red-500 hover:bg-red-700 text-white rounded cursor-pointer transition">
                X
            </button>
        </form>
        @endif
    </div>

    {{-- budget type --}}
    <div class="mb-3 pb-2 border-b">
        <h2 class="mb-1">
            Budget type:
        </h2>

        <p class="font-semibold">
            {{ strtoupper($bid->budget_type) }}
        </p>
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
    <div class="mb-3">
        <h2 class="mb-1">
            Message:
        </h2>

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