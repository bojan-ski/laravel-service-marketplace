@props(['message'])

<button onclick="deleteMessage({{ $message->id }})" class="text-red-500 hover:text-red-600" title="Delete message">
    X
</button>

<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 max-w-sm mx-4">
        <h3 class="text-lg font-semibold mb-4">
            Delete Message
        </h3>
        <p class="text-gray-600 mb-6">
            Are you sure you want to delete this message?
        </p>
        
        <div class="flex justify-end space-x-3">
            {{-- close modal --}}
            <button onclick="closeDeleteModal()" class="px-4 py-2 text-gray-600 hover:text-gray-800 transition-colors">
                Cancel
            </button>

            {{-- confirm/delete selected message --}}
            <button onclick="confirmDelete()"
                class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded transition-colors">
                Delete
            </button>
        </div>
    </div>
</div>