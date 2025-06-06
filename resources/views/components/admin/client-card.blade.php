@props(['client'])

<div class="border rounded-lg p-4">
    {{-- name --}}
    <x-admin.client-card-data label='Name' :data="$client->name"/>

    {{-- name --}}
    <x-admin.client-card-data label='Email' :data="$client->email"/>

    {{-- ratings --}}
    <div class="mb-3 pb-2 border-b">
        <span class="mb-1">
            Avg rate:
        </span>

        <span class="font-semibold">
            {{ round($client->client_avg_received_rate) }} ({{ $client->client_num_received_ratings }})
        </span>
    </div>

    {{-- account created --}}
    <x-admin.client-card-data label='Created' :data="\Carbon\Carbon::parse($client->created_at)->format('d.m.Y')"/>

    {{-- num of projects --}}
    <x-admin.client-card-data label='Projects' :data="$client->projects_count"/>

    {{-- link to selected client user details --}}
    <a href="{{ route('admin.client', $client) }}"
        class="block text-center bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded cursor-pointer transition">
        See details
    </a>
</div>