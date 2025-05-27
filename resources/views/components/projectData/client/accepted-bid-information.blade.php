@props([
'acceptedBidData',
'freelancerData'
])

<section class="won-bid-details border-t pt-5">
    <h3 class="text-3xl text-center font-semibold mb-5">
        Accepted Bid
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        {{-- Accepted bid data --}}
        <div class="mb-5 md:mb-0">
            {{-- bid amount --}}
            <div class="mb-3">
                <h2 class="mb-1">
                    Bid amount:
                </h2>

                <p class="font-semibold">
                    {{ $acceptedBidData->bid_amount }}
                </p>
            </div>

            {{-- estimated days --}}
            <div class="mb-3">
                <h2 class="mb-1">
                    Estimated days:
                </h2>

                <p class="font-semibold">
                    {{ $acceptedBidData->estimated_days }}
                </p>
            </div>

            {{-- bid message --}}
            <div class="mb-3">
                <h2 class="mb-1">
                    Message:
                </h2>

                <p class="font-semibold">
                    {{ $acceptedBidData->bid_message }}
                </p>
            </div>
        </div>

        {{-- Accepted bid - freelancer data --}}
        <div class="mb-5 md:mb-0">
            {{-- username --}}
            <div class="mb-3">
                <h2 class="mb-1">
                    Username:
                </h2>

                <p class="font-semibold">
                    {{ $freelancerData->name }}
                </p>
            </div>

            {{-- email --}}
            <div class="mb-3">
                <h2 class="mb-1">
                    Email:
                </h2>

                <p class="font-semibold">
                    {{ $freelancerData->email }}
                </p>
            </div>

            {{-- message btn --}}
            <div class="mb-3">
                <a href="/"
                    class="block w-max bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded cursor-pointer transition">
                    Message
                </a>

                {{-- <a href="{{ route('conversations.thread', [$listing, $carListingOwner->id]) }}"
                    class="block w-max mt-2 text-sm bg-red-600 hover:bg-red-700 transition duration-150 text-white px-3 py-1.5 rounded-md font-semibold cursor-pointer">
                    Send message
                </a> --}}
            </div>
        </div>
    </div>
</section>