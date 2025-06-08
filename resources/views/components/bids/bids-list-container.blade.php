@props([
    'bids',
    'message'
])

<section
    class="bided-projects-list-container {{ $bids->isNotEmpty() ? 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4' : '' }} mb-5">
    @forelse ($bids as $bid)
        <x-bids.bid-card :bid="$bid" />
    @empty
        <x-custom.no-data-message message='{{ $message }}' />
    @endforelse
</section>