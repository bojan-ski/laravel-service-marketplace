<x-layouts.app :title="__('My Ratings')">

    {{-- User avg rating and total num of received ratings --}}
    <h2 class="text-2xl font-semibold mb-5">
        <span>
            My average rating:
        </span>
        <span class="font-bold">
            {{ round($avgUserRate) }} ({{ $numOfReceivedRatings }})
        </span>
    </h2>

    {{-- Ratings container - list --}}
    <section
        class="projects-list-container {{ $allUserRatings->isNotEmpty() ? 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4' : '' }} mb-5">
        @forelse ($allUserRatings as $userRating)
            <x-ratings.rating-card :userRating="$userRating" />
        @empty
            <x-custom.no-data-message message='No ratings' />
        @endforelse
    </section>

    {{-- Pagination option --}}
    <section class="pagination-option">
        {{ $allUserRatings->links() }}
    </section>

</x-layouts.app>