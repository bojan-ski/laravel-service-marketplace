@props([
'user',
'route'
])

<div class="border rounded-lg p-4">
    {{-- name --}}
    <x-admin.user-list-card-data label='Name' :data="$user->name" />

    {{-- name --}}
    <x-admin.user-list-card-data label='Email' :data="$user->email" />

    {{-- ratings --}}
    <div class="mb-3 pb-2 border-b">
        <span class="mb-1">
            Avg rate:
        </span>

        <span class="font-semibold">
            {{ round($user->user_avg_received_rate) }} ({{ $user->user_num_received_ratings }})
        </span>
    </div>

    {{-- account created --}}
    <x-admin.user-list-card-data label='Created' :data="\Carbon\Carbon::parse($user->created_at)->format('d.m.Y')" />

    {{-- user specific data --}}
    {{ $slot }}

    {{-- num of conversations --}}
    <x-admin.user-list-card-data label='Conversations' :data="$user->conversations_count" />

    {{-- link to selected user details --}}
    <a href="{{ route($route, $user) }}"
        class="block text-center bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded cursor-pointer transition">
        See user details
    </a>
</div>