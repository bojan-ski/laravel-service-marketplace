<x-layouts.app :title="__('Conversations')">

    {{-- conversations container --}}
    <section
        class="conversations-list {{ $conversations->isNotEmpty() ? 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4' : '' }} mb-5">
        @forelse ($conversations as $conversation)
            <x-conversations.conversation-list-card :conversation="$conversation" />
        @empty
            <x-custom.no-data-message message="You have no active conversations" />
        @endforelse
    </section>

    {{-- pagination --}}
    <section class="pagination-option mb-10">
        {{ $conversations->links() }}
    </section>

</x-layouts.app>