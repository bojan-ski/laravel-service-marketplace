@props([
'type',
'message'
])

@if (session()->has($type))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)"
        class="pop-up-message fixed inset-0 z-100 bg-black/25 bg-opacity-15 pt-[150px]">
        <div class="max-w-max mx-auto p-5 md:px-7 rounded-lg {{ $type == 'success' ? 'bg-green-500' : 'bg-red-500' }}">
            <p class="text-xl text-white font-semibold">
                {{ $message }}
            </p>
        </div>
    </div>
@endif