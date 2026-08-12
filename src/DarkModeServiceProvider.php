<?php

namespace LaravelUx\DarkMode;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use LaravelUx\DarkMode\View\Directives\DarkModeScripts;
use Livewire\Livewire;

class DarkModeServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'ux.dark-mode');

        Blade::directive('darkModeScripts', new DarkModeScripts);

        Livewire::addNamespace(
            'ux.dark-mode',
            classNamespace: 'LaravelUx\\DarkMode\\Livewire',
        );
    }
}
