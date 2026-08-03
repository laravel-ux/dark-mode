---
name: laravel-ux-dark-mode-development
description: "Build, integrate, customize, review, or debug session-persisted dark mode with laravel-ux/dark-mode. Use when a task involves the @darkModeScripts Blade directive, the ux.dark-mode::toggle Livewire component, the darkMode session value or Alpine store, the dark-mode-toggled browser event, Tailwind dark variants, avoiding theme flash, custom appearance controls, or testing light and dark mode behavior."
---

# Laravel UX Dark Mode Development

Keep the package's session state, root HTML class, Alpine store, and Livewire control synchronized. Prefer the
package integration points over parallel theme implementations.

## Workflow

1. Inspect the main document layout and locate `@livewireStyles`, `@livewireScripts`, and application assets.
2. Place `@darkModeScripts` once in `<head>`, after styles and before Alpine or Livewire initialization.
3. Render `@livewire('ux.dark-mode::toggle')` where the user chooses an appearance.
4. Use the Alpine store or browser event for client-side integrations; do not create another persistence source.
5. Test the initial response, toggle action, session value, root class, and keyboard-accessible control.

## Public API

Initialize the document:

```blade
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @darkModeScripts
</head>
```

Render the control:

```blade
@livewire('ux.dark-mode::toggle')
```

Read state:

```php
session('darkMode', false);
```

```blade
<span x-text="$store.darkMode ? 'Dark' : 'Light'"></span>
```

Listen for changes:

```blade
<div @dark-mode-toggled.window="handleMode($event.detail.darkMode)"></div>
```

## State Contract

- Store the selected value in the Laravel session as boolean `darkMode`.
- Interpret `false` as light and `true` as dark.
- Toggle the `dark` class on `document.documentElement`.
- Keep the Alpine store name `darkMode`.
- Dispatch `dark-mode-toggled` with boolean detail `darkMode`.
- Change the locked Livewire property through the `toggle` action, not arbitrary client assignment.
- Do not introduce `localStorage`, cookies, or operating-system preference detection unless the task explicitly
  changes the package contract.

## Layout Integration

- Place the directive in `<head>` to apply the class before paint and register the `alpine:init` listener early.
- Include it exactly once per HTML document.
- Do not put it inside rerendered Livewire markup.
- Keep `@livewireScripts` near the end of `<body>`.
- Ensure Tailwind has a class-based dark variant such as `@custom-variant dark (&:is(.dark *));`.
- Use semantic color tokens (`background`, `foreground`, `muted-foreground`) so components react to the root class.

## Customize the Toggle

Override the package view at
`resources/views/vendor/ux.dark-mode/livewire/toggle.blade.php`.

Preserve:

- `wire:click="toggle"`
- `$wire.entangle('darkMode')` synchronization with the Alpine store
- `dark-mode-toggled` handling
- an accessible name on every icon-only control

Use Laravel UX Button and Icon components when available. Keep product-specific placement and surrounding layout in
the application rather than the package.

## Events and Embedded Content

Use `.window` for listeners outside the Livewire component. Forward the boolean to same-origin previews when needed.
For cross-origin `postMessage`, specify and validate the expected origin; do not use unrestricted origins in
production integrations.

## Testing

Test the Livewire state transition:

```php
Livewire::test('ux.dark-mode::toggle')
    ->assertSet('darkMode', false)
    ->call('toggle')
    ->assertSet('darkMode', true);

expect(session('darkMode'))->toBeTrue();
```

Also verify:

- a saved session value initializes the component and root class;
- the event contains the new boolean value;
- the toggle has an accessible label and works from the keyboard;
- dark variants apply without a visible light-theme flash;
- multiple page navigations preserve the session selection.
