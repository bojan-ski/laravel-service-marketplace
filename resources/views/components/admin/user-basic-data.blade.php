@props([
    'name',
    'email'
])

<section class="user-profile-data border-b pb-2 mb-5">
    <p class="text-xl mb-3">
        <span>
            Name:
        </span>
        <span class="font-semibold">
            {{ $name }}
        </span>
    </p>

    <p class="text-xl mb-3">
        <span>
            Email:
        </span>
        <span class="font-semibold">
            {{ $email }}
        </span>
    </p>
</section>