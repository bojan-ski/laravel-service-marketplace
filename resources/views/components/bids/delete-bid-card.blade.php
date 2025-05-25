@props(['bid'])

<form method="POST" action="{{ route('freelancer.bid.destroy', $bid) }}"
    onsubmit="return confirm('Are you sure you want to delete the bid?')">
    @csrf
    @method("DELETE")

    <button type="submit"
        class="font-semibold px-2.5 py-1 text-sm bg-red-500 hover:bg-red-700 text-white rounded cursor-pointer transition">
        X
    </button>
</form>