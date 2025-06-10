<x-layouts.app :title="__('All conversations')">

    {{-- all conversations list --}}
    <section
        class="all-conversations-list {{ $allConversations->isNotEmpty() ? 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4' : '' }} mb-5">
        @forelse ($allConversations as $conversation)        
            <x-conversations.conversation-list-card :conversation="$conversation" />
        @empty
            <x-custom.no-data-message message="No conversations" />
        @endforelse
    </section>

    {{-- pagination option --}}
    <section class="pagination-option">
        {{ $allConversations->links() }}
    </section>

</x-layouts.app>