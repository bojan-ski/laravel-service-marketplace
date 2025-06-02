import { initializePusher, subscribeToChannel } from './pusherSetup';
import { addMessage } from './addMessage';
import { openDeleteModal, closeDeleteModal, confirmDelete, removeMessage } from './deleteMessage';

document.addEventListener('DOMContentLoaded', () => {
    // get page variables
    const chatData = document.getElementById('conversation-data');
    const container = document.getElementById('messages-container');
    const form = document.getElementById('message-form');
    const input = document.getElementById('message');

    if (!container || !form || !input || !chatData) return;

    // get data from the blade element -> id="conversation-data"
    const csrfToken = chatData.dataset.csrfToken;
    const chatHash = chatData.dataset.chatHash;
    const currentAuthId = parseInt(chatData.dataset.authId);

    // init pusher API
    const pusher = initializePusher(csrfToken);

    // events
    const channelEventHandlers = {
        'message.sent': (data) => {
            if (data.sender_id !== currentAuthId) {
                addMessage(data, false, container, openDeleteModal);
            }
        },
        'message.deleted': (data) => {
            if (data.deleter_id !== currentAuthId) {
                removeMessage(data.message_id);
            }
        }
    };

    // setup channels
    const channel = subscribeToChannel(pusher, chatHash, channelEventHandlers);

    // form submit func for create new message
    form.onsubmit = async e => {
        e.preventDefault();

        // get input value
        const msg = input.value.trim();
        if (!msg) return;

        // get submit button
        const submitBtn = form.querySelector('button[type="submit"]');
        submitBtn.disabled = true;

        // add csrf token
        const formData = new FormData(form);
        formData.append('_token', csrfToken);

        // run func
        try {
            const response = await fetch(form.action, {
                method: 'POST',
                body: formData
            });
            const data = await response.json();

            if (data.success) {
                addMessage(data.data, true, container, openDeleteModal);
            } else {
                alert('Failed to send message');
            }
        } catch (error) {
            alert('There was an error sending the message');
        } finally {
            input.value = '';
            submitBtn.disabled = false;
        }
    };

    // delete message option
    window.openDeleteModal = openDeleteModal;
    window.closeDeleteModal = closeDeleteModal;
    window.confirmDelete = async () => await confirmDelete(csrfToken);
});