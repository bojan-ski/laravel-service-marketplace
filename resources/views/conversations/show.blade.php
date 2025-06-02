<x-layouts.app :title="__('Messages')">

    {{-- Messages container --}}
    <div
        class="max-w-4xl mx-auto p-4 bg-yellow-50 rounded-lg shadow-md border border-yellow-200 min-h-[70vh] flex flex-col justify-between mb-10">

        {{-- messages - list --}}
        <section id="messages-container" class="messages-list space-y-3 overflow-y-auto max-h-[60vh] pr-2">
            @foreach ($messages as $message)
                <x-conversations.message-card :message="$message" />
            @endforeach
        </section>

        {{-- new message form --}}
        <section class="send-message-form">
           <x-conversations.send-message-form :conversation="$conversation" />
        </section>

    </div>

    {{-- Conversation data --}}
    <div id="conversation-data"
        data-csrf-token="{{ csrf_token() }}"
        data-chat-hash="{{ $conversation->chat_hash }}"
        data-auth-id="{{ Auth::id() }}"
        class="hidden">
    </div>

    {{-- Import conversation/chat feature --}}
    @vite('resources/js/chat/conversation.js')
    

    {{-- <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script> --}}
    {{-- <script>
    document.addEventListener('DOMContentLoaded', () => {
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

         // listen for new messages
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
                    }else{
                        alert('Failed to send message');
                    }
                })
                .catch(() => alert('There was an error sending the message'))
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
            div.setAttribute('data-message-id', data.id);
            
            // create message div
            const messageDiv = document.createElement('div');
            messageDiv.className = `max-w-sm px-4 py-2 rounded-lg shadow-sm ${isSender ? 'bg-blue-500 text-white' : 'bg-white text-gray-800 border border-gray-200'}`;
            
            // create delete button for message sender
            if (isSender) {                
                const deleteBtn = document.createElement('button');

                deleteBtn.onclick = () => deleteMessage(data.id);
                deleteBtn.className = 'text-red-500 hover:text-red-600';
                deleteBtn.innerHTML = 'X';
                deleteBtn.title = 'Delete message';
                messageDiv.appendChild(deleteBtn);
            }
            
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
  
        // listen for deleted messages
        channel.bind('message.deleted', data => {
            if (data.deleter_id !== {{ Auth::id() }}) {
                removeMessage(data.message_id);
            }
        });
        
        // set variable
        let selectedMessageId = null;
        
        // open modal
        function deleteMessage(messageId) {
            selectedMessageId = messageId;

            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteModal').classList.add('flex');
        }

        // close modal
        function closeDeleteModal() {
            selectedMessageId = null;

            document.getElementById('deleteModal').classList.add('hidden');
            document.getElementById('deleteModal').classList.remove('flex');
        }

        // delete message
        function confirmDelete() {     
            fetch(`/conversations/messages/${selectedMessageId}/destroy`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                }
            })
            .then(r => r.json())
            .then(data => {                
                if (data.success) {
                    removeMessage(selectedMessageId);
                    closeDeleteModal();
                }else{
                    alert('Failed to delete message');
                }
            })
            .catch(() => alert('There was an error deleting the message'))
        };
        
        // delete message - FE
        function removeMessage(selectedMessageId) {         
            const messageElement = document.querySelector(`[data-message-id="${selectedMessageId}"]`);

            if (messageElement) {
                messageElement.style.transition = 'opacity 0.3s ease';
                messageElement.style.opacity = '0';
                setTimeout(() => {
                    messageElement.remove();
                }, 300);
            }
        }
    });
    </script> --}}

</x-layouts.app>