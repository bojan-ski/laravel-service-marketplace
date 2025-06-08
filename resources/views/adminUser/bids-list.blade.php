<x-layouts.app :title="__('All bids')">

    {{-- select option --}}
    <x-custom.form-select-custom route='admin.bids.filter' name='filter_bids' :options="['all', 'pending', 'accepted', 'rejected']"/>

    {{-- all bids list --}}
    <section
        class="bided-projects-list-container {{ $allBids->isNotEmpty() ? 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-7' : '' }} mb-5">
        @forelse ($allBids as $bid)
            <x-bids.bid-card :bid="$bid" />
        @empty
            <x-custom.no-data-message message='There are no submitted bids' />
        @endforelse
    </section>

    {{-- pagination option --}}
    <section class="pagination-option">
        {{ $allBids->links() }}
    </section>

</x-layouts.app>