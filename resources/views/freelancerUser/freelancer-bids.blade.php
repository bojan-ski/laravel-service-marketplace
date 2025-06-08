<x-layouts.app :title="__('My bided projects')">

    {{-- select option --}}
    <x-custom.form-select-custom route='freelancer.bids.apply.select' name='freelancer_bids' :options="['all', 'pending', 'accepted', 'rejected']"/>

    {{-- all bided projects container list --}}
    <x-bids.bids-list-container :bids="$freelanceBids" message='You have not bided for any project!'/>

    {{-- pagination option --}}
    <section class="pagination-option">
        {{ $freelanceBids->links() }}
    </section>

</x-layouts.app>