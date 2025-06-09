@props(['user'])

<section class="user-profile-data border-b pb-2 mb-5">
    <div>
        <p class="text-xl mb-3">
            <span>
                Name:
            </span>
            <span class="font-semibold">
                {{ $user->name }}
            </span>
        </p>

        <p class="text-xl mb-3">
            <span>
                Email:
            </span>
            <span class="font-semibold">
                {{ $user->email }}
            </span>
        </p>
    </div>

    {{-- delete user feature --}}
    <x-admin.delete-user-option :user="$user" />
</section>