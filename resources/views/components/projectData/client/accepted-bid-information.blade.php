@props([
'project',
'acceptedBidData',
'freelancerData'
])

<section class="won-bid-details border-t pt-5">
    <h3 class="text-2xl font-semibold mb-5">
        Accepted Bid
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        {{-- Accepted bid data --}}
        <div class="mb-5 md:mb-0">
            {{-- bid amount --}}
            <div class="mb-3">
                <p class="mb-1">
                    Bid amount:
                </p>

                <p class="font-semibold">
                    {{ $acceptedBidData->bid_amount }}
                </p>
            </div>

            {{-- estimated days --}}
            <div class="mb-3">
                <p class="mb-1">
                    Estimated days:
                </p>

                <p class="font-semibold">
                    {{ $acceptedBidData->estimated_days }}
                </p>
            </div>

            {{-- bid message --}}
            <div class="mb-3">
                <p class="mb-1">
                    Message:
                </p>

                <p class="font-semibold">
                    {{ $acceptedBidData->bid_message }}
                </p>
            </div>
        </div>

        {{-- Accepted bid - freelancer data --}}
        <div class="mb-5 md:mb-0">
            {{-- username --}}
            <div class="mb-3">
                <p class="mb-1">
                    Username:
                </p>

                <p class="font-semibold">
                    {{ $freelancerData->name }}
                </p>
            </div>

            {{-- email --}}
            <div class="mb-3">
                <p class="mb-1">
                    Email:
                </p>

                <p class="font-semibold">
                    {{ $freelancerData->email }}
                </p>
            </div>

            {{-- message btn --}}
            <div class="mb-3">
                <a href="{{ route('conversations.thread', $project) }}"
                    class="block w-max bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded cursor-pointer transition">
                    Message
                </a>
            </div>
        </div>
    </div>
</section>