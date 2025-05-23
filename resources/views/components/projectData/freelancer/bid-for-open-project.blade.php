@props(['project'])

<section x-data="{ open: false }">
    <button @click="open = true"
        class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded cursor-pointer transition">
        Bid for {{ $project->title }}
    </button>

    <div x-cloak x-show="open" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div @click.away="open = false" class="bg-white text-black p-6 rounded-lg shadow-md w-full max-w-md">

            <x-form method="POST" :action="route('projects.store', $project)">
                {{-- <x-form method="POST" :action="route('bids.store', $project)"> --}}

                    {{-- Budget --}}
                    <x-projectData.budget-data :project="$project"
                        divCss='flex items-center justify-center font-semibold mb-2'
                        paragraphCss='text-base md:text-lg' />

                    {{-- Offer --}}
                    <x-custom.input-custom type='number' name='project_bid' label='Your bid'
                        value="{{ request('project_bid') }}" placeholder='Enter your bid' :required="true" />

                    {{-- Estimated days --}}
                    <x-custom.input-custom type='number' name='estimated_days' label='Your estimation'
                        value="{{ request('estimated_days') }}" placeholder='Enter number of days' :required="true" />

                    {{-- Message --}}
                    <x-custom.textarea-custom name='bid_message' label='Your message'
                        value="{{ request('bid_message') }}" placeholder='Enter your message' rows='4'
                        :required="true" />

                    {{-- Submit & Cancel options --}}
                    <div class="text-end">
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
</section>