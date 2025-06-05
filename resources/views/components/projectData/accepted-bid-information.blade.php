@props([
'project',
'acceptedBidData',
'freelancerData',
'averageFreelancerRate',
'numberOfReceivedRatings'
])

<section class="won-bid-details border-t pt-5">
    <h3 class="text-2xl font-semibold mb-5">
        Accepted Bid
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        {{-- Accepted bid data --}}
        <div class="mb-5 md:mb-0">
            {{-- bid amount --}}
            <x-projectData.accepted-bid-information-data label='Bid amount' :data="$acceptedBidData->bid_amount" />

            {{-- estimated days --}}
            <x-projectData.accepted-bid-information-data label='Estimated days'
                :data="$acceptedBidData->estimated_days" />

            {{-- bid message --}}
            <x-projectData.accepted-bid-information-data label='Bid message' :data="$acceptedBidData->bid_message" />

            {{-- message btn --}}
            <div class="mb-3">
                <a href="{{ route('conversations.thread', $project) }}"
                    class="block w-max bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded cursor-pointer transition">
                    Message {{ $freelancerData->name }}
                </a>
            </div>
        </div>

        {{-- Accepted bid - freelancer data --}}
        <div class="mb-5 md:mb-0">
            {{-- username --}}
            <x-projectData.accepted-bid-information-data label='Username' :data="$freelancerData->name" />

            {{-- email --}}
            <x-projectData.accepted-bid-information-data label='Email' :data="$freelancerData->email" />

            {{-- rating --}}
            <div class="mb-3">
                <p class="mb-1">
                    Average rating:
                </p>

                <p class="font-semibold">
                    {{ round($averageFreelancerRate) }} ({{ $numberOfReceivedRatings }})
                </p>
            </div>
        </div>
    </div>
</section>