@props(['message'])

<div class="flex {{ $message->sender_id === Auth::id() ? 'justify-end' : 'justify-start' }}"
    data-message-id="{{ $message->id }}">
    <div class="max-w-sm px-4 py-2 rounded-lg shadow-sm bg-white text-gray-800 border border-gray-200 {{ $message->sender_id === Auth::id() ? 'rounded-br-none' : 'rounded-bl-none' }}">
        {{-- delete message --}}
        @if($message->sender_id == Auth::id())
            <x-conversations.delete-message :message="$message" />
        @endif

        <div class="flex items-center mb-2">
            {{-- when message was send (time) --}}
            <p class="text-xs mr-2">
                {{ $message->created_at->diffForHumans() }}
            </p>
        </div>

        {{-- message - content --}}
        <p class="text-sm mb-2">
            {{ $message->message }}
        </p>
    </div>
</div>