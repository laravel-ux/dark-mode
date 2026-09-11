# Usage

Render the Livewire toggle wherever the application exposes appearance controls.

```blade
@livewire('ux.dark-mode::toggle')
```

The included component renders a ghost icon button using Laravel UX UI. Its icon and accessible label follow the
current mode.

## Layout example

A typical application layout initializes dark mode in the document head and renders the control in its header.

```blade
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @darkModeScripts
</head>
<body class="bg-background text-foreground">
    <header>
        @livewire('ux.dark-mode::toggle')
    </header>

    {{ $slot }}

    @livewireScripts
</body>
</html>
```

## Alpine state

The directive exposes the current boolean value through the Alpine store:

```blade
<span x-text="$store.darkMode ? 'Dark' : 'Light'"></span>
```

Use the store to reflect the selected mode in nearby client-side UI. Let the Livewire toggle own persistence instead
of writing directly to `localStorage` or the session from multiple controls.

When using `wire:navigate`, keep `@darkModeScripts` in the document layout. The directive reapplies the current mode
after each Livewire navigation so the `dark` class is not removed when Livewire morphs the `<html>` element.

## Server-side state

Read the selected value from the session when server-rendered content needs to know the current mode:

```php
$darkMode = session('darkMode', false);
```

Treat the value as a boolean. `false` means light mode and `true` means dark mode.
