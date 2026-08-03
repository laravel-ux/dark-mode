# Installation

Install Laravel UX Dark Mode with Composer.

```shell
composer require laravel-ux/dark-mode
```

Laravel package discovery registers the service provider automatically.

The included toggle currently renders Laravel UX Button and Icon components. Until package-to-package dependencies
are formalized, the consuming application must already provide Laravel UX UI and Icons.

## Tailwind dark variant

The package controls dark mode by adding a `dark` class to the root HTML element. Make sure the application's Tailwind
CSS uses a class-based dark variant. Laravel UX UI already includes:

```css
@custom-variant dark (&:is(.dark *));
```

## Add the initialization script

Place `@darkModeScripts` in the document `<head>`, after the application styles and before Livewire scripts execute.
Early placement restores the root class before the page is painted and registers the Alpine listener before
initialization.

```blade
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @darkModeScripts
</head>
<body>
    {{ $slot }}

    @livewireScripts
</body>
</html>
```

Add the directive once per document. Do not place it inside a Livewire component that may be rerendered.

## Verify the installation

Render the package toggle in a Blade or Livewire view:

```blade
@livewire('ux.dark-mode::toggle')
```

Clicking the control should toggle the `dark` class on `<html>` and store a boolean `darkMode` value in the session.
