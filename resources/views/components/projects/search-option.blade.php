<form method="GET" action="{{ route('projects.search') }}">
    {{-- search term --}}
    <input type="text" name="search_term" placeholder="Enter search term"
        class="w-60 sm:w-96 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ request('search_term') }}" />

    {{-- submit btn --}}
    <button class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded cursor-pointer transition">
        Search
    </button>
</form>