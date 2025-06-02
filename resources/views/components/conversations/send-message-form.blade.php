@props(['conversation'])

<form id="message-form" method="POST" action="{{ route('messages.store', $conversation) }}"
    class="mt-5 pt-5 border-t border-yellow-500">
    @csrf

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
        <x-custom.input-custom name='message' minlength='5' maxlength='100' value="{{ request('message') }}"
            placeholder='Type your message...' :required="true" />

        <div class="flex items-center justify-center">
            <button type="submit"
                class="w-full mb-4 bg-red-600 hover:bg-red-700 text-white px-4 py-2.5 rounded-md font-semibold text-sm transition duration-150 cursor-pointer">
                Send
            </button>
        </div>
    </div>
</form>