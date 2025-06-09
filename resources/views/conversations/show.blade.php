<x-layouts.app :title="__('Messages')">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-10">
        {{-- Project data --}}
        <section>
            {{-- project title --}}
            <h2 class="text-2xl font-bold mb-5">
                {{ $conversation->project->title }}
            </h2>

            {{-- client name --}}
            <x-conversations.conversation-list-card-data label='Client' :information="$conversation->client->name" />

            {{-- freelancer name --}}
            <x-conversations.conversation-list-card-data label='Freelancer'
                :information="$conversation->freelancer->name" />

            {{-- project deadline --}}
            <x-conversations.conversation-list-card-data label='Deadline'
                :information="\Carbon\Carbon::parse($conversation->project->deadline)->format('d.m.Y')" />

            {{-- project status --}}
            <x-conversations.conversation-list-card-data label='Status'
                :information="$conversation->project->status == 'in_progress' ? 'In progress' : ucfirst($conversation->project->status)" />
        </section>

        {{-- Messages container & form --}}
        <section
            class="w-full p-4 rounded-lg shadow-md border min-h-[85vh] flex flex-col justify-between lg:col-span-2">

            {{-- messages container --}}
            <div id="messages-container" class="space-y-3 overflow-y-auto max-h-[75vh] pr-2">
                @foreach ($messages as $message)
                    <x-conversations.message-card :message="$message" />
                @endforeach
            </div>

            {{-- new message form --}}
            @if (Auth::user()->account_type !== 'admin')
                <div class="send-message-form">
                    <x-conversations.send-message-form :conversation="$conversation" />
                </div>                
            @endif
        </section>
    </div>

    {{-- Conversation data --}}
    <div 
        id="conversation-data" 
        data-csrf-token="{{ csrf_token() }}" 
        data-chat-hash="{{ $conversation->chat_hash }}"
        data-auth-id="{{ Auth::id() }}" 
        class="hidden">
    </div>

    {{-- Import conversation/chat feature --}}
    @vite('resources/js/chat/conversation.js')

</x-layouts.app>