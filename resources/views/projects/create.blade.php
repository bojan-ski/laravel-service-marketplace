<x-layouts.app :title="__('Post new project')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        {{-- Post new project form --}}
        <x-form method="POST" :action="route('projects.store')" :upload="true">

            {{-- title --}}
            <x-custom.input-custom name='title' label='Project Title' value="{{ request('title') }}"
                placeholder='Enter project title' :required="true" />

            {{-- description --}}
            <x-custom.textarea-custom name='description' label='Project Description'
                value="{{ request('description') }}" placeholder='Describe your project in detail' :required="true" />

            {{-- requirements --}}
            <x-custom.textarea-custom name='requirements' label='Project Requirements'
                value="{{ request('requirements') }}" placeholder='Enter project requirements' :required="true" />

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4"
                x-data="{ budgetType: '{{ old('budget_type', 'fixed') }}' }">
                {{-- budget type --}}
                <x-custom.select-custom name='budget_type' label='Budget Type' value="{{ request('budget_type') }}"
                    :required="true" :options="['fixed', 'hourly']" xModel='budgetType' />

                {{-- budget amount --}}
                <div x-show="budgetType === 'fixed'">
                    <label for="budget_amount" class="block font-medium mb-2">
                        Budget Amount
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">$</span>
                        <input type="number" name="budget_amount" id="budget_amount" value="{{ old('budget_amount') }}"
                            class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            step="0.01" min="0">
                    </div>
                </div>

                {{-- hour price --}}
                <div x-show="budgetType === 'hourly'">
                    <label for="hour_price" class="block font-medium mb-2">
                        Hour Price
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">$</span>
                        <input type="number" name="hour_price" id="hour_price" value="{{ old('hour_price') }}"
                            class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            step="0.01" min="0">
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- deadline --}}
                <x-custom.input-custom type='date' name='deadline' label='Deadline' value="{{ request('deadline') }}"
                    min="{{ date('Y-m-d') }}" :required="true" />

                {{-- document upload --}}
                <x-custom.file-upload-custom name='document_path' label='Attachment (Optional)'
                    smallText='Max 1MB each. Accepted formats: PDF, DOC, DOCX' />
            </div>

            <div class="flex justify-end">
                {{-- cancel option --}}
                <a href="{{ route('projects.create') }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium py-2 px-4 rounded mr-2 cursor-pointer">
                    Cancel
                </a>

                {{-- submit option --}}
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded cursor-pointer">
                    Post Project
                </button>
            </div>

        </x-form>

    </div>
</x-layouts.app>