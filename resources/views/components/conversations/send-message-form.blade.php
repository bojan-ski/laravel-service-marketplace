@props(['conversation'])

<form id="message-form" method="POST" action="{{ route('messages.store', $conversation) }}" class="mt-5 pt-5 border-t">
    @csrf

    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
        <x-custom.input-custom name='message' minlength='5' maxlength='100' value="{{ request('message') }}"
            placeholder='Type your message...' :required="true" />

        <button type="submit"
            class="mb-4 w-full md:w-max bg-blue-500 hover:bg-blue-700 text-white px-8 py-2.5 rounded-md font-semibold transition cursor-pointer">
            Send
        </button>
    </div>
</form>