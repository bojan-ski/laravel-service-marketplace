let selectedMessageId = null;

// open modal
export function openDeleteModal(messageId) {
    selectedMessageId = messageId;
    const modal = document.getElementById('deleteModal');

    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
}

// close modal
export function closeDeleteModal() {
    selectedMessageId = null;
    const modal = document.getElementById('deleteModal');

    if (modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
}

// run delete message func
export async function confirmDelete(csrfToken) {
    // if no message data
    if (!selectedMessageId) return alert('No message selected');

    // run func
    try {
        const response = await fetch(`/conversations/messages/${selectedMessageId}/destroy`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json',
            }
        });
        const data = await response.json();

        if (data.success) {
            removeMessage(selectedMessageId);
            closeDeleteModal();
        } else {
            alert('Failed to delete message');
        }
    } catch (error) {
        alert('There was an error deleting the message');
    }
}

// remove message
export function removeMessage(messageId) {
    const messageElement = document.querySelector(`[data-message-id="${messageId}"]`);

    if (messageElement) {
        messageElement.style.transition = 'opacity 0.3s ease';
        messageElement.style.opacity = '0';

        setTimeout(() => {
            messageElement.remove();
        }, 300);
    }
}