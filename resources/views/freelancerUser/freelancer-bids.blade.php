<x-layouts.app :title="__('My bided projects')">

    {{-- select option --}}
    <x-custom.form-select-custom route='freelancer.bids.apply.select' name='freelancer_bids' :options="['all', 'pending', 'accepted', 'rejected']"/>

    {{-- all bided projects container list --}}
    <section
        class="bided-projects-list-container {{ $freelanceBids->isNotEmpty() ? 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-7' : '' }} mb-5">
        @forelse ($freelanceBids as $bid)
            <x-bids.bid-card :bid="$bid" />
        @empty
            <x-custom.no-data-message message='You have not bided for any project!' />
        @endforelse
    </section>

    {{-- pagination option --}}
    <section class="pagination-option">
        {{ $freelanceBids->links() }}
    </section>

</x-layouts.app>