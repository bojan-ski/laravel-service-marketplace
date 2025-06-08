<x-layouts.app :title="__($freelancer->name)">

    {{-- Freelancer information --}}
    <x-admin.user-basic-data :name="$freelancer->name" :email="$freelancer->email" />

    {{-- Freelancer submitted bids & conversation --}}
    <section class="grid grid-cols-1 md:grid-cols-2 gap-10 mb-10">
        
        {{-- submitted bids --}}
        <x-admin.user-main-data label='Submitted bids' :data="$freelancerUserBids">
            @forelse ($freelancerUserBids as $bid)  
                <x-bids.bid-card :bid="$bid" />                   
            @empty
                <x-custom.no-data-message message='No submitted bids' />
            @endforelse
        </x-admin>

        {{-- conversations --}}
        <x-admin.user-main-data label='Conversations' :data="$freelancerUserConversations">
            @forelse ($freelancerUserConversations as $conversation)
                <x-conversations.conversation-list-card :conversation="$conversation" />
            @empty
                <x-custom.no-data-message message='No conversations' />
            @endforelse
        </x-admin>

    </section>

</x-layouts.app>