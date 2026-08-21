<?php

declare(strict_types=1);

namespace LaravelUx\DarkMode\Livewire;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Locked;
use Livewire\Component;

class Toggle extends Component
{
    #[Locked]
    public bool $darkMode = false;

    public function mount(): void
    {
        $this->darkMode = Session::get('darkMode', false);
    }

    public function toggle(): void
    {
        $this->darkMode = ! $this->darkMode;

        Session::put('darkMode', $this->darkMode);

        $this->dispatch('dark-mode-toggled', darkMode: $this->darkMode);
    }

    public function render(): View
    {
        return view('ux.dark-mode::livewire.toggle');
    }
}
