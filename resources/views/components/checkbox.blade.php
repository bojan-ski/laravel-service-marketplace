@props(['link' => null])

@php
    $classes = [
        'col-start-1 row-start-1 appearance-none forced-colors:appearance-auto',
        'shrink-0 size-5 rounded-md',
        'text-sm text-gray-700 dark:text-gray-800',
        'shadow-xs disabled:opacity-75 disabled:checked:opacity-50 disabled:shadow-none checked:shadow-none
        indeterminate:shadow-none',
        'border border-gray-300 dark:border-white/10',
        'disabled:border-gray-200 dark:disabled:border-white/5',
        'checked:border-transparent indeterminate:border-transparent',
        'disabled:checked:border-transparent disabled:indeterminate:border-transparent',
        'bg-white dark:bg-white/10',
        'checked:bg-(--color-accent)',
    ];
@endphp

<?php if ($label): ?>
    <div class="flex items-center gap-x-2.5">
        <div class="group grid size-5 grid-cols-1">
            <input type="checkbox" {{ $formControlAttributes }} value="{{ $value }}" {{ $attributes->class($classes) }}>
            <svg class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center text-(--color-accent-foreground) stroke-current"
                viewBox="0 0 14 14" fill="none">
                <path class="opacity-0 group-has-checked:opacity-100" d="M3 8L6 11L11 3.5" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round"></path>
                <path class="opacity-0 group-has-indeterminate:opacity-100" d="M3 7H11" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </div>
        @if ($link)
            <a href="{{ $link }}" class="text-sm text-blue-500 hover:text-blue-700 cursor-pointer" target="_blank">
                {{ $label }} 
            </a>
        @else
            <x-label :for="$id" :value="$label" />            
        @endif
    </div>
    <x-error :for="$id" />
<?php else: ?>
    <div class="group grid size-5 grid-cols-1">
        <input type="checkbox" {{ $formControlAttributes }} value="{{ $value }}" {{ $attributes->class($classes) }}>
        <svg class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-disabled:stroke-gray-950/25"
            viewBox="0 0 14 14" fill="none">
            <path class="opacity-0 group-has-checked:opacity-100" d="M3 8L6 11L11 3.5" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round"></path>
            <path class="opacity-0 group-has-indeterminate:opacity-100" d="M3 7H11" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round"></path>
        </svg>
    </div>
    <x-error :for="$id" />
<?php endif; ?>
