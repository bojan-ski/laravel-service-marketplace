@props(['user'])

<section id="delete-user-option" x-data="{ open: false }" class="mb-3">
    {{-- Open/Close Modal --}}
    <button @click="open = true" class="bg-red-500 hover:bg-red-700 text-white font-medium py-1.5 px-3.5 rounded cursor-pointer transition">
        Delete User
    </button>

    {{-- Delete user modal --}}
    <div x-cloak x-show="open" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div @click.away="open = false" class="bg-white text-black p-6 rounded-lg shadow-md w-full max-w-md">

            <h3 class="text-center text-lg font-bold mb-3">
                Are you sure you want to delete {{ $user->username }}?
            </h3>

            <x-form method="DELETE" :action="route('admin.deleteUser', $user)">
                {{-- submit & cancel options --}}
                <div class="text-center">
                    <button type="button" @click="open = false"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium py-2 px-4 rounded mr-2 cursor-pointer transition">
                        Cancel
                    </button>

                    <button type="submit"
                        class="bg-red-500 hover:bg-red-700 text-white font-medium py-2 px-4 rounded cursor-pointer transition">
                        Delete
                    </button>
                </div>
            </x-form>

        </div>
    </div>
</section>