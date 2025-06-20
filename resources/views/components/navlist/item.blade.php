@aware(['variant' => 'primary'])

@props([
'current' => false,
'before' => '',
'after' => '',
'badge' => false
])

<a aria-current="{{ $current ? 'page' : '' }}" {{ $attributes->class([
    'h-10 lg:h-8 relative flex items-center space-x-2 rounded-lg',
    'py-0 text-left w-full px-3 mb-2',
    'text-gray-500 dark:text-white/80',
    'border border-transparent',
    'aria-current:text-(--color-accent-content) hover:aria-current:text-(--color-accent-content)',
    match($variant) { // Hover...
    'primary' => 'hover:text-gray-800 dark:hover:text-white hover:bg-gray-800/5 dark:hover:bg-white/[7%]',
    'secondary' => 'hover:text-gray-800 dark:hover:text-white hover:bg-gray-800/[4%] dark:hover:bg-white/[7%]',
    },
    match($variant) { // Current...
    'primary' => 'aria-current:bg-white dark:aria-current:bg-white/[7%] aria-current:border aria-current:border-gray-200
    dark:aria-current:border-transparent',
    'secondary' => 'aria-current:bg-gray-800/[4%] dark:aria-current:bg-white/[7%]',
    },
    ]) }}>
    <?php if (is_string($before) && $before !== ''): ?>
        <x-dynamic-component :component="$before" aria-hidden="true" width="16" height="16" class="shrink-0" />
    <?php else: ?>
        {{ $before }}
    <?php endif; ?>
    <?php if ($slot->isNotEmpty()): ?>
        <div class="relative flex-1 text-sm font-medium leading-none whitespace-nowrap">
            {{ $slot }}

            <!-- notification badge -->
            @if ($badge)
                <span id="message-notification-badge"
                    class="absolute top-1.75 right-3 px-2 py-1 text-xs font-bold leading-none transform translate-x-1/2 -translate-y-1/2 rounded-full border hidden">
                    new
                </span>        
            @endif
        </div>
    <?php endif; ?>
    <?php if (is_string($after) && $after !== ''): ?>
        <x-dynamic-component :component="$after" aria-hidden="true" width="16" height="16" class="shrink-0 ml-1" />
    <?php else: ?>
        {{ $after }}
    <?php endif; ?>    
</a>