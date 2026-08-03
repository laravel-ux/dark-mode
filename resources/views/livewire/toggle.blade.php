<x-ux::button
    size="icon"
    variant="ghost"
    class="size-8"
    wire:click="toggle"
    :aria-label="$darkMode ? __('Use light mode') : __('Use dark mode')"
    x-init="Alpine.store('darkMode', $wire.entangle('darkMode'))"
    @dark-mode-toggled="$store.darkMode = $event.detail.darkMode"
>
    <x-ux::icon :name="$darkMode ? 'moon' : 'sun'" />
</x-ux::button>
