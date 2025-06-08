<x-layouts.app :title="__('All client users')">

    {{-- All client users container - list --}}
    <section
        class="client-users-list {{ $allClientUsers->isNotEmpty() ? 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4' : '' }} mb-5">
        @forelse ($allClientUsers as $client)
            <x-admin.user-list-card :user="$client" route='admin.client'>
                {{-- num of projects --}}
                <x-admin.user-list-card-data label='Projects' :data="$client->projects_count"/>
            </x-admin.user-list-card>
        @empty
            <x-custom.no-data-message message='No client users' />
        @endforelse
    </section>

    {{-- Pagination option --}}
    <section class="pagination-option">
        {{ $allClientUsers->links() }}
    </section>

</x-layouts.app>