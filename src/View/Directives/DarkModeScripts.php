<?php

namespace LaravelUx\DarkMode\View\Directives;

class DarkModeScripts
{
    public function __invoke(): string
    {
        return <<<'HTML'
<script>
    document.documentElement.classList.toggle('dark', {{ Js::from(session('darkMode', false)) }})
    document.addEventListener('alpine:init', () => {
        Alpine.store('darkMode', {{ Js::from(session('darkMode', false)) }})
        Alpine.watch(() => Alpine.store('darkMode'), value => {
            document.documentElement.classList.toggle(
                'dark',
                typeof value === 'object' && value.initialValue !== undefined ? value.initialValue : value,
            )
        })
    })
</script>
HTML;
    }
}
