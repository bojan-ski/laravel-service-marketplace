@props([
'project',
'freelancerData'
])

<section class="ratings border-t pt-5 mb-5">
    
    <p class="mb-3">
        <span>Client - {{ $project->client->name }} - rated: </span>
        <span class="font-bold">
            {{ $project->rating->client_received_rate ? $project->rating->client_received_rate : '' }}
        </span>
    </p>

    <p class="mb-3">
        <span>Freelancer - {{ $freelancerData->name }} - rated: </span>
        <span class="font-bold">
            {{ $project->rating->freelancer_received_rate ? $project->rating->freelancer_received_rate : '' }}
        </span>
    </p>

    {{-- Rating option --}}
    <div id="rating-option" x-data="{ open: false }">
        {{-- open/close modal --}}
        <button @click="open = true"
            class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded cursor-pointer transition">
            Rate {{ Auth::id() == $project->user_id ? $project->acceptedBid->freelancer->name : $project->client->name
            }}
        </button>

        {{-- ratings modal --}}
        <div x-cloak x-show="open" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
            <div @click.away="open = false" class="bg-white text-black p-6 rounded-lg shadow-md w-full max-w-md">

                <x-form method="PUT" :action="route('ratings.rateUser', $project)">

                    <h4 class="text-center font-semibold text-xl mb-5">
                        Rate {{ Auth::id() == $project->user_id ? $project->acceptedBid->freelancer->name :
                        $project->client->name }}
                    </h4>

                    {{-- rating --}}
                    <x-custom.select-custom name='rating' value="{{ request('rating') }}" :required="true"
                        :options="['1', '2', '3', '4', '5']" />

                    {{-- submit & cancel options --}}
                    <div class="text-end mt-5">
                        <button type="button" @click="open = false"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium py-2 px-4 rounded mr-2 cursor-pointer transition">
                            Cancel
                        </button>

                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded cursor-pointer transition">
                            Submit
                        </button>
                    </div>

                </x-form>

            </div>
        </div>
    </div>

</section>