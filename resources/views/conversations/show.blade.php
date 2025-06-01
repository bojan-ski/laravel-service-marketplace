<x-layouts.app :title="__('Messages')">

    {{-- Messages container --}}
    <div
        class="max-w-4xl mx-auto p-4 bg-yellow-50 rounded-lg shadow-md border border-yellow-200 min-h-[70vh] flex flex-col justify-between mb-10">

        {{-- messages --}}
        <section id="messages-container" class="messages-list space-y-3 overflow-y-auto max-h-[60vh] pr-2">
            @foreach ($messages as $message)
            <div class="flex {{ $message->sender_id === Auth::id() ? 'justify-end' : 'justify-start' }}"
                data-message-id="{{ $message->id }}">
                <div
                    class="max-w-sm px-4 py-2 rounded-lg shadow-sm bg-white text-gray-800 border border-gray-200 rounded-bl-none">
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
            @endforeach
        </section>

        {{-- message input form --}}
        <section class="send-message-form">
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
        </section>

    </div>

    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        // get page variables
        const container = document.getElementById('messages-container'); 
        const form = document.getElementById('message-form');
        const input = document.getElementById('message');

        // PUSHER
        const pusher = new Pusher('{{ config("broadcasting.connections.pusher.key") }}', {
            cluster: '{{ config("broadcasting.connections.pusher.options.cluster") }}',
            encrypted: true,
            authEndpoint: '/broadcasting/auth',
            auth: { headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content } }
        });

        // CHANNEL
        const channel = pusher.subscribe('private-chat.{{ $conversation->chat_hash }}');             

        // bind channel
        channel.bind('message.sent', data => {
            if (data.sender_id !== {{ Auth::id() }}) {
                addMessage(data, false);
                container.scrollTop = container.scrollHeight;
            }
        });

        // form submit
        form.onsubmit = e => {
            e.preventDefault();
            // get message value
            const msg = input.value.trim();
            if (!msg) return;

            //get submit btn
            const submitBtn = form.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            
            // get form & submit form data
            const formData = new FormData(form);
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
            fetch(form.action, { method: 'POST', body: formData })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        addMessage(data.data, true);
                        container.scrollTop = container.scrollHeight;
                    }
                })
                .catch(() => alert('Failed to send message'))
                .finally(()=> {
                    input.value = '';
                    submitBtn.disabled = false;
                })
        };

        // add message func
        function addMessage(data, isSender) {
            // create main div
            const div = document.createElement('div');
            div.className = `flex ${isSender ? 'justify-end' : 'justify-start'}`;
            
            // create message div
            const messageDiv = document.createElement('div');
            messageDiv.className = `max-w-sm px-4 py-2 rounded-lg shadow-sm ${isSender ? 'bg-blue-500 text-white' : 'bg-white text-gray-800 border border-gray-200'}`;
            
            // create time div
            const timeDiv = document.createElement('div');
            timeDiv.className = 'flex items-center mb-2';
            
            // create time paragraph
            const timeParagraph = document.createElement('p');
            timeParagraph.className = `text-xs ${isSender ? 'text-blue-100' : 'text-gray-500'}`;
            timeParagraph.textContent = data.created_at;
            timeDiv.appendChild(timeParagraph);
            
            // create message paragraph
            const messageParagraph = document.createElement('p');
            messageParagraph.className = 'text-sm mb-2';
            messageParagraph.textContent = data.message;
            
            // create message
            messageDiv.appendChild(timeDiv);
            messageDiv.appendChild(messageParagraph);
            div.appendChild(messageDiv);
            container.appendChild(div);
        };
    </script>

</x-layouts.app>