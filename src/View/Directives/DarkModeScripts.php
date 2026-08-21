<?php

declare(strict_types=1);

namespace LaravelUx\DarkMode\View\Directives;

class DarkModeScripts
{
    public function __invoke(): string
    {
        return <<<'HTML'
<script>
    (() => {
        let darkMode = {{ Js::from(session('darkMode', false)) }}

        const applyDarkMode = (value = darkMode) => {
            darkMode = typeof value === 'object' && value.initialValue !== undefined ? value.initialValue : value
            document.documentElement.classList.toggle('dark', darkMode)
        }

        applyDarkMode()

        document.addEventListener('dark-mode-toggled', event => applyDarkMode(event.detail.darkMode))
        document.addEventListener('livewire:navigated', () => applyDarkMode())

        document.addEventListener('alpine:init', () => {
            Alpine.store('darkMode', darkMode)
            Alpine.watch(() => Alpine.store('darkMode'), value => {
                applyDarkMode(value)
            })
        })
    })()
</script>
HTML;
    }
}
