<x-layouts.app :title="__($client->name)">

    {{-- Client information --}}
    <x-admin.user-basic-data :name="$client->name" :email="$client->email" />

    {{-- Client projects & conversation --}}
    <section class="grid grid-cols-1 md:grid-cols-2 gap-10 mb-10">
        
        {{-- projects --}}
        <x-admin.user-main-data label='Projects' :data="$clientUserProjects">
            @forelse ($clientUserProjects as $project)
                <x-projects.project-card :project="$project" />                     
            @empty
                <x-custom.no-data-message message='No projects' />
            @endforelse
        </x-admin>

        {{-- conversations --}}
        <x-admin.user-main-data label='Conversations' :data="$clientUserConversations">
            @forelse ($clientUserConversations as $conversation)
                <x-conversations.conversation-list-card :conversation="$conversation" />
            @empty
                <x-custom.no-data-message message='No conversations' />
            @endforelse
        </x-admin>

    </section>

</x-layouts.app>