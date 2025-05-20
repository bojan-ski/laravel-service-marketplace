<div {{ $attributes->class(['mx-auto w-full [:where(&)]:max-w-7xl px-6 lg:px-8']) }}>
    {{-- pop-up messages success --}}
    @if (session('success'))
        <x-custom.pop-up-message-custom type='success' message="{{ session('success') }}" />
    @endif

    {{-- pop-up messages error --}}
    @if (session('error'))
        <x-custom.pop-up-message-custom type='error' message="{{ session('error') }}" />
    @endif

    {{-- container - app content --}}
    {{ $slot }}
</div>