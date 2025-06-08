<x-layouts.app :title="__('All freelancer users')">

    {{-- All freelancer users container - list --}}
    <section
        class="freelancer-users-list {{ $allFreelancerUsers->isNotEmpty() ? 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4' : '' }} mb-5">
        @forelse ($allFreelancerUsers as $freelancer)
            <x-admin.user-list-card :user="$freelancer" route='admin.freelancer'>
                {{-- num of bids submitted --}}
                <x-admin.user-list-card-data label='Bids' :data="$freelancer->bids_count" />
            </x-admin.user-list-card>
        @empty
            <x-custom.no-data-message message='No freelancer users' />
        @endforelse
    </section>

    {{-- Pagination option --}}
    <section class="pagination-option">
        {{ $allFreelancerUsers->links() }}
    </section>

</x-layouts.app>