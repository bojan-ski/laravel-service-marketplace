@props(['conversation'])

<div class="border rounded-lg p-4">
    {{-- project title --}}
    <div class="flex items-center justify-between mb-3">
        <h3 class="font-semibold text-center text-lg">
            {{ $conversation->project->title }}
        </h3>

        @if ($conversation->unread_count > 0)
            <span class="text-xs font-semibold bg-blue-500 text-white px-2 py-0.5 rounded-full shadow">
                New
            </span>
        @endif
    </div>

    {{-- client name --}}
    <x-conversations.conversation-list-card-data label='Client' :information="$conversation->client->name" />

    {{-- freelancer name --}}
    <x-conversations.conversation-list-card-data label='Freelancer' :information="$conversation->freelancer->name" />

    {{-- project deadline --}}
    <x-conversations.conversation-list-card-data label='Deadline'
        :information="\Carbon\Carbon::parse($conversation->project->deadline)->format('d.m.Y')" />

    {{-- project status --}}
    <x-conversations.conversation-list-card-data label='Client'
        :information="$conversation->project->status == 'in_progress' ? 'In progress' : ucfirst($conversation->project->status)" />

    {{-- message btn --}}
    <div>
        <a href="{{ route('conversations.thread', [$conversation->project->id, $conversation->freelancer->id]) }}"
            class="block text-center bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-3 rounded cursor-pointer transition">
            Message
        </a>
    </div>
</div>