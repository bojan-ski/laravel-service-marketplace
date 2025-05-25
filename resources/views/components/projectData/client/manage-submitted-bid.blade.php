@props([
'project',
'bid'
])

<div class="flex items-center justify-between mt-5">
    {{-- accept option --}}
    <form method="POST" action="{{ route('client.bid.accept', [$project, $bid]) }}"
        onsubmit="return confirm('Are you sure you want to accept the bid and reject all others?')">
        @csrf
        @method("PUT")

        <button type="submit"
            class="font-semibold px-4 py-2 bg-green-500 hover:bg-green-700 text-white rounded cursor-pointer transition">
            Accept
        </button>
    </form>

    {{-- reject option --}}
    <form method="POST" action="{{ route('client.bid.reject', [$project, $bid]) }}"
        onsubmit="return confirm('Are you sure you want to reject the bid?')">
        @csrf
        @method("PUT")

        <button type="submit"
            class="font-semibold px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded cursor-pointer transition">
            Reject
        </button>
    </form>
</div>