export function addMessage(data, isSender, container, openDeleteModal) {
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

        deleteBtn.onclick = () => openDeleteModal(data.id);
        deleteBtn.className = 'text-red-500 hover:text-red-600 cursor-pointer';
        deleteBtn.innerHTML = 'X';
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

    // create/display message 
    messageDiv.appendChild(timeDiv);
    messageDiv.appendChild(messageParagraph);
    div.appendChild(messageDiv);
    container.appendChild(div);

    // scroll to latest message
    container.scrollTop = container.scrollHeight;
}