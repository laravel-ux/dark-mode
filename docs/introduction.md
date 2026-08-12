# Introduction

Laravel UX Dark Mode adds a session-persisted light and dark appearance to Laravel applications using Livewire and
Alpine.

The package provides two integration points:

- The `@darkModeScripts` Blade directive initializes and synchronizes the `dark` class on the root HTML element.
- The `ux.dark-mode::toggle` Livewire component renders an accessible Laravel UX button for changing the mode.

## How it works

The selected mode is stored in the Laravel session under the `darkMode` key as a boolean. A missing value defaults to
light mode.

When dark mode is active, the package adds the `dark` class to `document.documentElement`. Tailwind dark variants and
Laravel UX color tokens then apply the dark appearance to the page.

The toggle also synchronizes an Alpine store named `darkMode` and dispatches a browser event after every change. This
keeps other Alpine components and embedded previews in sync without duplicating the persistence logic.

## Included behavior

- Persist the selected mode in the Laravel session.
- Restore the mode on later requests in the same session.
- Synchronize the root `dark` class with Alpine.
- Provide an icon-only toggle built with Laravel UX UI and Icons.
- Dispatch a documented event for custom integrations.

The package currently supports explicit light and dark modes. It does not infer the operating system preference or
store the selection in `localStorage`.
