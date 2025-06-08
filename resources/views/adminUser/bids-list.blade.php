<x-layouts.app :title="__('All bids')">

    {{-- select option --}}
    <x-custom.form-select-custom route='admin.bids.filter' name='filter_bids' :options="['all', 'pending', 'accepted', 'rejected']"/>

    {{-- all bids list --}}
    <x-bids.bids-list-container :bids="$allBids" message='There are no submitted bids'/>

    {{-- pagination option --}}
    <section class="pagination-option">
        {{ $allBids->links() }}
    </section>

</x-layouts.app>